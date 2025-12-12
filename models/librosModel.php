<?php
require_once("../conexionDB.php");

// LISTAR LIBROS
function listarLibros(){
    $conexion = getConexion();
    $sql = "SELECT 
                l.id_libro,
                l.nombre,
                l.descripcion,
                l.id_categoria,
                c.nombre AS categoria,
                l.id_autor,
                a.nombre AS autor,
                l.id_editorial,
                e.nombre AS editorial,
                l.año_publicacion,
                l.numero_paginas,
                l.ISBN AS isbn,
                l.idioma,
                l.precio_compra,
                l.precio_venta,
                l.stock,
                l.stock_minimo,
                l.estado,
                l.foto,
                l.fecha_creacion,
                l.mostrar
            FROM libros l
            INNER JOIN categorias c ON l.id_categoria = c.id_categoria
            INNER JOIN autor a      ON l.id_autor = a.id_autor
            INNER JOIN editorial e  ON l.id_editorial = e.id_editorial
            WHERE l.estado IN (0,1)";
    $resultado = $conexion->query($sql);
    $libros = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
    }
    $conexion->close();
    return $libros;
}

function listarLibrosActivos(){
    $conexion = getConexion();
    $sql = "SELECT 
                l.id_libro,
                l.nombre,
                l.descripcion,
                l.id_categoria,
                c.nombre AS categoria,
                l.id_autor,
                a.nombre AS autor,
                l.id_editorial,
                e.nombre AS editorial,
                l.año_publicacion,
                l.numero_paginas,
                l.ISBN AS isbn,
                l.idioma,
                l.precio_compra,
                l.precio_venta,
                l.stock,
                l.stock_minimo,
                l.estado,
                l.foto,
                l.mostrar
            FROM libros l
            INNER JOIN categorias c ON l.id_categoria = c.id_categoria
            INNER JOIN autor a      ON l.id_autor = a.id_autor
            INNER JOIN editorial e  ON l.id_editorial = e.id_editorial
            WHERE l.estado = 1 AND l.stock > 0";
    $resultado = $conexion->query($sql);
    $libros = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
    }
    $conexion->close();
    return $libros;
}

function listarLibrosGestionCatalogo(){
    $conexion = getConexion();
    $sql = "SELECT 
                l.id_libro,
                l.nombre,
                l.descripcion,
                l.id_categoria,
                c.nombre AS categoria,
                l.id_autor,
                a.nombre AS autor,
                l.id_editorial,
                e.nombre AS editorial,
                l.año_publicacion,
                l.numero_paginas,
                l.ISBN AS isbn,
                l.idioma,
                l.precio_compra,
                l.precio_venta,
                l.stock,
                l.stock_minimo,
                l.estado,
                l.foto,
                l.fecha_creacion,
                l.mostrar
            FROM libros l
            INNER JOIN categorias c ON l.id_categoria = c.id_categoria
            INNER JOIN autor a      ON l.id_autor = a.id_autor
            INNER JOIN editorial e  ON l.id_editorial = e.id_editorial
            WHERE l.estado = 1";
    $resultado = $conexion->query($sql);
    $libros = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
    }
    $conexion->close();
    return $libros;
}

