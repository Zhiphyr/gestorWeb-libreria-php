<?php
require_once("../conexionDB.php");

// LISTAR CATEGORIAS
function obtenerCategorias(){
    $conexion = getConexion();
    $query = "SELECT * FROM categorias WHERE estado IN (0,1)";
    $resultado = $conexion->query($query);
    $categorias = [];
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $categorias[] = $fila;
        }
    }
    $conexion->close();
    return $categorias;
}

// REGISTRAR CATEGORIA
function registrarCategoria($nombre, $descripcion){
    $conexion = getConexion();

    // BUSCAR SI YA EXISTE UNA CATEGORÍA CON ESE NOMBRE
    $sqlBuscar = "SELECT id_categoria, estado 
                  FROM categorias 
                  WHERE nombre = ? 
                  LIMIT 1";
    $stmtBuscar = $conexion->prepare($sqlBuscar);
    $stmtBuscar->bind_param("s", $nombre);
    $stmtBuscar->execute();
    $resultado = $stmtBuscar->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        // YA EXISTE UNA CATEGORÍA CON ESE NOMBRE
        $categoria = $resultado->fetch_assoc();
        $id_categoria = $categoria['id_categoria'];
        $estadoActual = $categoria['estado'];
        $stmtBuscar->close();

        if ($estadoActual == 2) {
            // ELIMINADA = RESTAURAR
            $sqlRestaurar = "UPDATE categorias 
                             SET descripcion = ?, 
                                 estado = 1, 
                                 fecha_restauracion = NOW(), 
                                 fecha_eliminacion = NULL
                             WHERE id_categoria = ?";
            $stmtRestaurar = $conexion->prepare($sqlRestaurar);
            $stmtRestaurar->bind_param("si", $descripcion, $id_categoria);
            $ok = $stmtRestaurar->execute();
            $stmtRestaurar->close();
            $conexion->close();

            return [
                "success"       => $ok,
                "accion"        => "restaurada",
                "id_categoria"  => $id_categoria,
                "message"       => $ok 
                    ? "Categoría restaurada correctamente."
                    : "No se pudo restaurar la categoría."
            ];
        } else {
            // YA EXISTE = NO PERMITIR DUPLICAR
            $conexion->close();
            return [
                "success" => false,
                "accion"  => "duplicada",
                "message" => "Ya existe una categoría activa o inactiva con ese nombre."
            ];
        }
    }

    // NO EXISTE = INSERTAR NUEVA
    $stmtBuscar->close();
    $sqlInsert = "INSERT INTO categorias (nombre, descripcion) 
                  VALUES (?, ?)";
    $stmtInsert = $conexion->prepare($sqlInsert);
    $stmtInsert->bind_param("ss", $nombre, $descripcion);
    $ok = $stmtInsert->execute();
    $nuevoId = $conexion->insert_id;

    $stmtInsert->close();
    $conexion->close();

    return [
        "success"       => $ok,
        "accion"        => $ok ? "creada" : "error",
        "id_categoria"  => $nuevoId,
        "message"       => $ok
            ? "Categoría registrada correctamente."
            : "No se pudo registrar la categoría."
    ];
}

// ACTUALIZAR CATEGORIA
function actualizarCategoria($id_categoria, $nombre, $descripcion) {
    $conexion = getConexion();

    // VERIFICAR QUE NO EXISTA OTRA CATEGORÍA CON EL MISMO NOMBRE
    $sqlCheck = "SELECT id_categoria 
                 FROM categorias 
                 WHERE nombre = ? AND id_categoria <> ?
                 LIMIT 1";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("si", $nombre, $id_categoria);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();

    if ($resCheck && $resCheck->num_rows > 0) {
        $stmtCheck->close();
        $conexion->close();
        return [
            "success" => false,
            "accion"  => "duplicada",
            "message" => "Ya existe otra categoría con ese nombre."
        ];
    }
    $stmtCheck->close();

    $sql = "UPDATE categorias 
            SET nombre = ?, descripcion = ?
            WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $descripcion, $id_categoria);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "actualizada",
        "message" => $ok
            ? "Categoría actualizada correctamente."
            : "No se pudo actualizar la categoría."
    ];
}

// CAMBIAR ESTADO
function cambiarEstadoCategoria($id_categoria, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE categorias SET estado = ? WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $id_categoria);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "cambiar_estado",
        "message" => $ok
            ? "Estado de la categoría actualizado correctamente."
            : "No se pudo actualizar el estado de la categoría."
    ];
}

// ELIMINAR O CAMBIAR ESTADO A 2 
function eliminarCategoria($id_categoria) {
    $conexion = getConexion();
    $sql = "UPDATE categorias 
            SET estado = 2, fecha_eliminacion = NOW()
            WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "eliminada",
        "message" => $ok
            ? "Categoría eliminada correctamente."
            : "No se pudo eliminar la categoría."
    ];
}

// CONTADORES PARA LAS TARJETAS
function contarCategoriasTotales() {
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total FROM categorias WHERE estado IN (0,1)";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return (int)$fila['total'];
}

function contarCategoriasActivas() {
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total FROM categorias WHERE estado = 1";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return (int)$fila['total'];
}

function contarCategoriasInactivas() {
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total FROM categorias WHERE estado = 0";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return (int)$fila['total'];
}


?>