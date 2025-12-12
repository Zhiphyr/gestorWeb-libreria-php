<?php
require_once("../models/slidersModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarSliders':
        echo json_encode(listarSliders());
        break;

    case 'listarSlidersActivos':
        echo json_encode(listarSlidersActivos());
        break;

    case 'registrarSlider':
        $titulo = $_POST['titulo'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $enlace = $_POST['enlace'] ?? null;

        if (empty($_FILES['imagen']['name'])) {
            echo json_encode([
                "success" => false,
                "message" => "La imagen es obligatoria."
            ]);
            exit;
        }

        $directorio = "../uploads/sliders/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $nombreArchivo = time() . "_" . basename($_FILES['imagen']['name']);
        $destinoFisico = $directorio . $nombreArchivo;

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $destinoFisico)) {
            echo json_encode([
                "success" => false,
                "message" => "Error al subir la imagen."
            ]);
            exit;
        }

        $rutaImagen = "uploads/sliders/" . $nombreArchivo;

        $sliders = listarSliders();
        $orden = count($sliders) + 1;

        $datos = [
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'enlace' => $enlace,
            'orden' => $orden
        ];

        echo json_encode(registrarSlider($datos, $rutaImagen));
        break;

    case 'eliminarSlider':
        $id_slide = isset($_POST['id_slide']) ? (int)$_POST['id_slide'] : 0;
        if ($id_slide <= 0) {
            echo json_encode([
                "success" => false,
                "message" => "ID inválido."
            ]);
            exit;
        }
        echo json_encode(eliminarSlider($id_slide));
        break;

    case 'actualizarOrden':
        $orden = $_POST['orden'] ?? [];
        if (!is_array($orden) || empty($orden)) {
            echo json_encode([
                "success" => false,
                "message" => "Datos de orden inválidos."
            ]);
            exit;
        }
        echo json_encode(actualizarOrdenSliders($orden));
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
