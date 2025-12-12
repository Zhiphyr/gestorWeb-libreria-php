<?php
require_once("../models/ventasModel.php");
session_start();
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {

    case 'registrarVenta':
        $id_tipo = (int)($_POST['id_tipo']     ?? 0);
        $id_cliente = (int)($_POST['id_cliente']  ?? 0);
        $subtotal = (float)($_POST['subtotal']  ?? 0);
        $desc_total = (float)($_POST['descuento_total'] ?? 0);
        $total = (float)($_POST['total']     ?? 0);
        $observacion = $_POST['observacion']       ?? '';

        $forma_pago = (int)($_POST['forma_pago']  ?? 1);
        $pago_inicial = (float)($_POST['pago_inicial'] ?? 0);

        $id_usuario = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : 0;

        if ($id_tipo <= 0 || $id_cliente <= 0 || $id_usuario <= 0 || $total <= 0) {
            echo json_encode([
                "success" => false,
                "message" => "Datos incompletos para registrar la venta."
            ]);
            exit;
        }

        $items = json_decode($_POST['items'] ?? '[]', true);
        if (!is_array($items) || count($items) == 0) {
            echo json_encode([
                "success" => false,
                "message" => "No hay items en la venta."
            ]);
            exit;
        }

        $cuotas = [];
        $saldo_pendiente = 0;

        if ($forma_pago === 2) {
            $cuotas = json_decode($_POST['cuotas'] ?? '[]', true);
            if (!is_array($cuotas) || count($cuotas) == 0) {
                echo json_encode([
                    "success" => false,
                    "message" => "Debe definir el plan de cuotas para una venta a crédito."
                ]);
                exit;
            }
            $saldo_pendiente = max($total - $pago_inicial, 0);
        } else {
            $pago_inicial = $total;
            $saldo_pendiente = 0;
        }

        $cabecera = [
            "id_tipo" => $id_tipo,
            "id_cliente" => $id_cliente,
            "id_usuario" => $id_usuario,
            "subtotal" => $subtotal,
            "descuento_total" => $desc_total,
            "total" => $total,
            "observacion" => $observacion,
            "forma_pago" => $forma_pago,
            "pago_inicial" => $pago_inicial,
            "saldo_pendiente" => $saldo_pendiente
        ];

        $res = registrarVenta($cabecera, $items, $cuotas);
        echo json_encode($res);
        break;

    case 'listarVentas':
        echo json_encode(listarVentas());
        break;

    case 'obtenerDetalleVenta':
        $id_venta = isset($_GET['id_venta']) ? (int)$_GET['id_venta'] : 0;
        if ($id_venta <= 0) {
            echo json_encode([
                "success" => false,
                "message" => "ID de venta inválido."
            ]);
            exit;
        }

        $info = obtenerDetalleVenta($id_venta);
        if (!$info) {
            echo json_encode([
                "success" => false,
                "message" => "Venta no encontrada."
            ]);
            exit;
        }

        echo json_encode([
            "success" => true,
            "cabecera" => $info['cabecera'],
            "detalle" => $info['detalle'],
            "cuotas" => $info['cuotas']
        ]);
        break;

    case 'registrarPagoCuota':
        $id_cuota = (int)($_POST['id_cuota'] ?? 0);
        $medio_pago = $_POST['medio_pago'] ?? '';
        $comentario = $_POST['comentario'] ?? '';

        if ($id_cuota <= 0 || $medio_pago === '') {
            echo json_encode([
                "success" => false,
                "message" => "Datos incompletos para registrar el pago."
            ]);
            exit;
        }

        $res = registrarPagoCuota($id_cuota, $medio_pago, $comentario);
        echo json_encode($res);
        break;
        
    case 'obtenerHistorialPagos':
        $id_venta = (int)($_GET['id_venta'] ?? 0);
        if ($id_venta <= 0) {
            echo json_encode(["success" => false, "message" => "ID de venta inválido."]);
            exit;
        }
        $info = obtenerHistorialPagos($id_venta);
        if (!$info) {
            echo json_encode(["success" => false, "message" => "Venta no encontrada."]);
            exit;
        }
        echo json_encode([
            "success" => true,
            "cabecera" => $info['cabecera'],
            "linea" => $info['linea']
        ]);
        break;    
    
    case 'anularVenta':
        $idventa = isset($_POST['id_venta']) ? (int)$_POST['id_venta'] : 0;
        $idusuario = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : 0;

        if ($idventa <= 0 || $idusuario <= 0) {
            echo json_encode(['success' => false, 'message' => 'Datos inválidos para anular la venta.']);
            exit;
        }

        $res = anularVenta($idventa, $idusuario);
        echo json_encode($res);
        break;

    case 'contadores':
        $ventasMes = contarVentasMesActual();
        echo json_encode([
            'ventas_mes' => $ventasMes
        ]);
        break;  
        
    case 'ingresos':
        $dia  = ingresosDiaActual();
        $mes  = ingresosMesActual();
        echo json_encode([
            'success' => true,
            'ingresos_dia' => $dia,
            'ingresos_mes' => $mes
        ]);
        break;    
    
    case 'ingresosMensuales':
        $año = isset($_GET['año']) ? (int)$_GET['año'] : (int)date('Y');
        $data = ingresosMensualesPorAño($año);
        echo json_encode([
            'success' => true,
            'año' => $año,
            'data' => $data
        ]);
        break;

    case 'cuotasPorCobrarMes':
        $data = cuotasPorCobrarMesActual();
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
        break;  
        
    case 'ultimasVentas':
        $data = ultimasVentasCompletadas(5);
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
        break;
        
    case 'topClientes':
        $info = topClientesMasCompras(5);
        echo json_encode([
            'success' => true,
            'labels' => $info['labels'],
            'data' => $info['data']
        ]);
        break;    
        
    default:
        echo json_encode([
            "success" => false,
            "message" => "Acción no válida"
        ]);
        break;

}

?>