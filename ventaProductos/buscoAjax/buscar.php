<?php
$conectar = new mysqli("localhost", "root", "", "buscotiempo");

$mostrar = "";
$seleccionar= "SELECT * FROM articulos ORDER BY id";

if (isset($_POST['consulta'])) {
	$sal= $conectar->real_escape_string($_POST['consulta']);
	$seleccionar= "SELECT id, nombre, marca, modelo, stock FROM articulos WHERE nombre LIKE '%$sal%' OR marca LIKE '%$sal%' OR modelo LIKE '%$sal%'";
}
$resultado = $conectar->query($seleccionar);

if ($resultado->num_rows>0) {
	
	$mostrar.="<table border=1>
				<thead>
					<tr>
						<td>Id</td>
						<td>Nombre</td>
						<td>Marca</td>
						<td>Modelo</td>
						<td>Stock</td>	
					</tr>
				</thead>
				<tbody>";
	while ($fila = $resultado->fetch_assoc()) {
			$mostrar.="<tr>
					<td>".$fila['id']."</td>
					<td>".$fila['nombre']."</td>
					<td>".$fila['marca']."</td>
					<td>".$fila['modelo']."</td>
					<td>".$fila['stock']."</td>	
						</tr>";
				}	
				$mostrar.="</tbody></table>";
	} else {
		$mostrar.="No se encuentran resultados para la busqueda";
	}
	echo $mostrar;
	$conectar->close();

?>