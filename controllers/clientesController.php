<?php
require_once("../models/clientesModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarClientes':
        echo json_encode(listarClientes());
        break;

    case 'registrarCliente':
        $nombre = $_POST['nombre'] ?? null;
        $documento = $_POST['documento'] ?? null;
        $telefono = $_POST['telefono'] ?? null;
        $correo = $_POST['correo'] ?? null;

        if (!$nombre || !$documento) {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Nombre y documento son obligatorios."
            ]);
            exit;
        }

        echo json_encode(registrarCliente($nombre, $documento, $telefono, $correo));
        break;

    case 'actualizarCliente':
        $id_cliente = isset($_POST['id_cliente']) ? (int)$_POST['id_cliente'] : 0;
        $nombre = $_POST['nombre'] ?? null;
        $telefono = $_POST['telefono'] ?? null;
        $correo = $_POST['correo'] ?? null;

        if ($id_cliente <= 0 || !$nombre) {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Datos inválidos para actualizar el cliente."
            ]);
            exit;
        }

        echo json_encode(actualizarCliente($id_cliente, $nombre, $telefono, $correo));
        break;

    case 'cambiarEstadoCliente':
        $id_cliente = isset($_POST['id_cliente']) ? (int)$_POST['id_cliente'] : 0;
        $nuevoEstado = isset($_POST['nuevoEstado']) ? (int)$_POST['nuevoEstado'] : null;

        if ($id_cliente <= 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Datos inválidos para cambiar el estado."
            ]);
            exit;
        }

        echo json_encode(cambiarEstadoCliente($id_cliente, $nuevoEstado));
        break;

    case 'eliminarCliente':
        $id_cliente = isset($_POST['id_cliente']) ? (int)$_POST['id_cliente'] : 0;

        if ($id_cliente <= 0) {
            echo json_encode([
                "success" => false,
                "accion"  => "validacion",
                "message" => "Datos inválidos para eliminar el cliente."
            ]);
            exit;
        }

        echo json_encode(eliminarCliente($id_cliente));
        break;

    case 'buscarOCrearClientePorDocumento':
        $documento = $_REQUEST['documento'] ?? '';
        $documento = trim($documento);

        if ($documento === '') {
            echo json_encode([
                "success" => false,
                "message" => "Debe ingresar un número de documento."
            ]);
            exit;
        }

        // BUSCAR EN LA BD
        $cli = buscarClientePorDocumento($documento);
        if ($cli) {
            echo json_encode([
                "success" => true,
                "origen"  => "bd",
                "cliente" => $cli
            ]);
            exit;
        }

        // NO EXISTE USAR API
        $url = '';
        if (strlen($documento) == 8) {
            $url = "https://miapi.cloud/v1/dni/" . $documento;
        } else {
            $url = "https://miapi.cloud/v1/ruc/" . $documento;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjo2MjIsImV4cCI6MTc2NTA3MjY1OH0.chzu244kjV7RoWz9bENDPLn3QHl_SBYaWWBbMi6cyLM',
            'Content-Type: application/json'
        ]);
        $resp = curl_exec($ch);
        if ($resp === false) {
            curl_close($ch);
            echo json_encode([
                "success" => false,
                "message" => "No se pudo conectar con el servicio de documentos."
            ]);
            exit;
        }
        curl_close($ch);

        $data = json_decode($resp, true);

        if (!isset($data['success']) || !$data['success'] || empty($data['datos'])) {
            echo json_encode([
                "success" => false,
                "message" => "No se encontraron datos para ese documento."
            ]);
            exit;
        }

        $datos = $data['datos'];
        if (strlen($documento) == 8) {
            // DNI
            $nombreCompleto = trim(
                ($datos['nombres'] ?? '') . ' ' .
                ($datos['ape_paterno'] ?? '') . ' ' .
                ($datos['ape_materno'] ?? '')
            );
        } else {
            // RUC
            $nombreCompleto = $datos['razon_social'] ?? ($datos['nombre'] ?? '');
        }

        if ($nombreCompleto === '') {
            echo json_encode([
                "success" => false,
                "message" => "La API no devolvió un nombre válido."
            ]);
            exit;
        }

        // REGISTRAR CLIENTE EN LA BD
        $nuevo = registrarClienteBasico($nombreCompleto, $documento);
        if (!$nuevo) {
            echo json_encode([
                "success" => false,
                "message" => "No se pudo registrar el cliente en la base de datos."
            ]);
            exit;
        }

        echo json_encode([
            "success" => true,
            "origen"  => "api",
            "cliente" => $nuevo
        ]);
        break;    

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
