<?php
require_once("../conexionDB.php");

// LISTAR PERFILES
function obtenerPerfiles() {
    $conexion = getConexion();
    $sql = "SELECT * FROM perfiles WHERE estado = 1 OR estado = 0";
    $resultado = $conexion->query($sql);
    $perfiles = [];
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $perfiles[] = $fila;
        }
    }
    $conexion->close();
    return $perfiles;
}

// AGREGAR PERFIL
function agregarPerfil($nombre, $descripcion) {
    $conexion = getConexion();
    $sql = "INSERT INTO perfiles (nombre, descripcion) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombre, $descripcion);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// CAMBIAR EL ESTADO
function cambiarEstadoPerfil($idPerfil, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE perfiles SET estado = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $idPerfil);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// ELIMINAR O CAMBIAR EL ESTADO A 2
function eliminarPerfil($idPerfil) {
    $conexion = getConexion();
    $sql = "UPDATE perfiles SET estado = 2 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idPerfil);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// ACTUALIZAR PERFIL
function actualizarPerfil($idPerfil, $nombre, $descripcion) {
    $conexion = getConexion();
    $sql = "UPDATE perfiles SET nombre = ?, descripcion = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $descripcion, $idPerfil);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// CARGAR PERFILES PARA EL SELECT
function cargarPerfiles() {
    $conexion = getConexion();
    $sql = "SELECT * FROM perfiles WHERE estado = 1 ORDER BY nombre ASC";
    $resultado = $conexion->query($sql);
    $perfiles = [];
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $perfiles[] = $fila;
        }
    }
    $conexion->close();
    return $perfiles;
}



?>