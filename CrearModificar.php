<?php

$producto = $_GET["producto"];
$operacion = $_GET["operacion"];

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$nombre = $_POST["nombre"];
$marca = $_POST["marca"]; 
$precio = $_POST["precio"];
$contenido_neto_gr = $_POST["contenido_neto_gr"];

$sabor = $_POST["sabor"];
$tipo_lacteo = isset($_POST["tipo_lacteo"]) ? $_POST["tipo_lacteo"] : "";
$superficie_limpieza = isset($_POST["superficie_limpieza"]) ? $_POST["superficie_limpieza"] : "";

require("Conexion.php");

if(
    empty($nombre) ||
    empty($marca) ||
    empty($precio) ||
    empty($contenido_neto_gr)
) {
    header("Location: index.php?producto=$producto&operacion=$operacion&error=Favor de rellenar todos los campos");
    exit(1);
}

if($operacion == "Modificar") {
    $consulta = "SELECT `info_prod` FROM `$producto` WHERE `id` = $id";
    if($prod = $conexion->query($consulta)->fetch_assoc()) {
        $id = $prod["info_prod"];
    } else {
        header("Location: index.php?producto=$producto&operacion=$operacion&error=El producto aún no existe");
        exit(1);
    }
}

if($operacion == "Crear") {
    $consulta = "INSERT INTO `productos` (`nombre`, `marca`, `precio`, `contenido_neto_gr`) VALUES (
        \"$nombre\", \"$marca\", $precio, $contenido_neto_gr
    )";
} elseif($operacion == "Modificar") {
    $consulta = "UPDATE `productos` SET
        `nombre`=\"$nombre\",
        `marca`=\"$marca\",
        `precio`=$precio,
        `contenido_neto_gr`=$contenido_neto_gr
        WHERE `id` = $id
    ";
}

$resultado = $conexion->query($consulta);
if($operacion == "Crear") {
    $id = $conexion->insert_id;
}

if($operacion == "Crear") {
    if($producto == "botanas") {
        $consulta = "INSERT INTO `botanas` (`info_prod`, `sabor`) VALUES
            ($id, \"$sabor\")";
    } elseif($producto == "lacteos") {
        $consulta = "INSERT INTO `lacteos` (`info_prod`, `tipo`) VALUES
            ($id, \"$tipo_lacteo\")";
    } elseif($producto == "p_limpieza") {
        $consulta = "INSERT INTO `p_limpieza` (`info_prod`, `superficie_limpieza`) VALUES
            ($id, \"$superficie_limpieza\")";    
    } else { // $producto == "embutidos"
        $consulta = "INSERT INTO `embutidos` (`info_prod`) VALUES
            ($id)";
    }
} elseif($operacion == "Modificar") {
    if($producto == "botanas") {
        $consulta = "UPDATE `botanas` SET `sabor`=\"$sabor\" WHERE `info_prod`=$id";
    } elseif($producto == "lacteos") {
        $consulta = "UPDATE `lacteos` SET `tipo`=\"$tipo_lacteo\" WHERE `info_prod`=$id";
    } elseif($producto == "p_limpieza") {
        $consulta = "UPDATE `p_limpieza` SET `superficie_limpieza`=\"$superficie_limpieza\" WHERE `info_prod`=$id";
    } else { // $producto == "embutidos"
        $consulta = "SELECT * FROM `usuarios`";
    }
}

$conexion->query($consulta);

$conexion->close();
header("Location: index.php?producto=$producto&operacion=$operacion&error=Producto registrado correctamente");

?>