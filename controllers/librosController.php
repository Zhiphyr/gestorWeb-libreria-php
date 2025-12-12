<?php
session_start();
require_once("../models/librosModel.php");
require_once("../models/inventarioModel.php");
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarLibros':
        $libros = listarLibros();
        echo json_encode($libros);
        break;
        
    case 'listarLibrosActivos':
        $libros = listarLibrosActivos();
        echo json_encode($libros);
        break;

    case 'listarLibrosGestionCatalogo':
        $libros = listarLibrosGestionCatalogo();
        echo json_encode($libros);
        break;

    case 'obtenerLibroPorId':
        $id_libro = $_GET['id_libro'] ?? null;
        $libro = obtenerLibroPorId($id_libro);
        echo json_encode($libro);
        break;

    case 'registrarLibro':
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $id_categoria = $_POST['id_categoria'] ?? null;
        $id_autor = $_POST['id_autor'] ?? null;
        $id_editorial = $_POST['id_editorial'] ?? null;
        $anio_publicacion = $_POST['año_publicacion'] ?? null;
        $numero_paginas = $_POST['numero_paginas'] ?? null;
        $isbn = $_POST['isbn'] ?? null;
        $idioma = $_POST['idioma'] ?? null;
        $precio_compra = $_POST['precio_compra'] ?? null;
        $precio_venta = $_POST['precio_venta'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $stock_minimo = $_POST['stock_minimo'] ?? null;
        $mostrar_catalogo = isset($_POST['mostrar_catalogo']) ? 1 : 0;

        if (!$nombre || !$isbn || !$id_categoria || !$id_autor || !$id_editorial) {
            echo json_encode([
                "success" => false,
                "message" => "Datos obligatorios incompletos."
            ]);
            exit;
        }

        // SUBIR LA FOTO
        $rutaFoto = null;
        if (!empty($_FILES['foto']['name'])) {
            $directorio = "../uploads/libros/";
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
            // IDENTIFICADOR
            $nombreArchivo = time() . "_" . basename($_FILES['foto']['name']);
            $destino = $directorio . $nombreArchivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $rutaFoto = "uploads/libros/" . $nombreArchivo;
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Error al subir la imagen."
                ]);
                exit;
            }
        }  else {
            // USAR PORTADA DE GOOGLE
            $coverFromGoogle = $_POST['cover_from_google'] ?? null;

            if ($coverFromGoogle) {
                // VALIDAR URL
                if (filter_var($coverFromGoogle, FILTER_VALIDATE_URL)) {
                    $directorio = "../uploads/libros/";
                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0777, true);
                    }

                    // NOMBRE UNICO
                    $ext = '.jpg';
                    $nombreArchivo = time() . "_google" . $ext;
                    $destinoFisico = $directorio . $nombreArchivo;

                    // DESCARGAR IMAGEN
                    $contenido = @file_get_contents($coverFromGoogle);
                    if ($contenido !== false) {
                        if (file_put_contents($destinoFisico, $contenido) !== false) {
                            $rutaFoto = "uploads/libros/" . $nombreArchivo;
                        }
                    }
                }
            }
        }

        $datos = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'id_categoria' => (int)$id_categoria,
            'id_autor' => (int)$id_autor,
            'id_editorial' => (int)$id_editorial,
            'anio_publicacion' => (int)$anio_publicacion,
            'numero_paginas' => (int)$numero_paginas,
            'isbn' => $isbn,
            'idioma' => $idioma,
            'precio_compra' => (float)$precio_compra,
            'precio_venta' => (float)$precio_venta,
            'stock' => (int)$stock,
            'stock_minimo' => (int)$stock_minimo,
            'mostrar' => (int)$mostrar_catalogo
        ];

        $resultado = registrarLibro($datos, $rutaFoto);

        // REGISTRAR MOVIMIENTO INVENTARIO
        if ($resultado['success'] && $resultado['accion'] === 'creado' && $datos['stock'] > 0) {
            $id_usuario = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : 0;
            if ($id_usuario > 0 && !empty($resultado['id_libro'])) {
                registrarMovimientoInventario(
                    (int)$resultado['id_libro'],
                    $id_usuario,
                    'INICIAL',                 
                    (int)$datos['stock'],      
                    'Stock inicial al registrar el libro'
                );
            }
        }

        echo json_encode($resultado);
        break;

    // SELECT2
    case 'buscarCategorias':
        $term = $_GET['term'] ?? '';
        $data = buscarCategorias($term);
        echo json_encode(['results' => $data]);
        break;

    case 'buscarAutores':
        $term = $_GET['term'] ?? '';
        $data = buscarAutores($term);
        echo json_encode(['results' => $data]);
        break;

    case 'buscarEditoriales':
        $term = $_GET['term'] ?? '';
        $data = buscarEditoriales($term);
        echo json_encode(['results' => $data]);
        break;

    case 'crearAutorRapido':
        $nombre = $_POST['nombre'] ?? '';
        $res = crearAutorRapido($nombre);
        echo json_encode($res);
        break;

    case 'crearEditorialRapida':
        $nombre = $_POST['nombre'] ?? '';
        $res = crearEditorialRapida($nombre);
        echo json_encode($res);
        break;

    case 'actualizarLibro':
        $id_libro = (int)($_POST['id_libro'] ?? 0);
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $id_categoria = $_POST['id_categoria'] ?? null;
        $id_autor = $_POST['id_autor'] ?? null;
        $id_editorial = $_POST['id_editorial'] ?? null;
        $año_publicacion = $_POST['año_publicacion'] ?? null;
        $numero_paginas = $_POST['numero_paginas'] ?? null;
        $isbn = $_POST['isbn'] ?? null;
        $idioma = $_POST['idioma'] ?? null;
        $precio_compra = $_POST['precio_compra'] ?? null;
        $precio_venta = $_POST['precio_venta'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $stock_minimo = $_POST['stock_minimo'] ?? null;
        $foto_actual = $_POST['foto_actual'] ?? null;
        $mostrar_catalogo = isset($_POST['mostrar_catalogo']) ? 1 : 0;


        if ($id_libro <= 0 || !$nombre || !$isbn || !$id_categoria || !$id_autor || !$id_editorial) {
            echo json_encode([
                "success" => false,
                "message" => "Datos obligatorios incompletos."
            ]);
            exit;
        }

        // SI SE SUBE UNA NUEVA FOTO LA REEMPLAZA SI NO SE CONSERVA LA ACTUAL
        $rutaFotoFinal = $foto_actual;

        if (!empty($_FILES['foto']['name'])) {
            $directorio = "../uploads/libros/";
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
            $nombreArchivo = time() . "_" . basename($_FILES['foto']['name']);
            $destinoFisico = $directorio . $nombreArchivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destinoFisico)) {
                $rutaFotoFinal = "uploads/libros/" . $nombreArchivo;
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Error al subir la nueva imagen."
                ]);
                exit;
            }
        }

        $datos = [
            'id_libro' => $id_libro,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'id_categoria' => (int)$id_categoria,
            'id_autor' => (int)$id_autor,
            'id_editorial' => (int)$id_editorial,
            'año_publicacion' => (int)$año_publicacion,
            'numero_paginas' => (int)$numero_paginas,
            'isbn' => $isbn,
            'idioma' => $idioma,
            'precio_compra' => (float)$precio_compra,
            'precio_venta' => (float)$precio_venta,
            'stock' => (int)$stock,
            'stock_minimo' => (int)$stock_minimo,
            'mostrar' => (int)$mostrar_catalogo
        ];

        $resultado = actualizarLibro($datos, $rutaFotoFinal);
        echo json_encode($resultado);
        break;

    case 'actualizarLibroCatalogo':
        $id_libro = (int)($_POST['id_libro'] ?? 0);
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $id_categoria = $_POST['id_categoria'] ?? null;
        $id_autor = $_POST['id_autor'] ?? null;
        $id_editorial = $_POST['id_editorial'] ?? null;
        $año_publicacion = $_POST['año_publicacion'] ?? null;
        $numero_paginas = $_POST['numero_paginas'] ?? null;
        $isbn = $_POST['isbn'] ?? null;
        $idioma = $_POST['idioma'] ?? null;
        $foto_actual = $_POST['foto_actual'] ?? null;
        $mostrar_catalogo = isset($_POST['mostrar_catalogo']) ? 1 : 0;


        if ($id_libro <= 0 || !$nombre || !$isbn || !$id_categoria || !$id_autor || !$id_editorial) {
            echo json_encode([
                "success" => false,
                "message" => "Datos obligatorios incompletos."
            ]);
            exit;
        }

        // SI SE SUBE UNA NUEVA FOTO LA REEMPLAZA SI NO SE CONSERVA LA ACTUAL
        $rutaFotoFinal = $foto_actual;

        if (!empty($_FILES['foto']['name'])) {
            $directorio = "../uploads/libros/";
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
            $nombreArchivo = time() . "_" . basename($_FILES['foto']['name']);
            $destinoFisico = $directorio . $nombreArchivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destinoFisico)) {
                $rutaFotoFinal = "uploads/libros/" . $nombreArchivo;
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Error al subir la nueva imagen."
                ]);
                exit;
            }
        }

        $datos = [
            'id_libro' => $id_libro,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'id_categoria' => (int)$id_categoria,
            'id_autor' => (int)$id_autor,
            'id_editorial' => (int)$id_editorial,
            'año_publicacion' => (int)$año_publicacion,
            'numero_paginas' => (int)$numero_paginas,
            'isbn' => $isbn,
            'idioma' => $idioma,
            'mostrar' => (int)$mostrar_catalogo
        ];

        $resultado = actualizarLibroCatalogo($datos, $rutaFotoFinal);
        echo json_encode($resultado);
        break;    
        
    case 'cambiarEstadoLibro':
        $id_libro    = isset($_POST['id_libro']) ? (int)$_POST['id_libro'] : 0;
        $nuevoEstado = isset($_POST['nuevoEstado']) ? (int)$_POST['nuevoEstado'] : null;

        if ($id_libro <= 0 || $nuevoEstado === null) {
            echo json_encode([
                "success" => false,
                "message" => "Datos inválidos para cambiar el estado."
            ]);
            exit;
        }

        $resultado = cambiarEstadoLibro($id_libro, $nuevoEstado);
        echo json_encode($resultado);
        break;
    
    case 'eliminarLibro':
        $id_libro = isset($_POST['id_libro']) ? (int)$_POST['id_libro'] : 0;

        if ($id_libro <= 0) {
            echo json_encode([
                "success" => false,
                "message" => "Datos inválidos para eliminar el libro."
            ]);
            exit;
        }
        
        $resultado = eliminarLibro($id_libro);
        echo json_encode($resultado);
        break;

    case 'actualizarMostrar':
        $id_libro = isset($_POST['id_libro']) ? (int)$_POST['id_libro'] : 0;
        $mostrar  = isset($_POST['mostrar']) ? (int)$_POST['mostrar'] : null;

        if ($id_libro <= 0 || ($mostrar !== 0 && $mostrar !== 1)) {
            echo json_encode([
                "success" => false,
                "message" => "Datos inválidos."
            ]);
            exit;
        }

        $ok = actualizarCampoMostrar($id_libro, $mostrar);
        echo json_encode([
            "success" => $ok,
            "message" => $ok ? "Estado de publicación actualizado." : "No se pudo actualizar el estado."
        ]);
        break;    

    case 'librosBajoStock':
        $libros = listarLibrosBajoStock();
        echo json_encode($libros);
        break;

    case 'contadores':
        echo json_encode([
            'activos' => contarLibrosActivos()
        ]);
        break; 
        
    case 'topCategorias':
        $rows = topCategoriasMasLibros();

        $labels = [];
        $data   = [];
        foreach ($rows as $r) {
            $labels[] = $r['categoria'];
            $data[]   = (int)$r['total_libros'];
        }

        echo json_encode([
            'labels' => $labels,
            'data'   => $data
        ]);
        break;        
        
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}



?>