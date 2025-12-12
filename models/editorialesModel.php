<?php
require_once("../conexionDB.php");

// LISTAR EDITORIALES
function listarEditoriales() {
    $conexion = getConexion();
    $sql = "SELECT 
                id_editorial,
                nombre,
                estado,
                fecha_creacion
            FROM editorial
            WHERE estado IN (0,1)";
    $resultado = $conexion->query($sql);
    $editoriales = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $editoriales[] = $fila;
        }
    }
    $conexion->close();
    return $editoriales;
}

// REGISTRAR EDITORIAL
function registrarEditorial($nombre) {
    $conexion = getConexion();

    // BUSCAR SI YA EXISTE
    $sqlBuscar = "SELECT id_editorial, estado 
                  FROM editorial 
                  WHERE nombre = ? 
                  LIMIT 1";
    $stmtBuscar = $conexion->prepare($sqlBuscar);
    $stmtBuscar->bind_param("s", $nombre);
    $stmtBuscar->execute();
    $resultado = $stmtBuscar->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $editorial = $resultado->fetch_assoc();
        $id_editorial = $editorial['id_editorial'];
        $estadoActual = $editorial['estado'];
        $stmtBuscar->close();

        if ($estadoActual == 2) {
            // RESTAURAR EDITORIAL ELIMINADA
            $sqlRestaurar = "UPDATE editorial 
                             SET estado = 1
                             WHERE id_editorial = ?";
            $stmtRestaurar = $conexion->prepare($sqlRestaurar);
            $stmtRestaurar->bind_param("i", $id_editorial);
            $ok = $stmtRestaurar->execute();
            $stmtRestaurar->close();
            $conexion->close();

            return [
                "success" => $ok,
                "accion"  => "restaurado",
                "message" => $ok
                    ? "Editorial restaurada correctamente."
                    : "No se pudo restaurar la editorial."
            ];
        } else {
            // YA EXISTE = NO PERMITIR DUPLICAR
            $conexion->close();
            return [
                "success" => false,
                "accion"  => "duplicado",
                "message" => "Ya existe una editorial con ese nombre."
            ];
        }
    }

    // NO EXISTE = INSERTAR NUEVA
    $stmtBuscar->close();
    $sqlInsert = "INSERT INTO editorial (nombre) VALUES (?)";
    $stmtInsert = $conexion->prepare($sqlInsert);
    $stmtInsert->bind_param("s", $nombre);
    $ok = $stmtInsert->execute();
    $stmtInsert->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => $ok ? "creado" : "error",
        "message" => $ok
            ? "Editorial registrada correctamente."
            : "No se pudo registrar la editorial."
    ];
}

// ACTUALIZAR EDITORIAL
function actualizarEditorial($id_editorial, $nombre) {
    $conexion = getConexion();

    // VERIFICAR DUPLICADO
    $sqlCheck = "SELECT id_editorial 
                 FROM editorial 
                 WHERE nombre = ? AND id_editorial <> ?
                 LIMIT 1";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("si", $nombre, $id_editorial);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();

    if ($resCheck && $resCheck->num_rows > 0) {
        $stmtCheck->close();
        $conexion->close();
        return [
            "success" => false,
            "accion"  => "duplicado",
            "message" => "Ya existe otra editorial con ese nombre."
        ];
    }
    $stmtCheck->close();

    $sql = "UPDATE editorial SET nombre = ? WHERE id_editorial = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nombre, $id_editorial);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "actualizado",
        "message" => $ok
            ? "Editorial actualizada correctamente."
            : "No se pudo actualizar la editorial."
    ];
}

// CAMBIAR ESTADO
function cambiarEstadoEditorial($id_editorial, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE editorial SET estado = ? WHERE id_editorial = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $id_editorial);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "cambiar_estado",
        "message" => $ok
            ? "Estado de la editorial actualizado correctamente."
            : "No se pudo actualizar el estado de la editorial."
    ];
}

// ELIMINAR O CAMBIAR ESTADO A 2
function eliminarEditorial($id_editorial) {
    $conexion = getConexion();
    $sql = "UPDATE editorial 
            SET estado = 2
            WHERE id_editorial = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_editorial);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "eliminado",
        "message" => $ok
            ? "Editorial eliminada correctamente."
            : "No se pudo eliminar la editorial."
    ];
}

?>