<?php
require_once("../conexionDB.php");

// LISTAR CLIENTES (activos e inactivos)
function listarClientes() {
    $conexion = getConexion();
    $sql = "SELECT id_cliente, nombre, documento, telefono, correo, estado, fecha_registro
            FROM clientes
            WHERE estado IN (0,1)";
    $res = $conexion->query($sql);
    $clientes = [];
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $clientes[] = $row;
        }
    }
    $conexion->close();
    return $clientes;
}

// REGISTRAR CLIENTE
function registrarCliente($nombre, $documento, $telefono, $correo) {
    $conexion = getConexion();

    // Evitar duplicar documento
    $sqlCheck = "SELECT id_cliente FROM clientes WHERE documento = ? LIMIT 1";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $documento);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();

    if ($resCheck && $resCheck->num_rows > 0) {
        $stmtCheck->close();
        $conexion->close();
        return [
            "success" => false,
            "accion"  => "duplicado",
            "message" => "Ya existe un cliente con ese documento."
        ];
    }
    $stmtCheck->close();

    $sql = "INSERT INTO clientes (nombre, documento, telefono, correo)
            VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $documento, $telefono, $correo);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => $ok ? "creado" : "error",
        "message" => $ok
            ? "Cliente registrado correctamente."
            : "No se pudo registrar el cliente."
    ];
}

// ACTUALIZAR CLIENTE
function actualizarCliente($id_cliente, $nombre, $telefono, $correo) {
    $conexion = getConexion();

    $sql = "UPDATE clientes
            SET nombre = ?, telefono = ?, correo = ?
            WHERE id_cliente = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $telefono, $correo, $id_cliente);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "actualizado",
        "message" => $ok
            ? "Cliente actualizado correctamente."
            : "No se pudo actualizar el cliente."
    ];
}

// CAMBIAR ESTADO 0/1
function cambiarEstadoCliente($id_cliente, $nuevoEstado) {
    $conexion = getConexion();
    $sql = "UPDATE clientes SET estado = ? WHERE id_cliente = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $nuevoEstado, $id_cliente);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "cambiar_estado",
        "message" => $ok
            ? "Estado del cliente actualizado correctamente."
            : "No se pudo actualizar el estado del cliente."
    ];
}

// ELIMINAR (SOFT DELETE -> estado = 2)
function eliminarCliente($id_cliente) {
    $conexion = getConexion();
    $sql = "UPDATE clientes SET estado = 2 WHERE id_cliente = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return [
        "success" => $ok,
        "accion"  => "eliminado",
        "message" => $ok
            ? "Cliente eliminado correctamente."
            : "No se pudo eliminar el cliente."
    ];
}

function buscarClientePorDocumento($documento) {
    $cn = getConexion();
    $sql = "SELECT id_cliente, nombre, documento 
            FROM clientes 
            WHERE documento = ? 
            LIMIT 1";
    $st = $cn->prepare($sql);
    $st->bind_param("s", $documento);
    $st->execute();
    $rs = $st->get_result();
    $cliente = $rs && $rs->num_rows > 0 ? $rs->fetch_assoc() : null;
    $st->close();
    $cn->close();
    return $cliente;
}

function registrarClienteBasico($nombre, $documento) {
    $cn = getConexion();
    $sql = "INSERT INTO clientes (nombre, documento) VALUES (?, ?)";
    $st = $cn->prepare($sql);
    $st->bind_param("ss", $nombre, $documento);
    $ok = $st->execute();
    $id = $ok ? $cn->insert_id : 0;
    $st->close();
    $cn->close();

    return $ok ? ['id_cliente'=>$id, 'nombre'=>$nombre, 'documento'=>$documento] : null;
}
