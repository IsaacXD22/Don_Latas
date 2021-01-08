<br>
<?php
$producto = $_GET["producto"];
$operacion = $_GET["operacion"];
echo "<form action=\"CrearModificar.php?producto=$producto&operacion=$operacion\" method=\"POST\">";
?>
<center>
    <?php if($operacion == "Modificar"): ?>
        <input type="text" name="id" id="id" placeholder="ID del Producto"><br> <br>
    <?php endif ?>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto">   <br> <br>
    <input type="text" name="marca" id="marca" placeholder="Marca del producto"> <br> <br>
    <input type="text" name="precio" id="precio" placeholder="Precio"> <br> <br>
    <input type="text" name="contenido_neto_gr" id="Contenido_neto_gr" placeholder="Contenido en gramos"> <br> <br>
    <?php if($_GET["producto"] == "botanas"): ?>
        <input type="text" name="sabor" id="sabor" placeholder="Sabor"> <br> <br>
    <?php elseif($_GET["producto"] == "lacteos"):?>
        <input type="text" name="tipo_lacteo" id="tipo" placeholder="Tipo de Lacteo"> <br> <br>
    <?php elseif($_GET["producto"] == "p_limpieza"):?>
        <input type="text" name="superficie_limpieza" id="superficie_limpieza" placeholder="Superficie de Limpieza "> <br> <br>
    <?php endif ?>
    <input type="submit" value="Guardar" id="Boton">
</center>
</form><br>