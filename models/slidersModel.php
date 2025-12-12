<?php
require_once("../conexionDB.php");

function listarSliders() {
    $conexion = getConexion();
    $sql = "SELECT id_slide, titulo, descripcion, imagen, enlace, orden, estado, fecha_creacion
            FROM sliders
            ORDER BY orden ASC, id_slide ASC";
    $res = $conexion->query($sql);
    $rows = [];
    if ($res && $res->num_rows > 0) {
        while ($f = $res->fetch_assoc()) {
            $rows[] = $f;
        }
    }
    $conexion->close();
    return $rows;
}

function listarSlidersActivos() {
    $conexion = getConexion();
    $sql = "SELECT id_slide, titulo, descripcion, imagen, enlace
            FROM sliders
            WHERE estado = 1
            ORDER BY orden ASC, id_slide ASC";
    $res = $conexion->query($sql);
    $rows = [];
    if ($res && $res->num_rows > 0) {
        while ($f = $res->fetch_assoc()) {
            $rows[] = $f;
        }
    }
    $conexion->close();
    return $rows;
}

function registrarSlider($datos, $rutaImagen) {
    $conexion = getConexion();
    $sql = "INSERT INTO sliders (titulo, descripcion, imagen, enlace, orden)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "ssssi",
        $datos['titulo'],
        $datos['descripcion'],
        $rutaImagen,
        $datos['enlace'],
        $datos['orden']
    );
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "message" => $ok ? "Slide registrado correctamente." : "No se pudo registrar el slide."
    ];
}

function eliminarSlider($id_slide) {
    $conexion = getConexion();
    $sql = "DELETE FROM sliders WHERE id_slide = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_slide);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "message" => $ok ? "Slide eliminado correctamente." : "No se pudo eliminar el slide."
    ];
}

function actualizarOrdenSliders($ordenArray) {
    $conexion = getConexion();
    $sql = "UPDATE sliders SET orden = ? WHERE id_slide = ?";
    $stmt = $conexion->prepare($sql);

    $okGlobal = true;
    $pos = 1;
    foreach ($ordenArray as $id_slide) {
        $id = (int)$id_slide;
        $stmt->bind_param("ii", $pos, $id);
        $ok = $stmt->execute();
        if (!$ok) $okGlobal = false;
        $pos++;
    }

    $stmt->close();
    $conexion->close();

    return [
        "success" => $okGlobal,
        "message" => $okGlobal ? "Orden actualizado correctamente." : "Error al actualizar el orden."
    ];
}
