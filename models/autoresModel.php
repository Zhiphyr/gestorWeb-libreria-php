<?php
require_once("../conexionDB.php");

// LISTAR AUTORES
function listarAutores() {
    $conexion = getConexion();
    $sql = "SELECT 
                id_autor,
                nombre,
                estado,
                fecha_creacion
            FROM autor
            WHERE estado IN (0,1)";
    $resultado = $conexion->query($sql);
    $autores = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $autores[] = $fila;
        }
    }
    $conexion->close();
    return $autores;
}

// REGISTRAR AUTOR
function registrarAutor($nombre) {
    $conexion = getConexion();

    // BUSCAR SI YA EXISTE
    $sqlBuscar = "SELECT id_autor, estado 
                  FROM autor 
                  WHERE nombre = ? 
                  LIMIT 1";
    $stmtBuscar = $conexion->prepare($sqlBuscar);
    $stmtBuscar->bind_param("s", $nombre);
    $stmtBuscar->execute();
    $resultado = $stmtBuscar->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $autor = $resultado->fetch_assoc();
        $id_autor = $autor['id_autor'];
        $estadoActual = $autor['estado'];
        $stmtBuscar->close();

        if ($estadoActual == 2) {
            // RESTAURAR AUTOR ELIMINADO
            $sqlRestaurar = "UPDATE autor 
                             SET estado = 1
                             WHERE id_autor = ?";
            $stmtRestaurar = $conexion->prepare($sqlRestaurar);
            $stmtRestaurar->bind_param("i", $id_autor);
            $ok = $stmtRestaurar->execute();
            $stmtRestaurar->close();
            $conexion->close();

            return [
                "success" => $ok,
                "accion"  => "restaurado",
                "message" => $ok
                    ? "Autor restaurado correctamente."
                    : "No se pudo restaurar el autor."
            ];
        } else {
            // YA EXISTE = NO PERMITIR DUPLICAR
            $conexion->close();
            return [
                "success" => false,
                "accion"  => "duplicado",
                "message" => "Ya existe un autor con ese nombre."
            ];
        }
    }

    // NO EXISTE = INSERTAR NUEVO
    $stmtBuscar->close();
    $sqlInsert = "INSERT INTO autor (nombre) VALUES (?)";
    $stmtInsert = $conexion->prepare($sqlInsert);
    $stmtInsert->bind_param("s", $nombre);
    $ok = $stmtInsert->execute();
    $stmtInsert->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => $ok ? "creado" : "error",
        "message" => $ok
            ? "Autor registrado correctamente."
            : "No se pudo registrar el autor."
    ];
}

// ACTUALIZAR AUTOR
function actualizarAutor($id_autor, $nombre) {
    $conexion = getConexion();

    // VERIFICAR QUE NO HAYA OTRO AUTOR CON EL MISMO NOMBRE
    $sqlCheck = "SELECT id_autor 
                 FROM autor 
                 WHERE nombre = ? AND id_autor <> ?
                 LIMIT 1";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("si", $nombre, $id_autor);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();

    if ($resCheck && $resCheck->num_rows > 0) {
        $stmtCheck->close();
        $conexion->close();
        return [
            "success" => false,
            "accion"  => "duplicado",
            "message" => "Ya existe otro autor con ese nombre."
        ];
    }
    $stmtCheck->close();

    $sql = "UPDATE autor SET nombre = ? WHERE id_autor = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nombre, $id_autor);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "actualizado",
        "message" => $ok
            ? "Autor actualizado correctamente."
            : "No se pudo actualizar el autor."
    ];
}

// CAMBIAR ESTADO
function cambiarEstadoAutor($id_autor, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE autor SET estado = ? WHERE id_autor = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $id_autor);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "cambiar_estado",
        "message" => $ok
            ? "Estado del autor actualizado correctamente."
            : "No se pudo actualizar el estado del autor."
    ];
}

// ELIMINAR O CAMBIAR ESTADO A 2
function eliminarAutor($id_autor) {
    $conexion = getConexion();
    $sql = "UPDATE autor 
            SET estado = 2
            WHERE id_autor = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_autor);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "eliminado",
        "message" => $ok
            ? "Autor eliminado correctamente."
            : "No se pudo eliminar el autor."
    ];
}


?>