<?php
$clase_prod = $_GET["producto"];
?>
<table>
    <tr>
        <th> ID </th>
        <th> Nombre </th>
        <th> Marca </th>
        <th> Precio </th>
        <th> Contenido neto gr </th>
        <?php if($clase_prod == "botanas"): ?>
            <th> Sabor </th>
        <?php elseif($clase_prod == "lacteos"): ?>
            <th> Tipo de Lacteo </th>
        <?php elseif($clase_prod == "p_limpieza"): ?>
            <th> Superficie de Limpieza </th>
        <?php endif ?>
    </tr>
    <?php
        require("Conexion.php");
        $consulta="SELECT * FROM `productos` INNER JOIN `$clase_prod` ON `productos`.`id` = `$clase_prod`.`info_prod`";
        $resultado=$conexion->query($consulta);
        while ($producto=$resultado->fetch_assoc()){
            echo "<tr>";
            foreach($producto as $campo => $valor) {
                if($campo != "info_prod") {
                    echo "<td>$valor</td>";
                }
            }
            echo "</tr>";
        }
        $conexion->close();
    ?>
</table>