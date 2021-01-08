<?php
    $producto=$_GET["producto"];
    require("Conexion.php");
    $id=$_POST["id"];
    if(empty($id)){
        header("Location: index.php?producto=$producto&operacion=Eliminar&error=Favor de llenar el campo");
        exit(1);
    }
    $consulta = "SELECT `info_prod` FROM `$producto` WHERE `id` = $id";
    if($prod = $conexion->query($consulta)->fetch_assoc()) {
        $id = $prod["info_prod"];
    } else {
        header("Location: index.php?producto=$producto&operacion=Eliminar&error=El producto aún no existe");
        exit(2);
    }
    $consulta="DELETE FROM `$producto` WHERE `info_prod`=$id";
    $conexion->query($consulta);
    $consulta="DELETE FROM `productos` WHERE `id`=$id";
    $conexion->query($consulta);
    $conexion->close();
    header("Location: index.php?producto=$producto&operacion=Eliminar&error=El producto se elimino correctamente");
?>