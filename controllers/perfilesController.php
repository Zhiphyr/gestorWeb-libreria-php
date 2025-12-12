<?php
require_once("../models/perfilesModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'obtenerPerfiles':
        $perfiles = obtenerPerfiles();
        echo json_encode($perfiles);
        break;

    case 'agregarPerfil':
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if ($nombre == "Administrador" || $nombre == "administrador" || $nombre == "ADMINISTRADOR" || $nombre == "admin" || $nombre == "Admin" || $nombre == "ADMIN") {
            echo json_encode([
                "success" => false,
                "message" => "\nNo se puede agregar otro perfil Administrador."
            ]);
            exit;
        }

        $resultado = agregarPerfil($nombre, $descripcion);
        echo json_encode(['success' => $resultado]);
        break;

    case 'cambiarEstadoPerfil':
        $idPerfil = $_POST['id'];
        $nuevoEstado = $_POST['nuevoEstado'];

        if ($idPerfil == 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos"]);
            exit;
        }

        if ($idPerfil == 1) {
            echo json_encode([
                "success" => false,
                "message" => "\nNo se puede cambiar el estado del perfil Administrador."
            ]);
            exit;
        }
        
        $resultado = cambiarEstadoPerfil($idPerfil, $nuevoEstado);
        echo json_encode(['success' => $resultado]);
        break;

    case 'eliminarPerfil':
        $idPerfil = $_POST['id'];

        if ($idPerfil == 0) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos"]);
            exit;
        }

        if ($idPerfil == 1) {
            echo json_encode([
                "success" => false,
                "message" => "\nNo se puede eliminar el perfil Administrador."
            ]);
            exit;
        }

        $resultado = eliminarPerfil($idPerfil);
        echo json_encode(['success' => $resultado]);
        break;

    case 'actualizarPerfil':
        $idPerfil = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if ($idPerfil == 0 || $nombre === null || $descripcion === null) {
            echo json_encode([
                "success" => false, 
                "message" => "Datos inválidos"]);
            exit;
        }

        if ($idPerfil == 1) {
            echo json_encode([
                "success" => false,
                "message" => "\nNo se puede editar el perfil Administrador."
            ]);
            exit;
        }

        $resultado = actualizarPerfil($idPerfil, $nombre, $descripcion);
        echo json_encode(['success' => $resultado]);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}

?>