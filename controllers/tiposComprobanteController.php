<?php
require_once("../models/tiposComprobanteModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {

    case 'listarTiposActivos':
        echo json_encode(listarTiposComprobanteActivos());
        break;

    case 'obtenerSiguienteNumeroVisual':
        $id_tipo = isset($_GET['id_tipo']) ? (int)$_GET['id_tipo'] : 0;
        if ($id_tipo <= 0) {
            echo json_encode(["success" => false, "message" => "id_tipo inválido"]);
            exit;
        }
        $info = obtenerSiguienteNumeroVisual($id_tipo);
        if (!$info) {
            echo json_encode(["success" => false, "message" => "Tipo de comprobante no encontrado"]);
            exit;
        }
        echo json_encode([
            "success" => true,
            "data" => $info
        ]);
        break;

    default:
        echo json_encode(["success" => false, "message" => "Acción no válida"]);
        break;
}
