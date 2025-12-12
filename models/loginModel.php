<?php
require_once("../conexionDB.php");

function verificarCredenciales($usuario, $clave) {
    $conexion = getConexion();
    $sql = "SELECT u.*, p.nombre AS perfil 
            FROM usuarios u
            INNER JOIN perfiles p ON u.id_perfil = p.id
            WHERE u.usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_Param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0) {
        $stmt->close();
        $conexion->close();
        return ['estado_login' => 'no_existe'];
    }

    $usuarioEncontrado = $resultado->fetch_assoc();

    if (!password_verify($clave, $usuarioEncontrado['clave'])) {
        $stmt->close();
        $conexion->close();
        return ['estado_login' => 'clave_incorrecta'];
    }

    if ($usuarioEncontrado['estado'] == 0) {
        $stmt->close();
        $conexion->close();
        return ['estado_login' => 'inactivo'];
    }
    if ($usuarioEncontrado['estado'] == 2) {
        $stmt->close();
        $conexion->close();
        return ['estado_login' => 'eliminado'];
    }

    $stmt->close();
    $conexion->close();
    return $usuarioEncontrado;
}

?>