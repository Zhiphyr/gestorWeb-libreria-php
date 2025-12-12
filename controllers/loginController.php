<?php
require_once('../models/loginModel.php');
header('Content-Type: application/json');

$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {
    case 'login':
        $usuario = $_REQUEST['usuario'] ??'';
        $clave = $_REQUEST['clave'] ??'';
        $usuarioValido = verificarCredenciales($usuario, $clave);

        if (isset($usuarioValido['estado_login'])) {
            switch ($usuarioValido['estado_login']) {
                case 'no_existe':
                    echo json_encode(['success' => false, 'msg' => 'El usuario no existe.']);
                    break;

                case 'clave_incorrecta':
                    echo json_encode(['success' => false, 'msg' => 'Clave incorrecta.']);
                    break;

                case 'inactivo':
                    echo json_encode(['success' => false, 'msg' => 'Tu cuenta está inactiva. Contacta a un administrador.']);
                    break;

                case 'eliminado':
                    echo json_encode(['success' => false, 'msg' => 'Tu cuenta fue eliminada. Contacta a un administrador.']);
                    break;
            }
            exit;
        }

        if ($usuarioValido) {
            session_start();
            $_SESSION['id_usuario'] = $usuarioValido['id'];
            $_SESSION['usuario'] = $usuarioValido['usuario'];
            $_SESSION['nombre'] = $usuarioValido['nombre'];
            $_SESSION['id_perfil'] = $usuarioValido['id_perfil'];
            $_SESSION['perfil'] = $usuarioValido['perfil'];
            $_SESSION['estado'] = $usuarioValido['estado'];
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success'=> false]);
        }
        break;

    case 'logout':
        session_start();
        session_destroy();
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;     
}

?>