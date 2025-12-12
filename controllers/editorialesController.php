<?php
require_once("../models/editorialesModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarEditoriales':
        $editoriales = listarEditoriales();
        echo json_encode($editoriales);
        break;

    case 'registrarEditorial':
        $nombre = $_POST['nombre'] ?? null;

        if ($nombre === null || trim($nombre) === '') {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "El nombre es obligatorio."
            ]);
            exit;
        }

        $resultado = registrarEditorial($nombre);
        echo json_encode($resultado);
        break;

    case 'actualizarEditorial':
        $id_editorial = isset($_POST['id_editorial']) ? (int)$_POST['id_editorial'] : 0;
        $nombre       = $_POST['nombre'] ?? null;

        if ($id_editorial <= 0 || $nombre === null || trim($nombre) === '') {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Datos inválidos para actualizar la editorial."
            ]);
            exit;
        }

        $resultado = actualizarEditorial($id_editorial, $nombre);
        echo json_encode($resultado);
        break;

    case 'cambiarEstadoEditorial':
        $id_editorial = isset($_POST['id_editorial']) ? (int)$_POST['id_editorial'] : 0;
        $nuevoEstado  = isset($_POST['nuevoEstado']) ? (int)$_POST['nuevoEstado'] : null;

        if ($id_editorial <= 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Datos inválidos para cambiar el estado."
            ]);
            exit;
        }

        $resultado = cambiarEstadoEditorial($id_editorial, $nuevoEstado);
        echo json_encode($resultado);
        break;

    case 'eliminarEditorial':
        $id_editorial = isset($_POST['id_editorial']) ? (int)$_POST['id_editorial'] : 0;

        if ($id_editorial <= 0) {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Datos inválidos para eliminar la editorial."
            ]);
            exit;
        }

        $resultado = eliminarEditorial($id_editorial);
        echo json_encode($resultado);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}

?>