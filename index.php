<!DOCTYPE html>
<html>
<head>
	<?php
		session_start();
		$clases_producto = array(
		"botanas" => "Botanas",
		"lacteos" => "Lacteos",
		"p_limpieza" => "Productos de limpieza",
		"embutidos" => "Embutidos"
	); ?>
	<link rel="stylesheet" type="text/css" href="Estilo_Tienda.css?version=9">
	<meta charset="utf-8">
	<title> DON LATAS</title>
</head>
<body>
	<header>
	<center>
		<img src="imagenes/Chicharos.jpg" alt="Chicharos" height="150px" width="1366px" class="Chicharos_fondo">
		<h1> Tienda de abarrotes: DON LATAS </h1> 
	</center>
	</header>
<?php

if(isset($_GET["error"])) {
	echo "<div class=\"error\">" . $_GET["error"] . "</div>";
}

if (isset($_SESSION["usuario"])){
	echo "<div class=\"bienvenido\">Bienvenido " . $_SESSION["usuario"] . "</div>";
	include("Menu_principal.html");
}
else if (isset($_GET["registrarse"])){
	include ("Registro.html");
}
else{
	include ("Login.html"); 
}

if(isset($_GET["producto"])) {
	include("Productos.php");
	if(isset($_GET["operacion"])) {
		if($_GET["operacion"] == "Crear" || $_GET["operacion"] == "Modificar") {
			include("CrearModificarForm.php");
		}
		elseif($_GET["operacion"] == "Consultar"){
			include("Consultar.php");
		}
		elseif($_GET["operacion"] == "Eliminar"){
			include("EliminarForm.php");
		}
	}
	else {
		echo "<div class=\"nombre_producto\">" . $clases_producto[$_GET["producto"]] . "</div>";
		echo "<br>";
		echo "<img src=\"imagenes/" . $_GET["producto"] . ".png\" class=\"producto_imagen\">";
	}
} else {
	include("Bienvenido.html");
}

?>
	<footer>
		<center><h3>Hecho por: Isaac Coral Nuño 7-B1 17300486 </h3>
		</center>
	<?php if (isset($_SESSION["usuario"])): ?>
		<a href="Salir.php">Cerrar sesión</a>
	<?php endif ?>
	</footer>
</body>
</html>