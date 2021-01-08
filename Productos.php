	<br>
	<nav>
		<ul class="menu_productos">
			<?php
				$operaciones = array("Consultar", "Crear", "Modificar", "Eliminar");
				foreach ($operaciones as &$operacion) {
					echo "<li><a href=\"?producto=" . $_GET["producto"] . "&operacion=$operacion\" title=\"$operacion\"><span class=\"$operacion\"></span>$operacion</a></li>";
				}
			?>
		</ul>
	</nav>
