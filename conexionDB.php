<?php

//Credenciales de la Base de Datos
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","123456");
define("DB_NAME","sistema_libreria");

//Función para obtener la conexión
function getConexion() {
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conexion->connect_error) {
        die("Error de conexión: ". $conexion->connect_error);
    }

    return $conexion;
}

?>