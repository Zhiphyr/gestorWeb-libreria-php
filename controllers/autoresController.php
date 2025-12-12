<?php
require_once("../models/autoresModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarAutores':
        $autores = listarAutores();
        echo json_encode($autores);
        break;

    case 'registrarAutor':
        $nombre = $_POST['nombre'] ?? null;

        if ($nombre === null || trim($nombre) === '') {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "El nombre es obligatorio."
            ]);
            exit;
        }

        $resultado = registrarAutor($nombre);
        echo json_encode($resultado);
        break;

    case 'actualizarAutor':
        $id_autor = isset($_POST['id_autor']) ? (int)$_POST['id_autor'] : 0;
        $nombre = $_POST['nombre'] ?? null;

        if ($id_autor <= 0 || $nombre === null || trim($nombre) === '') {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "Datos inválidos para actualizar el autor."
            ]);
            exit;
        }

        $resultado = actualizarAutor($id_autor, $nombre);
        echo json_encode($resultado);
        break;

    case 'cambiarEstadoAutor':
        $id_autor = isset($_POST['id_autor']) ? (int)$_POST['id_autor'] : 0;
        $nuevoEstado = isset($_POST['nuevoEstado']) ? (int)$_POST['nuevoEstado'] : null;

        if ($id_autor <= 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "Datos inválidos para cambiar el estado."
            ]);
            exit;
        }

        $resultado = cambiarEstadoAutor($id_autor, $nuevoEstado);
        echo json_encode($resultado);
        break;

    case 'eliminarAutor':
        $id_autor = isset($_POST['id_autor']) ? (int)$_POST['id_autor'] : 0;

        if ($id_autor <= 0) {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "Datos inválidos para eliminar el autor."
            ]);
            exit;
        }

        $resultado = eliminarAutor($id_autor);
        echo json_encode($resultado);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}

?>