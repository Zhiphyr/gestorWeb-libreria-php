<?php
require_once("../models/usuariosModel.php");
require_once("../models/perfilesModel.php");
header('Content-Type: application/json');

session_start();
$idUsuarioActual = $_SESSION['id_usuario'];

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarUsuarios':
        $usuarios = listarUsuarios();
        echo json_encode($usuarios);
        break;

    case 'cargarPerfiles':
        $perfiles = cargarPerfiles();
        echo json_encode($perfiles);
        break;

    case 'registrarUsuario':
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $correo = $_POST['correo'];
        $id_perfil = $_POST['id_perfil'];

        if ($nombre === null || $usuario === null || $clave === null || $correo === null || $id_perfil === null) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos"]);
            exit;
        }

        $resultado = registrarUsuario($nombre, $usuario, $clave, $correo, $id_perfil);
        echo json_encode(['success' => $resultado]);
        break;

    case 'actualizarUsuario':
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $id_perfil = $_POST['id_perfil'];
        $idUsuarioActual = $_SESSION['id_usuario'];
        $idPerfilActual = $_SESSION['id_perfil'];

        if ($id == 0 || $nombre === null || $usuario === null || $correo === null || $id_perfil === null) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos."]);
            exit;
        }

        if ($id == $idUsuarioActual && $id_perfil != $idPerfilActual) {
            echo json_encode([
                "success" => false, 
                "message" => "\nNo puedes actualizar tu perfil."]);
            exit;
        }

        $resultado = actualizarUsuario($id, $nombre, $usuario, $correo, $id_perfil);
        echo json_encode(['success' => $resultado]);
        break;

    case 'cambiarEstadoUsuario':
        $id = $_POST['id'];
        $nuevoEstado = $_POST['nuevoEstado'];

        if ($id == 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos"]);
            exit;
        }

        if ($id == $idUsuarioActual) {
            echo json_encode([
                "success" => false, 
                "message" => "\nNo puedes cambiar tu estado de usuario"]);
            exit;
        }

        $resultado = cambiarEstadoUsuario($id, $nuevoEstado);
        echo json_encode(['success' => $resultado]);
        break;

    case 'eliminarUsuario':
        $id = $_POST['id'];

        if ($id == 0) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos"]);
            exit;
        }

        if ($id == $idUsuarioActual) {
            echo json_encode([
                "success" => false, 
                "message" => "\nNo puedes eliminar tu usuario"]);
            exit;
        }

        $resultado = eliminarUsuario($id);
        echo json_encode(['success' => $resultado]);
        break;

    case 'contadores':
        echo json_encode([
            'registrados' => contarUsuariosRegistrados(),
            'activos' => contarUsuariosActivos(),
            'inactivos' => contarUsuariosInactivos()
        ]);
        break;    

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}


?>