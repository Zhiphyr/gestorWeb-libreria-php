<?php

require_once("../models/opcionesModel.php");
header('Content-Type: application/json');
session_start();

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'listarOpciones':
        if (!isset($_SESSION['id_perfil'])) {
            echo json_encode([
                'success'=>false, 
                'msg'=>'Sesión inválida']);
            exit;
        }

        $id_perfil = $_REQUEST['id_perfil'] ?? 0;
        $listaOpciones = obtenerOpcionesPerfil($id_perfil);
        echo json_encode(['success'=>true, 'data'=>$listaOpciones]);
        break;

    case 'obtenerPermisos':
        if (!isset($_REQUEST["id_perfil"])) {
            echo json_encode([
                "success" => false,
                "msg" => "Falta id_perfil"
            ]);
            exit;
        }

        $id = intval($_REQUEST["id_perfil"]);

        $todas = obtenerTodasOpciones();
        $asignadas = obtenerOpcionesAsignadas($id);

        echo json_encode([
            "success" => true,
            "data" => [
                "todas" => $todas,
                "asignadas" => $asignadas
            ]
        ]);
        break;

    case "guardarPermisos":
        $id = intval($_POST["id_perfil"]);
        $opciones = $_POST["opciones"] ?? [];

        $ok = guardarPermisos($id, $opciones);

        echo json_encode([
            "success" => $ok,
            "msg" => $ok ? "Permisos actualizados" : "Error al guardar"
        ]);
        break;    

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;   
}


?>