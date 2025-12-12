<?php
session_start();
header('Content-Type: application/json');
require_once("../models/inventarioModel.php");

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {

    case 'registrarMovimiento':
        $id_libro = (int)($_POST['id_libro'] ?? 0);
        $tipo = $_POST['tipo'] ?? '';
        $cantidad = (int)($_POST['cantidad'] ?? 0);
        $motivo = $_POST['motivo'] ?? null;
        $id_usuario = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : 0;

        if ($id_libro <= 0 || $id_usuario <= 0 || !$tipo || $cantidad <= 0) {
            echo json_encode([
                "success" => false,
                "message" => "Datos incompletos para el movimiento."
            ]);
            exit;
        }

        $res = registrarMovimientoInventario($id_libro, $id_usuario, $tipo, $cantidad, $motivo);
        echo json_encode($res);
        break;

    case 'listarMovimientos':
        $id_usuario = isset($_SESSION['id_perfil']) ? (int)$_SESSION['id_perfil'] : 0;
        if ($id_usuario !== 1) {
            echo json_encode([
                "success" => false,
                "message" => "No tienes permisos para ver los movimientos."
            ]);
            exit;
        }

        $id_libro = (int)($_GET['id_libro'] ?? 0);
        if ($id_libro <= 0) {
            echo json_encode([
                "success" => false,
                "message" => "ID de libro inválido."
            ]);
            exit;
        }

        $rows = listarMovimientosPorLibro($id_libro);
        echo json_encode([
            "success" => true,
            "data" => $rows
        ]);
        break;

    case 'ultimosMovimientos':
        $rows = listarUltimosMovimientos(5);
        echo json_encode([
            "success" => true,
            "data"    => $rows
        ]);
        break;    

    default:
        echo json_encode([
            "success" => false,
            "message" => "Acción no válida."
        ]);
        break;
}
