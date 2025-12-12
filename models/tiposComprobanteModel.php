<?php
require_once("../conexionDB.php");

function listarTiposComprobanteActivos() {
    $cn = getConexion();
    $sql = "SELECT id_tipo, nombre, serie, correlativo_actual
            FROM tipos_comprobante
            WHERE estado = 1";
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

// devuelve y NO actualiza correlativo (solo para mostrar el próximo número)
function obtenerSiguienteNumeroVisual($id_tipo) {
    $cn = getConexion();
    $sql = "SELECT serie, correlativo_actual
            FROM tipos_comprobante
            WHERE id_tipo = ? AND estado = 1
            LIMIT 1";
    $st = $cn->prepare($sql);
    $st->bind_param("i", $id_tipo);
    $st->execute();
    $rs = $st->get_result();
    $out = null;
    if ($rs && $rs->num_rows > 0) {
        $row = $rs->fetch_assoc();
        $siguiente = (int)$row['correlativo_actual'] + 1;
        $out = [
            'serie'   => $row['serie'],
            'numero'  => $siguiente,
            'formato' => $row['serie'] . '-' . str_pad($siguiente, 6, '0', STR_PAD_LEFT)
        ];
    }
    $st->close();
    $cn->close();
    return $out;
}
