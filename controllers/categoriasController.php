<?php
require_once("../models/categoriasModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'obtenerCategorias':
        $categorias = obtenerCategorias();
        echo json_encode($categorias);
        break;

    case 'registrarCategoria':
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;

        if ($nombre === null || $nombre === '') {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "El nombre es obligatorio."
            ]);
            exit;
        }

        $resultado = registrarCategoria($nombre, $descripcion);
        echo json_encode($resultado);
        break;

    case 'actualizarCategoria':
        $id_categoria = isset($_POST['id_categoria']) ? (int)$_POST['id_categoria'] : 0;
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;

        if ($id_categoria <= 0 || $nombre === null || trim($nombre) === '') {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "Datos inválidos para actualizar la categoría."
            ]);
            exit;
        }

        $resultado = actualizarCategoria($id_categoria, $nombre, $descripcion);
        echo json_encode($resultado);
        break; 
        
    case 'cambiarEstadoCategoria':
        $id_categoria = isset($_POST['id_categoria']) ? (int)$_POST['id_categoria'] : 0;
        $nuevoEstado = isset($_POST['nuevoEstado']) ? (int)$_POST['nuevoEstado'] : null;

        if ($id_categoria <= 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "Datos inválidos para cambiar el estado."
            ]);
            exit;
        }

        $resultado = cambiarEstadoCategoria($id_categoria, $nuevoEstado);
        echo json_encode($resultado);
        break;

    case 'eliminarCategoria':
        $id_categoria = isset($_POST['id_categoria']) ? (int)$_POST['id_categoria'] : 0;

        if ($id_categoria <= 0) {
            echo json_encode([
                "success" => false,
                "accion" => "validacion",
                "message" => "Datos inválidos para eliminar la categoría."
            ]);
            exit;
        }

        $resultado = eliminarCategoria($id_categoria);
        echo json_encode($resultado);
        break;    

    case 'contadores':
        echo json_encode([
            'total' => contarCategoriasTotales(),
            'activas' => contarCategoriasActivas(),
            'inactivas' => contarCategoriasInactivas()
        ]);
        break;    
        
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}


?>