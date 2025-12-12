<?php
require_once("../conexionDB.php");

// LISTAR USUARIOS
function listarUsuarios() {
    $conexion = getConexion();
    $sql = "SELECT
                u.id,
                u.nombre,
                u.usuario,
                u.correo,
                u.estado,
                u.fecha_registro,
                u.id_perfil,
                p.nombre as perfil
            FROM usuarios u
            INNER JOIN perfiles p ON u.id_perfil = p.id
            WHERE u.estado IN (0,1)";
    $resultado = $conexion->query($sql);
    $usuarios = [];
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
    }
    $conexion->close();
    return $usuarios;
}

// REGISTRAR USUARIO
function registrarUsuario($nombre, $usuario, $clave, $correo, $id_perfil) {
    $conexion = getConexion();
    $contraseñaHasheada = password_hash($clave, PASSWORD_BCRYPT);
    $sql = "INSERT INTO usuarios (nombre, usuario, clave, correo, id_perfil) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $usuario, $contraseñaHasheada, $correo, $id_perfil);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// ACTUALIZAR USUARIO
function actualizarUsuario($id, $nombre, $usuario, $correo, $id_perfil) {
    $conexion = getConexion();
    $sql = "UPDATE usuarios SET nombre = ?, usuario = ?, correo = ?, id_perfil = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssii", $nombre, $usuario, $correo, $id_perfil, $id);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// CAMBIAR EL ESTADO
function cambiarEstadoUsuario($id, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $id);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// ELIMINAR O CAMBIAR EL ESTADO A 2
function eliminarUsuario($id) {
    $conexion = getConexion();
    $sql = "UPDATE usuarios SET estado = 2 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// CONTADORES
function contarUsuariosRegistrados(){
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE estado IN (0,1)";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return $fila['total'];
}

function contarUsuariosActivos(){
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE estado = 1";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return $fila["total"];
}

function contarUsuariosInactivos(){
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE estado = 0";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return $fila["total"];
}

?>