// REGISTRAR LIBRO
function registrarLibro($datos, $rutaFoto) {
    $conexion = getConexion();

    // BUSCAR SI YA EXISTE UN LIBRO CON ESE ISBN
    $sqlBuscar = "SELECT id_libro, estado, foto 
                  FROM libros 
                  WHERE ISBN = ? 
                  LIMIT 1";
    $stmtBuscar = $conexion->prepare($sqlBuscar);
    $stmtBuscar->bind_param("s", $datos['isbn']);
    $stmtBuscar->execute();
    $resultado = $stmtBuscar->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $libro        = $resultado->fetch_assoc();
        $id_libro     = $libro['id_libro'];
        $estadoActual = $libro['estado'];
        $fotoActual   = $libro['foto'];
        $stmtBuscar->close();

        if ($estadoActual == 2) {
            // "ELIMINADO" = RESTAURAR ACTUALIZANDO DATOS Y ESTADO
            // SI NO SUBEN NUEVA FOTO SE CONSERVA LA ANTERIOR
            $rutaFotoFinal = $rutaFoto ?: $fotoActual;

            $sqlRestaurar = "UPDATE libros SET
                                nombre = ?,
                                descripcion = ?,
                                id_categoria = ?,
                                id_autor = ?,
                                id_editorial = ?,
                                año_publicacion = ?,
                                numero_paginas = ?,
                                ISBN = ?,
                                idioma = ?,
                                precio_compra = ?,
                                precio_venta = ?,
                                stock = ?,
                                stock_minimo = ?,
                                foto = ?,
                                mostrar = ?,
                                estado = 1
                             WHERE id_libro = ?";
            $stmtRestaurar = $conexion->prepare($sqlRestaurar);
            $stmtRestaurar->bind_param(
                "ssiiiiissddissi",
                $datos['nombre'],
                $datos['descripcion'],
                $datos['id_categoria'],
                $datos['id_autor'],
                $datos['id_editorial'],
                $datos['anio_publicacion'],
                $datos['numero_paginas'],
                $datos['isbn'],
                $datos['idioma'],
                $datos['precio_compra'],
                $datos['precio_venta'],
                $datos['stock'],
                $datos['stock_minimo'],
                $rutaFotoFinal,
                $datos['mostrar'],
                $id_libro
            );
            $ok = $stmtRestaurar->execute();
            $stmtRestaurar->close();
            $conexion->close();

            return [
                "success"  => $ok,
                "accion"   => "restaurado",
                "message"  => $ok
                    ? "Libro restaurado correctamente."
                    : "No se pudo restaurar el libro."
            ];
        } else {
            $conexion->close();
            return [
                "success" => false,
                "accion"  => "duplicado",
                "message" => "Ya existe un libro activo o inactivo con ese ISBN."
            ];
        }
    }

    // NO EXISTE = INSERTAR NUEVO
    $stmtBuscar->close();

    $sql = "INSERT INTO libros (
            nombre, descripcion, id_categoria, id_autor, id_editorial,
            año_publicacion, numero_paginas, ISBN, idioma,
            precio_compra, precio_venta, stock, stock_minimo, foto, mostrar
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "ssiiiiissddiisi",
        $datos['nombre'],
        $datos['descripcion'],
        $datos['id_categoria'],
        $datos['id_autor'],
        $datos['id_editorial'],
        $datos['anio_publicacion'],
        $datos['numero_paginas'],
        $datos['isbn'],
        $datos['idioma'],
        $datos['precio_compra'],
        $datos['precio_venta'],
        $datos['stock'],
        $datos['stock_minimo'],
        $rutaFoto,
        $datos['mostrar']
    );

    $ok = $stmt->execute();
    $id_libro_nuevo = $conexion->insert_id;
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => $ok ? "creado" : "error",
        "id_libro" => $ok ? $id_libro_nuevo : null,
        "message" => $ok
            ? "Libro registrado correctamente."
            : "No se pudo registrar el libro."
    ];
}

// FUNCIONES PARA SELECT2

// CATEGORIAS ACTIVAS (PARA SELECT2)
function buscarCategorias($term = "") {
    $conexion = getConexion();
    $like = "%".$term."%";
    $sql = "SELECT id_categoria AS id, nombre AS text
            FROM categorias
            WHERE estado = 1 AND nombre LIKE ?
            ORDER BY nombre ASC
            LIMIT 20";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];
    while ($fila = $res->fetch_assoc()) {
        $data[] = $fila;
    }
    $stmt->close();
    $conexion->close();
    return $data;
}

// AUTORES ACTIVOS (PARA SELECT2)
function buscarAutores($term = "") {
    $conexion = getConexion();
    $like = "%".$term."%";
    $sql = "SELECT id_autor AS id, nombre AS text
            FROM autor
            WHERE estado = 1 AND nombre LIKE ?
            ORDER BY nombre ASC
            LIMIT 20";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];
    while ($fila = $res->fetch_assoc()) {
        $data[] = $fila;
    }
    $stmt->close();
    $conexion->close();
    return $data;
}

