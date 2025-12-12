<?php
require_once("../conexionDB.php");

// LISTAR OPCIONES ASIGNADAS A UN PERFIL
function obtenerOpcionesPerfil($id_perfil){
    $conexion = getConexion();
    $sql = "SELECT *
            FROM opciones o
            INNER JOIN perfil_opcion po 
                ON o.id = po.id_opcion
            WHERE po.id_perfil = ?
              AND o.estado = 1
            ORDER BY o.id ASC";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_perfil);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $listaOpciones = [];

    while ($fila = $resultado->fetch_assoc()){
        $listaOpciones[] = $fila;
    }
    
    $stmt->close();
    $conexion->close();
    return $listaOpciones;
}

//LISTAR TODOS LAS OPCIONES PARA EL CHECKBOX
function obtenerTodasOpciones(){
    $conexion = getConexion();
    $sql = "SELECT id, nombre, icono, ruta
            FROM opciones
            WHERE estado = 1
            ORDER BY id ASC";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $listaTodasOpciones = [];

    while ($fila = $resultado->fetch_assoc()){
        $listaTodasOpciones[] = $fila;
    }
    
    $stmt->close();
    $conexion->close();
    return $listaTodasOpciones;
}

// OBTENER OPCIONES ASIGNADAS A UN PERFIL
function obtenerOpcionesAsignadas($id_perfil){
    $conexion = getConexion();
    $sql = "SELECT id_opcion FROM perfil_opcion WHERE id_perfil = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_perfil);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $ids = [];

    while ($row = $resultado->fetch_assoc()) {
        $ids[] = intval($row["id_opcion"]);
    }

    $stmt->close();
    $conexion->close();
    return $ids;
}

//GUARDAR PERMISOS
function guardarPermisos($id_perfil, $opciones) {
    $conexion = getConexion();
    $conexion->begin_transaction();

    try {
        // BORRAR PERMISOS ANTERIORES
        $stmt = $conexion->prepare("DELETE FROM perfil_opcion WHERE id_perfil = ?");
        $stmt->bind_param("i", $id_perfil);
        $stmt->execute();

        // INSERTAR NUEVOS PERMISOS
        if (!empty($opciones)) {
            $stmtInsert = $conexion->prepare("INSERT INTO perfil_opcion (id_perfil, id_opcion) VALUES (?, ?)");

            foreach ($opciones as $id_opcion) {
                $stmtInsert->bind_param("ii", $id_perfil, $id_opcion);
                $stmtInsert->execute();
            }

            $stmtInsert->close();
        }

        $conexion->commit();
        return true;

    } catch (Throwable $e) {
        $conexion->rollback();
        return false;
    } finally {
        $conexion->close();
    }
}

?>