<?php
session_start();

if(empty($_POST["nombre"]) ||
    empty($_POST["password"])) 
    {
        header("Location: index.php?error=Favor de rellenar todos los campos");
    exit(1);  
}

require("Conexion.php");
if($conexion->connect_errno) {
    header("Location: index.php?error=No se pudo conectar a la base de datos");
    exit(2);
}

$resultado = $conexion->query("SELECT `nombre` FROM `usuarios` WHERE
    `nombre` = \"" . $_POST["nombre"] . "\" AND
    `password` = MD5(\"" . $_POST["password"] . "\")"
);

if(!$resultado->num_rows) {
    header("Location: index.php?error=Usuario o contraseña incorrectos");
    exit(3);
}

$_SESSION["usuario"] = $resultado->fetch_assoc()["nombre"];

$conexion->close();
header("Location: index.php");

?>