// EDITORIALES ACTIVAS (PARA SELECT2)
function buscarEditoriales($term = "") {
    $conexion = getConexion();
    $like = "%".$term."%";
    $sql = "SELECT id_editorial AS id, nombre AS text
            FROM editorial
            WHERE estado = 1 AND nombre LIKE ?
            ORDER BY nombre ASC
            LIMIT 20";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];
    while ($fila = $res->fetch_assoc()) {
        $data[] = $fila;
    }
    $stmt->close();
    $conexion->close();
    return $data;
}

// CREAR AUTOR RÁPIDO DESDE SELECT2
function crearAutorRapido($nombre) {
    $conexion = getConexion();
    $sql = "INSERT INTO autor (nombre) VALUES (?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $ok = $stmt->execute();
    $id = $conexion->insert_id;
    $stmt->close();
    $conexion->close();
    return [
        "success" => $ok,
        "id"      => $ok ? $id : null,
        "text"    => $nombre
    ];
}

// CREAR EDITORIAL RÁPIDA DESDE SELECT2
function crearEditorialRapida($nombre) {
    $conexion = getConexion();
    $sql = "INSERT INTO editorial (nombre) VALUES (?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $ok = $stmt->execute();
    $id = $conexion->insert_id;
    $stmt->close();
    $conexion->close();
    return [
        "success" => $ok,
        "id"      => $ok ? $id : null,
        "text"    => $nombre
    ];
}

// ACTUALIZAR LIBRO
function actualizarLibro($datos, $rutaFotoFinal) {
    $conexion = getConexion();

    // VALIDAR ISBN UNICO
    $sqlCheck = "SELECT id_libro FROM libros WHERE ISBN = ? AND id_libro <> ? LIMIT 1";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("si", $datos['isbn'], $datos['id_libro']);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();
    if ($resCheck && $resCheck->num_rows > 0) {
        $stmtCheck->close();
        $conexion->close();
        return [
            "success" => false,
            "accion"  => "duplicado",
            "message" => "Ya existe otro libro con ese ISBN."
        ];
    }
    $stmtCheck->close();

    $sql = "UPDATE libros SET
                nombre = ?,
                descripcion = ?,
                id_categoria = ?,
                id_autor = ?,
                id_editorial = ?,
                año_publicacion = ?,
                numero_paginas = ?,
                ISBN = ?,
                idioma = ?,
                precio_compra = ?,
                precio_venta = ?,
                stock = ?,
                stock_minimo = ?,
                foto = ?,
                mostrar = ?
            WHERE id_libro = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "ssiiiiissddiisii",
        $datos['nombre'],
        $datos['descripcion'],
        $datos['id_categoria'],
        $datos['id_autor'],
        $datos['id_editorial'],
        $datos['año_publicacion'],
        $datos['numero_paginas'],
        $datos['isbn'],
        $datos['idioma'],
        $datos['precio_compra'],
        $datos['precio_venta'],
        $datos['stock'],
        $datos['stock_minimo'],
        $rutaFotoFinal,
        $datos['mostrar'],
        $datos['id_libro']
    );

    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "actualizado",
        "message" => $ok
            ? "Libro actualizado correctamente."
            : "No se pudo actualizar el libro."
    ];
}

