<?php
require_once("../conexionDB.php");

// REGISTRAR VENTA CON TRANSACCIÓN
function registrarVenta($cabecera, $items, $cuotas = []) {
    $cn = getConexion();
    $cn->begin_transaction();

    try {
        // OBTENER CORRELATIVO ACTUAL
        $sqlCorr = "SELECT serie, correlativo_actual
                    FROM tipos_comprobante
                    WHERE id_tipo = ? AND estado = 1
                    FOR UPDATE";
        $stCorr = $cn->prepare($sqlCorr);
        $stCorr->bind_param("i", $cabecera['id_tipo']);
        $stCorr->execute();
        $rsCorr = $stCorr->get_result();

        if (!$rsCorr || $rsCorr->num_rows == 0) {
            throw new Exception("Tipo de comprobante no encontrado o inactivo.");
        }

        $rowCorr  = $rsCorr->fetch_assoc();
        $numero   = (int)$rowCorr['correlativo_actual'] + 1;
        $serie    = $rowCorr['serie'];
        $stCorr->close();

        // ACTUALIZAR CORRELATIVO ACTUAL
        $sqlUpd = "UPDATE tipos_comprobante
                   SET correlativo_actual = ?
                   WHERE id_tipo = ?";
        $stUpd = $cn->prepare($sqlUpd);
        $stUpd->bind_param("ii", $numero, $cabecera['id_tipo']);
        if (!$stUpd->execute()) {
            throw new Exception("No se pudo actualizar el correlativo.");
        }
        $stUpd->close();

        // INSERTAR CABECERA DE VENTA
        $sqlV = "INSERT INTO ventas (
                    id_tipo, numero, id_cliente, id_usuario,
                    subtotal, descuento_total, total, observacion,
                    forma_pago, pago_inicial, saldo_pendiente
                 ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stV = $cn->prepare($sqlV);
        $stV->bind_param(
            "iiiidddsdid",
            $cabecera['id_tipo'],
            $numero,
            $cabecera['id_cliente'],
            $cabecera['id_usuario'],
            $cabecera['subtotal'],
            $cabecera['descuento_total'],
            $cabecera['total'],
            $cabecera['observacion'],
            $cabecera['forma_pago'],
            $cabecera['pago_inicial'],
            $cabecera['saldo_pendiente']
        );
        if (!$stV->execute()) {
            throw new Exception("No se pudo registrar la venta.");
        }
        $id_venta = $cn->insert_id;
        $stV->close();

        // INSERTAR DETALLE Y ACTUALIZAR STOCK
        $sqlD = "INSERT INTO detalle_ventas
                    (id_venta, id_libro, cantidad, precio_unit, desc_monto, subtotal)
                 VALUES (?, ?, ?, ?, ?, ?)";
        $stD = $cn->prepare($sqlD);

        $sqlStock = "UPDATE libros
                     SET stock = stock - ?
                     WHERE id_libro = ? AND stock >= ?";
        $stStock = $cn->prepare($sqlStock);

        $sqlGetStock = "SELECT stock FROM libros WHERE id_libro = ? FOR UPDATE";
        $stGetStock  = $cn->prepare($sqlGetStock);

        $sqlMov = "INSERT INTO movimientos_inventario
                    (id_libro, id_usuario, tipo, cantidad, stock_anterior, stock_nuevo, motivo)
                 VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stMov = $cn->prepare($sqlMov);

        foreach ($items as $it) {
            $id_libro   = (int)$it['id_libro'];
            $cantidad   = (int)$it['cantidad'];
            $precio     = (float)$it['precio'];
            $desc_monto = (float)$it['desc_monto'];
            $subtotal   = (float)$it['subtotal'];

            if ($cantidad <= 0 || $precio < 0 || $subtotal < 0) {
                throw new Exception("Datos de detalle inválidos.");
            }

            $stD->bind_param(
                "iiiddd",
                $id_venta,
                $id_libro,
                $cantidad,
                $precio,
                $desc_monto,
                $subtotal
            );
            if (!$stD->execute()) {
                throw new Exception("Error al registrar el detalle de la venta.");
            }

            // OBTENER STOCK ACTUAL (ANTES DEL CAMBIO)
            $stGetStock->bind_param("i", $id_libro);
            $stGetStock->execute();
            $rsStock = $stGetStock->get_result();
            if (!$rsStock || $rsStock->num_rows == 0) {
                throw new Exception("Libro no encontrado para movimiento de inventario.");
            }
            $rowStock      = $rsStock->fetch_assoc();
            $stockAnterior = (int)$rowStock['stock'];

            if ($stockAnterior < $cantidad) {
                throw new Exception("Stock insuficiente para el libro ID {$id_libro}.");
            }
            $stockNuevo = $stockAnterior - $cantidad;

            $stStock->bind_param("iii", $cantidad, $id_libro, $cantidad);
            if (!$stStock->execute() || $stStock->affected_rows == 0) {
                throw new Exception("Stock insuficiente para el libro ID {$id_libro}.");
            }

            // REGISTRAR MOVIMIENTO DE INVENTARIO TIPO VENTA
            $tipo   = 'VENTA';
            $motivo = 'Venta ID ' . $id_venta;

            $stMov->bind_param(
                "iisiiis",
                $id_libro,
                $cabecera['id_usuario'],
                $tipo,
                $cantidad,
                $stockAnterior,
                $stockNuevo,
                $motivo
            );
            if (!$stMov->execute()) {
                throw new Exception("No se pudo registrar el movimiento de inventario.");
            }
        }

        $stD->close();
        $stStock->close();
        $stGetStock->close();
        $stMov->close();

        // SI ES A CRÉDITO REGISTRAR CUOTAS
        if ($cabecera['forma_pago'] == 2) {
            if (empty($cuotas) || !is_array($cuotas)) {
                throw new Exception("Debe definir el plan de cuotas para una venta a crédito.");
            }

            $sqlC = "INSERT INTO cuotas_venta
                        (id_venta, numero_cuota, fecha_vencimiento, monto_cuota, monto_pagado, estado, observacion)
                     VALUES (?, ?, ?, ?, 0, 0, NULL)";
            $stC = $cn->prepare($sqlC);

            $sumaCuotas = 0;
            foreach ($cuotas as $c) {
                $num   = (int)$c['numero'];
                $fecha = $c['fecha'];
                $monto = (float)$c['monto'];

                if ($num <= 0 || $monto <= 0 || !$fecha) {
                    throw new Exception("Datos de cuota inválidos.");
                }

                $sumaCuotas += $monto;

                $stC->bind_param(
                    "iisd",
                    $id_venta,
                    $num,
                    $fecha,
                    $monto
                );
                if (!$stC->execute()) {
                    throw new Exception("No se pudo registrar la cuota {$num}.");
                }
            }
            $stC->close();

            $sumaCuotas = round($sumaCuotas, 2);
            if (abs($sumaCuotas - $cabecera['saldo_pendiente']) > 0.01) {
                throw new Exception("La suma de cuotas no coincide con el monto a financiar.");
            }
        }

        $cn->commit();
        $cn->close();

        $numeroDoc = $serie . '-' . str_pad($numero, 6, '0', STR_PAD_LEFT);

        return [
            "success"     => true,
            "id_venta"    => $id_venta,
            "numero"      => $numero,
            "numero_doc"  => $numeroDoc,
            "message"     => "Venta registrada correctamente."
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

function listarVentas() {
    $cn = getConexion();
    $sql = "SELECT
                v.id_venta,
                tc.nombre AS tipo_comprobante,
                tc.serie,
                v.numero,
                CONCAT(tc.serie, '-', LPAD(v.numero, 6, '0')) AS numero_boleta,
                c.nombre AS cliente,
                u.nombre AS vendedor,
                v.fecha_venta,
                v.total,
                v.estado,
                v.forma_pago,
                v.saldo_pendiente,
                v.fecha_venta AS fecha_registro,
                (SELECT COUNT(*)
                   FROM cuotas_venta cv
                  WHERE cv.id_venta = v.id_venta) AS total_cuotas,
                (SELECT COUNT(*)
                   FROM cuotas_venta cv
                  WHERE cv.id_venta = v.id_venta
                    AND cv.estado = 1) AS cuotas_pagadas
            FROM ventas v
            INNER JOIN tipos_comprobante tc ON v.id_tipo = tc.id_tipo
            INNER JOIN clientes c          ON v.id_cliente = c.id_cliente
            INNER JOIN usuarios u          ON v.id_usuario = u.id
            ORDER BY v.id_venta DESC";
    $rs = $cn->query($sql);
    $data = [];
    if ($rs && $rs->num_rows > 0) {
        while ($f = $rs->fetch_assoc()) {
            $data[] = $f;
        }
    }
    $cn->close();
    return $data;
}

function obtenerDetalleVenta($id_venta) {
    $cn = getConexion();

    // CABECERA
    $sqlCab = "SELECT
                    v.id_venta,
                    tc.serie,
                    v.numero,
                    CONCAT(tc.serie, '-', LPAD(v.numero, 6, '0')) AS numero_documento,
                    c.nombre AS cliente,
                    v.fecha_venta,
                    v.total,
                    v.forma_pago,
                    v.pago_inicial,
                    v.saldo_pendiente
               FROM ventas v
               INNER JOIN tipos_comprobante tc ON v.id_tipo = tc.id_tipo
               INNER JOIN clientes c          ON v.id_cliente = c.id_cliente
               WHERE v.id_venta = ?
               LIMIT 1";
    $stCab = $cn->prepare($sqlCab);
    $stCab->bind_param("i", $id_venta);
    $stCab->execute();
    $rsCab = $stCab->get_result();
    $cab = $rsCab && $rsCab->num_rows > 0 ? $rsCab->fetch_assoc() : null;
    $stCab->close();

    if (!$cab) {
        $cn->close();
        return null;
    }

    // DETALLE
    $sqlDet = "SELECT
                    l.nombre AS libro,
                    dv.precio_unit,
                    dv.cantidad,
                    dv.subtotal
               FROM detalle_ventas dv
               INNER JOIN libros l ON dv.id_libro = l.id_libro
               WHERE dv.id_venta = ?";
    $stDet = $cn->prepare($sqlDet);
    $stDet->bind_param("i", $id_venta);
    $stDet->execute();
    $rsDet = $stDet->get_result();
    $detalle = [];
    if ($rsDet && $rsDet->num_rows > 0) {
        while ($f = $rsDet->fetch_assoc()) {
            $detalle[] = $f;
        }
    }
    $stDet->close();

    // CUOTAS
    $cuotas = [];
    $sqlC = "SELECT
                id_cuota,
                numero_cuota,
                fecha_vencimiento,
                monto_cuota,
                monto_pagado,
                estado
             FROM cuotas_venta
             WHERE id_venta = ?
             ORDER BY numero_cuota ASC";
    $stC = $cn->prepare($sqlC);
    $stC->bind_param("i", $id_venta);
    $stC->execute();
    $rsC = $stC->get_result();
    while ($rowC = $rsC->fetch_assoc()) {
        $cuotas[] = $rowC;
    }
    $stC->close();

    $cn->close();

    return [
        "cabecera" => $cab,
        "detalle"  => $detalle,
        "cuotas"   => $cuotas
    ];
}

function registrarPagoCuota($id_cuota, $medio_pago, $comentario) {
    $cn = getConexion();
    $cn->begin_transaction();

    try {
        // OBTENER DATOS DE LA CUOTA Y VENTA
        $sqlQ = "SELECT c.id_venta, c.numero_cuota, c.monto_cuota, c.monto_pagado, c.estado,
                        v.saldo_pendiente
                 FROM cuotas_venta c
                 INNER JOIN ventas v ON c.id_venta = v.id_venta
                 WHERE c.id_cuota = ?
                 FOR UPDATE";
        $stQ = $cn->prepare($sqlQ);
        $stQ->bind_param("i", $id_cuota);
        $stQ->execute();
        $rsQ = $stQ->get_result();
        if (!$rsQ || $rsQ->num_rows == 0) {
            throw new Exception("Cuota no encontrada.");
        }
        $cuota = $rsQ->fetch_assoc();
        $stQ->close();

        // VALIDAR QUE NO HAYA CUOTAS ANTERIORES SIN PAGAR
        $sqlPrev = "SELECT COUNT(*) AS pendientes
                    FROM cuotas_venta
                    WHERE id_venta = ?
                      AND numero_cuota < ?
                      AND estado <> 1";
        $stPrev = $cn->prepare($sqlPrev);
        $stPrev->bind_param("ii", $cuota['id_venta'], $cuota['numero_cuota']);
        $stPrev->execute();
        $rsPrev = $stPrev->get_result();
        $rowPrev = $rsPrev->fetch_assoc();
        $stPrev->close();

        if ((int)$rowPrev['pendientes'] > 0) {
            throw new Exception("No se puede pagar esta cuota mientras existan cuotas anteriores sin pagar.");
        }

        // CALCULAR MONTO A PAGAR = SALDO DE LA CUOTA
        $montoCuota   = (float)$cuota['monto_cuota'];
        $yaPagado     = (float)$cuota['monto_pagado'];
        $saldoCuota   = round($montoCuota - $yaPagado, 2);
        if ($saldoCuota <= 0) {
            throw new Exception("Esta cuota ya está totalmente pagada.");
        }

        // INSERTAR PAGO
        $sqlP = "INSERT INTO pagos_cuota (id_cuota, monto_pagado, medio_pago, comentario)
                 VALUES (?, ?, ?, ?)";
        $stP = $cn->prepare($sqlP);
        $stP->bind_param("idss", $id_cuota, $saldoCuota, $medio_pago, $comentario);
        if (!$stP->execute()) {
            throw new Exception("No se pudo registrar el pago.");
        }
        $stP->close();

        // ACTUALIZAR CUOTA (MONTO_PAGADO Y ESTADO)
        $nuevoPagado = $yaPagado + $saldoCuota;
        $estado = 1;
        $sqlUpdC = "UPDATE cuotas_venta
                    SET monto_pagado = ?, estado = ?
                    WHERE id_cuota = ?";
        $stUpdC = $cn->prepare($sqlUpdC);
        $stUpdC->bind_param("dii", $nuevoPagado, $estado, $id_cuota);
        if (!$stUpdC->execute()) {
            throw new Exception("No se pudo actualizar la cuota.");
        }
        $stUpdC->close();

        // ACTUALIZAR SALDO PENDIENTE DE LA VENTA
        $nuevoSaldo = max(0, (float)$cuota['saldo_pendiente'] - $saldoCuota);
        $sqlUpdV = "UPDATE ventas
                    SET saldo_pendiente = ?
                    WHERE id_venta = ?";
        $stUpdV = $cn->prepare($sqlUpdV);
        $stUpdV->bind_param("di", $nuevoSaldo, $cuota['id_venta']);
        if (!$stUpdV->execute()) {
            throw new Exception("No se pudo actualizar el saldo de la venta.");
        }
        $stUpdV->close();

        $cn->commit();
        $cn->close();

        return [
            "success"        => true,
            "message"        => "Pago registrado correctamente.",
            "monto_pagado"   => $saldoCuota,
            "nuevo_saldo"    => $nuevoSaldo
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

function obtenerHistorialPagos($id_venta) {
    $cn = getConexion();

    // CABECERA BÁSICA + PAGO INICIAL Y TOTAL DE CUOTAS
    $sqlCab = "SELECT
                  v.id_venta,
                  CONCAT(tc.serie, '-', LPAD(v.numero, 6, '0')) AS numero_documento,
                  c.nombre AS cliente,
                  v.total,
                  v.pago_inicial,
                  (SELECT COUNT(*) FROM cuotas_venta WHERE id_venta = v.id_venta) AS num_cuotas
               FROM ventas v
               INNER JOIN tipos_comprobante tc ON v.id_tipo = tc.id_tipo
               INNER JOIN clientes c          ON v.id_cliente = c.id_cliente
               WHERE v.id_venta = ?
               LIMIT 1";
    $stCab = $cn->prepare($sqlCab);
    $stCab->bind_param("i", $id_venta);
    $stCab->execute();
    $rsCab = $stCab->get_result();
    $cab = $rsCab && $rsCab->num_rows > 0 ? $rsCab->fetch_assoc() : null;
    $stCab->close();

    if (!$cab) {
        $cn->close();
        return null;
    }

    // CUOTAS + PAGOS (LÍNEA DE TIEMPO)
    $sql = "SELECT
                c.id_cuota,
                c.numero_cuota,
                c.fecha_vencimiento,
                c.monto_cuota,
                c.monto_pagado,
                c.estado,
                p.id_pago,
                p.fecha_pago,
                p.medio_pago,
                p.comentario
            FROM cuotas_venta c
            LEFT JOIN pagos_cuota p ON c.id_cuota = p.id_cuota
            WHERE c.id_venta = ?
            ORDER BY c.numero_cuota ASC, p.fecha_pago ASC, p.id_pago ASC";
    $st = $cn->prepare($sql);
    $st->bind_param("i", $id_venta);
    $st->execute();
    $rs = $st->get_result();

    $linea = [];
    while ($row = $rs->fetch_assoc()) {
        $linea[] = $row;
    }
    $st->close();
    $cn->close();

    return [
        "cabecera" => $cab,
        "linea"    => $linea
    ];
}

function anularVenta($id_venta, $id_usuario) {
    $cn = getConexion();
    $cn->begin_transaction();

    try {
        // VERIFICAR ESTADO DE LA VENTA
        $sql = "SELECT estado, forma_pago FROM ventas WHERE id_venta = ? FOR UPDATE";
        $st  = $cn->prepare($sql);
        $st->bind_param("i", $id_venta);
        $st->execute();
        $rs = $st->get_result();
        if (!$rs || $rs->num_rows == 0) {
            throw new Exception("Venta no encontrada.");
        }
        $row = $rs->fetch_assoc();
        $st->close();

        if ((int)$row['estado'] == 0) {
            throw new Exception("La venta ya está anulada.");
        }

        // OBTENER DETALLE DE LA VENTA
        $sqlDet = "SELECT id_libro, cantidad FROM detalle_ventas WHERE id_venta = ?";
        $stDet  = $cn->prepare($sqlDet);
        $stDet->bind_param("i", $id_venta);
        $stDet->execute();
        $rsDet = $stDet->get_result();

        if (!$rsDet || $rsDet->num_rows == 0) {
            throw new Exception("La venta no tiene detalle de libros.");
        }

        // PREPARAR SENTENCIAS PARA STOCK + MOVIMIENTOS
        $sqlStock = "UPDATE libros SET stock = stock + ? WHERE id_libro = ?";
        $stStock  = $cn->prepare($sqlStock);

        $sqlMov = "INSERT INTO movimientos_inventario
                   (id_libro, id_usuario, tipo, cantidad, stock_anterior, stock_nuevo, motivo)
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stMov  = $cn->prepare($sqlMov);

        $tipo   = 'AJUSTE_POSITIVO';
        $motivoBase = 'Anulación de la venta ID ' . $id_venta;

        while ($det = $rsDet->fetch_assoc()) {
            $id_libro  = (int)$det['id_libro'];
            $cantidad = (int)$det['cantidad'];

            // LEER STOCK ACTUAL PARA REGISTRAR ANTERIOR/NUEVO
            $sqlStockSel = "SELECT stock FROM libros WHERE id_libro = ? FOR UPDATE";
            $stSel = $cn->prepare($sqlStockSel);
            $stSel->bind_param("i", $id_libro);
            $stSel->execute();
            $rsSel = $stSel->get_result();
            if (!$rsSel || $rsSel->num_rows == 0) {
                $stSel->close();
                throw new Exception("Libro no encontrado (ID $id_libro).");
            }
            $rowLibro = $rsSel->fetch_assoc();
            $stockAnterior = (int)$rowLibro['stock'];
            $stSel->close();

            $stockNuevo = $stockAnterior + $cantidad;

            // ACTUALIZAR STOCK
            $stStock->bind_param("ii", $cantidad, $id_libro);
            if (!$stStock->execute()) {
                throw new Exception("No se pudo actualizar el stock del libro ID $id_libro.");
            }

            // INSERTAR MOVIMIENTO DE INVENTARIO
            $motivo = $motivoBase;
            $stMov->bind_param(
                "iisiiis",
                $id_libro,
                $id_usuario,
                $tipo,
                $cantidad,
                $stockAnterior,
                $stockNuevo,
                $motivo
            );
            if (!$stMov->execute()) {
                throw new Exception("No se pudo registrar el movimiento de inventario.");
            }
        }

        $stDet->close();
        $stStock->close();
        $stMov->close();

        // SI ERA VENTA A CREDITO, MARCAR CUOTAS COMO ESTADO 4 (ANULADA)
        if ((int)$row['forma_pago'] == 2) {
            $sqlCuotas = "UPDATE cuotas_venta 
                          SET estado = 4, monto_pagado = 0
                          WHERE id_venta = ?";
            $stC = $cn->prepare($sqlCuotas);
            $stC->bind_param("i", $id_venta);
            if (!$stC->execute()) {
                throw new Exception("No se pudieron actualizar las cuotas de la venta.");
            }
            $stC->close();
        }

        // ANULAR VENTA Y ACTUALIZAR SALDO PENDIENTE A 0
        $sqlUpd = "UPDATE ventas SET estado = 0, saldo_pendiente = 0 WHERE id_venta = ?";
        $stUpd  = $cn->prepare($sqlUpd);
        $stUpd->bind_param("i", $id_venta);
        if (!$stUpd->execute()) {
            throw new Exception("No se pudo anular la venta.");
        }
        $stUpd->close();

        // CONFIRMAR TODO
        $cn->commit();
        $cn->close();

        return ['success' => true, 'message' => 'Venta anulada correctamente.'];

    } catch (Exception $e) {
        $cn->rollback();
        $cn->close();
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

function contarVentasMesActual() {
    $cn = getConexion();
    $sql = "SELECT COUNT(*) AS total
            FROM ventas
            WHERE estado = 1
              AND fecha_venta >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
              AND fecha_venta <  DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')";
    $rs = $cn->query($sql);
    $row = $rs && $rs->num_rows > 0 ? $rs->fetch_assoc() : ['total' => 0];
    $cn->close();
    return (int)$row['total'];
}

function ingresosDiaActual() {
    $cn = getConexion();

    // CONTADO DEL DÍA
    $sqlContado = "SELECT IFNULL(SUM(total), 0) AS total
                   FROM ventas
                   WHERE estado = 1
                     AND forma_pago = 1
                     AND DATE(fecha_venta) = CURDATE()";
    $rsC = $cn->query($sqlContado);
    $rowC = $rsC && $rsC->num_rows > 0 ? $rsC->fetch_assoc() : ['total' => 0];
    $contado = (float)$rowC['total'];

    // CREDITO DEL DÍA (PAGOS DE CUOTAS)
    $sqlCred = "SELECT IFNULL(SUM(pc.monto_pagado), 0) AS total
                FROM pagos_cuota pc
                INNER JOIN cuotas_venta cv ON pc.id_cuota = cv.id_cuota
                INNER JOIN ventas v        ON cv.id_venta = v.id_venta
                WHERE v.estado = 1
                  AND DATE(pc.fecha_pago) = CURDATE()";
    $rsCr = $cn->query($sqlCred);
    $rowCr = $rsCr && $rsCr->num_rows > 0 ? $rsCr->fetch_assoc() : ['total' => 0];
    $credito = (float)$rowCr['total'];

    $cn->close();
    return $contado + $credito;
}

function ingresosMesActual() {
    $cn = getConexion();

    // CONTADO MENSUAL
    $sqlContado = "SELECT IFNULL(SUM(total), 0) AS total
                   FROM ventas
                   WHERE estado = 1
                     AND forma_pago = 1
                     AND fecha_venta >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
                     AND fecha_venta <  DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')";
    $rsC = $cn->query($sqlContado);
    $rowC = $rsC && $rsC->num_rows > 0 ? $rsC->fetch_assoc() : ['total' => 0];
    $contado = (float)$rowC['total'];

    // CREDITO MENSUAL
    $sqlCred = "SELECT IFNULL(SUM(pc.monto_pagado), 0) AS total
                FROM pagos_cuota pc
                INNER JOIN cuotas_venta cv ON pc.id_cuota = cv.id_cuota
                INNER JOIN ventas v        ON cv.id_venta = v.id_venta
                WHERE v.estado = 1
                  AND pc.fecha_pago >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
                  AND pc.fecha_pago <  DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')";
    $rsCr = $cn->query($sqlCred);
    $rowCr = $rsCr && $rsCr->num_rows > 0 ? $rsCr->fetch_assoc() : ['total' => 0];
    $credito = (float)$rowCr['total'];

    $cn->close();
    return $contado + $credito;
}

function ingresosMensualesPorAño($año) {
    $cn = getConexion();
    $año = (int)$año;

    // CONTADO MENSUAL
    $sqlContado = "SELECT 
                      MONTH(fecha_venta) AS mes,
                      SUM(total) AS contado
                   FROM ventas
                   WHERE estado = 1
                     AND forma_pago = 1
                     AND YEAR(fecha_venta) = ?
                   GROUP BY MONTH(fecha_venta)";
    $stC = $cn->prepare($sqlContado);
    $stC->bind_param("i", $año);
    $stC->execute();
    $rsC = $stC->get_result();
    $contado = [];
    while ($r = $rsC->fetch_assoc()) {
        $contado[(int)$r['mes']] = (float)$r['contado'];
    }
    $stC->close();

    // CREDITO MENSUAL
    $sqlCred = "SELECT 
                    MONTH(pc.fecha_pago) AS mes,
                    SUM(pc.monto_pagado) AS credito
                FROM pagos_cuota pc
                INNER JOIN cuotas_venta cv ON pc.id_cuota = cv.id_cuota
                INNER JOIN ventas v        ON cv.id_venta = v.id_venta
                WHERE v.estado = 1
                  AND YEAR(pc.fecha_pago) = ?
                GROUP BY MONTH(pc.fecha_pago)";
    $stCr = $cn->prepare($sqlCred);
    $stCr->bind_param("i", $año);
    $stCr->execute();
    $rsCr = $stCr->get_result();
    $credito = [];
    while ($r = $rsCr->fetch_assoc()) {
        $credito[(int)$r['mes']] = (float)$r['credito'];
    }
    $stCr->close();

    $data = [];
    for ($m = 1; $m <= 12; $m++) {
        $data[] = [
            'mes'     => $m,
            'contado' => isset($contado[$m]) ? $contado[$m] : 0,
            'credito' => isset($credito[$m]) ? $credito[$m] : 0,
        ];
    }

    $cn->close();
    return $data;
}

function cuotasPorCobrarMesActual() {
    $cn = getConexion();

    $sql = "SELECT 
                cv.id_cuota,
                cv.id_venta,
                cv.numero_cuota,
                cv.fecha_vencimiento,
                cv.monto_cuota,
                cv.monto_pagado,
                (cv.monto_cuota - cv.monto_pagado) AS monto_pendiente,
                c.nombre AS cliente,
                CONCAT(tc.serie, '-', LPAD(v.numero, 6, '0')) AS numero_documento
            FROM cuotas_venta cv
            INNER JOIN ventas v          ON cv.id_venta = v.id_venta
            INNER JOIN clientes c        ON v.id_cliente = c.id_cliente
            INNER JOIN tipos_comprobante tc ON v.id_tipo = tc.id_tipo
            WHERE cv.estado = 0
              AND cv.fecha_vencimiento >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
              AND cv.fecha_vencimiento <  DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
            ORDER BY cv.fecha_vencimiento ASC";

    $rs = $cn->query($sql);
    $data = [];
    if ($rs && $rs->num_rows > 0) {
        while ($f = $rs->fetch_assoc()) {
            $data[] = $f;
        }
    }
    $cn->close();
    return $data;
}

function ultimasVentasCompletadas($limite = 5) {
    $cn = getConexion();
    $sql = "SELECT 
                v.id_venta,
                CONCAT(tc.serie, '-', LPAD(v.numero, 6, '0')) AS numero_documento,
                c.nombre AS cliente,
                u.nombre AS vendedor,
                v.total,
                v.forma_pago,
                v.fecha_venta
            FROM ventas v
            INNER JOIN tipos_comprobante tc ON v.id_tipo = tc.id_tipo
            INNER JOIN clientes c          ON v.id_cliente = c.id_cliente
            INNER JOIN usuarios u          ON v.id_usuario = u.id
            WHERE v.estado = 1
            ORDER BY v.fecha_venta DESC, v.id_venta DESC
            LIMIT ?";
    $st = $cn->prepare($sql);
    $st->bind_param("i", $limite);
    $st->execute();
    $rs = $st->get_result();
    $data = [];
    if ($rs && $rs->num_rows > 0) {
        while ($f = $rs->fetch_assoc()) {
            $data[] = $f;
        }
    }
    $st->close();
    $cn->close();
    return $data;
}

function topClientesMasCompras($limite = 5) {
    $cn = getConexion();

    $sql = "SELECT 
                c.nombre AS cliente,
                COUNT(v.id_venta) AS num_ventas,
                SUM(v.total)      AS total_comprado
            FROM ventas v
            INNER JOIN clientes c ON v.id_cliente = c.id_cliente
            WHERE v.estado = 1   -- solo ventas completadas
            GROUP BY c.id_cliente, c.nombre
            ORDER BY num_ventas DESC, total_comprado DESC
            LIMIT ?";

    $st = $cn->prepare($sql);
    $st->bind_param('i', $limite);
    $st->execute();
    $rs = $st->get_result();

    $labels = [];
    $data   = [];

    if ($rs && $rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $labels[] = $row['cliente'];
            $data[]   = (int)$row['num_ventas'];   // o $row['total_comprado'] si prefieres por monto
        }
    }

    $st->close();
    $cn->close();

    return [
        'labels' => $labels,
        'data'   => $data
    ];
}

?>
