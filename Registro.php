<?php

if(empty($_POST["nombre"]) ||
    empty($_POST["correo_electronico"]) ||
    empty($_POST["password"]) ||
    empty($_POST["confirmar_password"])
) {
    header("Location: index.php?registrarse=si&error=Favor de rellenar todos los campos");
    exit(1);  
}

if ($_POST["confirmar_password"]!=$_POST["password"]){
    header("Location: index.php?registrarse=si&error=Las contraseñas no coinciden");
    exit(2);
}

$conexion = new mysqli("localhost", "root", "", "bd_tienda");
if($conexion->connect_errno) {
    header("Location: index.php?registrarse=si&error=No se pudo conectar a la base de datos.");
    exit(3);
}

$conexion->query("INSERT INTO `usuarios`
    (`nombre`, `correo`, `password`) VALUES (
        \"" . $_POST["nombre"] . "\",
        \"" . $_POST["correo_electronico"] . "\",
        MD5(\"" . $_POST["password"] . "\")
    )"
);

$conexion->close();
header("Location: index.php?error=Usuario Registrado Correctamente");

?>