// ACTUALIZAR LIBRO CATALOGO
function actualizarLibroCatalogo($datos, $rutaFotoFinal) {
    $conexion = getConexion();

    // VALIDAR ISBN UNICO
    $sqlCheck = "SELECT id_libro FROM libros WHERE ISBN = ? AND id_libro <> ? LIMIT 1";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("si", $datos['isbn'], $datos['id_libro']);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();
    if ($resCheck && $resCheck->num_rows > 0) {
        $stmtCheck->close();
        $conexion->close();
        return [
            "success" => false,
            "accion"  => "duplicado",
            "message" => "Ya existe otro libro con ese ISBN."
        ];
    }
    $stmtCheck->close();

    $sql = "UPDATE libros SET
                nombre = ?,
                descripcion = ?,
                id_categoria = ?,
                id_autor = ?,
                id_editorial = ?,
                año_publicacion = ?,
                numero_paginas = ?,
                ISBN = ?,
                idioma = ?,
                foto = ?
            WHERE id_libro = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "ssiiiiisssi",
        $datos['nombre'],
        $datos['descripcion'],
        $datos['id_categoria'],
        $datos['id_autor'],
        $datos['id_editorial'],
        $datos['año_publicacion'],
        $datos['numero_paginas'],
        $datos['isbn'],
        $datos['idioma'],
        $rutaFotoFinal,
        $datos['id_libro']
    );

    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "actualizado",
        "message" => $ok
            ? "Libro actualizado correctamente."
            : "No se pudo actualizar el libro."
    ];
}

// CAMBIAR ESTADO
function cambiarEstadoLibro($id_libro, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE libros SET estado = ? WHERE id_libro = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $id_libro);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "cambiar_estado",
        "message" => $ok
            ? "Estado del libro actualizado correctamente."
            : "No se pudo actualizar el estado del libro."
    ];
}

// ELIMINAR O CAMBIAR ESTADO A 2
function eliminarLibro($id_libro) {
    $conexion = getConexion();
    $sql = "UPDATE libros 
            SET estado = 2
            WHERE id_libro = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_libro);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "eliminado",
        "message" => $ok
            ? "Libro eliminado correctamente."
            : "No se pudo eliminar el libro."
    ];
}

// ACTUALIZAR CAMPO MOSTRAR
function actualizarCampoMostrar($id_libro, $mostrar) {
    $cn = getConexion();
    $sql = "UPDATE libros SET mostrar = ? WHERE id_libro = ?";
    $st  = $cn->prepare($sql);
    $st->bind_param("ii", $mostrar, $id_libro);
    $ok = $st->execute();
    $st->close();
    $cn->close();
    return $ok;
}

// LISTAR LIBROS BAJO STOCK
function listarLibrosBajoStock() {
    $conexion = getConexion();
    $sql = "SELECT 
                id_libro,
                nombre,
                stock,
                stock_minimo
            FROM libros
            WHERE estado IN (0,1)
              AND stock < stock_minimo
            ORDER BY stock ASC";
    $resultado = $conexion->query($sql);
    $libros = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
    }
    $conexion->close();
    return $libros;
}

// CONTAR LIBROS ACTIVOS
function contarLibrosActivos() {
    $conexion = getConexion();
    $sql = "SELECT COUNT(*) AS total 
            FROM libros 
            WHERE mostrar=1";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $conexion->close();
    return (int)$fila['total'];
}

// TOP 7 CATEGORIAS CON MAS LIBROS PARA EL GRAFICO DE BARRAS DE DASHBOARD
function topCategoriasMasLibros() {
    $conexion = getConexion();
    $sql = "SELECT 
                c.nombre AS categoria,
                COUNT(l.id_libro) AS total_libros
            FROM categorias c
            LEFT JOIN libros l 
                ON l.id_categoria = c.id_categoria 
               AND l.mostrar = 1
            WHERE c.estado = 1
            GROUP BY c.id_categoria, c.nombre
            ORDER BY total_libros DESC
            LIMIT 7";
    $resultado = $conexion->query($sql);
    $rows = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $rows[] = $fila;
        }
    }
    $conexion->close();
    return $rows;
}

//OBTENER LIBRO POR ID_LIBRO
function obtenerLibroPorId($id_libro) {
    $conexion = getConexion();
    $sql = "SELECT 
                id_libro,
                nombre,
                descripcion,
                id_categoria,
                id_autor,
                id_editorial,
                año_publicacion,
                numero_paginas,
                ISBN AS isbn,
                idioma,
                precio_compra,
                precio_venta,
                stock,
                stock_minimo,
                estado,
                foto,
                fecha_creacion,
                mostrar
            FROM libros
            WHERE id_libro = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_libro);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $libro = $resultado->fetch_assoc();
    $stmt->close();
    $conexion->close();
    return $libro;
}

?>