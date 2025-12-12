<?php
require_once("../conexionDB.php");

function registrarMovimientoInventario($id_libro, $id_usuario, $tipo, $cantidad, $motivo = null) {
    $cn = getConexion();
    $cn->begin_transaction();

    try {
        // 1) Leer stock actual
        $sqlSel = "SELECT stock FROM libros WHERE id_libro = ? FOR UPDATE";
        $stSel = $cn->prepare($sqlSel);
        $stSel->bind_param("i", $id_libro);
        $stSel->execute();
        $rsSel = $stSel->get_result();
        if (!$rsSel || $rsSel->num_rows == 0) {
            throw new Exception("Libro no encontrado.");
        }
        $row = $rsSel->fetch_assoc();
        $stock_anterior = (int)$row['stock'];
        $stSel->close();

        $cantidad = (int)$cantidad;
        if ($cantidad <= 0) {
            throw new Exception("La cantidad debe ser mayor a 0.");
        }

        // 2) Calcular nuevo stock según tipo
        if ($tipo === 'INGRESO' || $tipo === 'AJUSTE_POSITIVO') {
            $stock_nuevo = $stock_anterior + $cantidad;
        } elseif ($tipo === 'AJUSTE_NEGATIVO') {
            if ($cantidad > $stock_anterior) {
                throw new Exception("No se puede restar más stock del disponible.");
            }
            $stock_nuevo = $stock_anterior - $cantidad;
        } elseif ($tipo === 'INICIAL'){
            // Solo registrar el movimiento, sin modificar el stock
            $stock_nuevo = $stock_anterior;
        }else {
            throw new Exception("Tipo de movimiento inválido.");
        }
        
        // 3) Actualizar stock del libro
        if ($tipo !== 'INICIAL') {
            $sqlUpd = "UPDATE libros SET stock = ? WHERE id_libro = ?";
            $stUpd = $cn->prepare($sqlUpd);
            $stUpd->bind_param("ii", $stock_nuevo, $id_libro);
            if (!$stUpd->execute()) {
                throw new Exception("No se pudo actualizar el stock.");
            }
            $stUpd->close();
        }

        // 4) Registrar movimiento
        $sqlMov = "INSERT INTO movimientos_inventario
                    (id_libro, id_usuario, tipo, cantidad, stock_anterior, stock_nuevo, motivo)
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stMov = $cn->prepare($sqlMov);
        $stMov->bind_param(
            "iisiiis",
            $id_libro,
            $id_usuario,
            $tipo,
            $cantidad,
            $stock_anterior,
            $stock_nuevo,
            $motivo
        );
        if (!$stMov->execute()) {
            throw new Exception("No se pudo registrar el movimiento.");
        }
        $stMov->close();

        $cn->commit();
        $cn->close();

        return [
            "success" => true,
            "message" => "Movimiento registrado correctamente.",
            "stock_nuevo" => $stock_nuevo
        ];
    } catch (Exception $e) {
        $cn->rollback();
        $cn->close();
        return [
            "success" => false,
            "message" => $e->getMessage()
        ];
    }
}

function listarMovimientosPorLibro($id_libro) {
    $cn = getConexion();
    $sql = "SELECT 
                m.id_movimiento,
                m.tipo,
                m.cantidad,
                m.stock_anterior,
                m.stock_nuevo,
                m.motivo,
                m.fecha_mov,
                u.nombre AS usuario
            FROM movimientos_inventario m
            INNER JOIN usuarios u ON m.id_usuario = u.id
            WHERE m.id_libro = ?
            ORDER BY m.fecha_mov DESC";
    $st = $cn->prepare($sql);
    $st->bind_param("i", $id_libro);
    $st->execute();
    $rs = $st->get_result();
    $data = [];
    while ($f = $rs->fetch_assoc()) {
        $data[] = $f;
    }
    $st->close();
    $cn->close();
    return $data;
}

function listarUltimosMovimientos($limite) {
    $cn = getConexion();
    $sql = "SELECT 
                m.fecha_mov,
                m.tipo,
                m.cantidad,
                m.stock_anterior,
                m.stock_nuevo,
                m.motivo,
                l.nombre  AS libro,
                u.nombre  AS usuario
            FROM movimientos_inventario m
            INNER JOIN libros   l ON m.id_libro = l.id_libro
            INNER JOIN usuarios u ON m.id_usuario = u.id
            ORDER BY m.fecha_mov DESC
            LIMIT ?";
    $st = $cn->prepare($sql);
    $st->bind_param("i", $limite);
    $st->execute();
    $rs = $st->get_result();
    $data = [];
    while ($f = $rs->fetch_assoc()) {
        $data[] = $f;
    }
    $st->close();
    $cn->close();
    return $data;
}
