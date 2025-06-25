<!-- esta manera el buscador está integrado -->
<?php
$conectar = new mysqli("localhost", "root", "", "venta-productos");

$mostrar = "";
// $seleccionar = "SELECT * FROM productos ORDER BY id";
$seleccionar = "SELECT 
										productos.id, 
										productos.imagen, 
										productos.nombre, 
										productos.descripcion, 
										productos.categoria, 
										productos.stock, 
										productos.precio, 
										categoria.nombre 
								AS categoria FROM productos INNER JOIN categoria ON categoria.id = productos.categoria ORDER BY id";

if (isset($_POST['consulta'])) {
	$sal = $conectar->real_escape_string($_POST['consulta']);
	$seleccionar = "SELECT * FROM productos WHERE id LIKE '%$sal%' OR nombre LIKE '%$sal%' OR categoria LIKE '%$sal%' OR descripcion LIKE '%$sal%' OR precio LIKE '%$sal%'";
}
$resultado = $conectar->query($seleccionar);

if ($resultado->num_rows > 0) {

	$mostrar .= "
				<h1>Productos</h1>
				<hr>
				<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalNewProduct'>Agregar producto</button>
				<br><br>
				<table class='table'>
  			<thead class='table-light'>
					<tr>
						<th scope='col'>Nro</th>
						<th scope='col'>Imagen</th>
						<th scope='col'>Nombre</th>
						<th scope='col'>Categoria</th>
						<th scope='col'>Descripción</th>	
						<th scope='col'>Precio</th>	
						<th scope='col'>Stock</th>	
						<th scope='cols' colspan='3'>Acción</th>	
					</tr>
  			</thead>
  			<tbody>";

	while ($fila = $resultado->fetch_assoc()) {
		$mostrar .= "
						<tr>
							<td>" . $fila['id'] . "</td>
							<td>" . "<img width='100' height='100' src='./images/" . $fila['id'] . "/" . $fila['imagen'] . "'>" . " </td>
							<td>" . $fila['nombre'] . "</td>
							<td>" . $fila['categoria'] . "</td>
							<td>" . $fila['descripcion'] . "</td>
							<td>" . $fila['precio'] . "</td>	
							<td>" . $fila['stock'] . "</td>	

							<td> " . "<a href='./procesos/eliminarProducto.php?id=" . $fila['id'] . "'>Eliminar <i class='bx bxs-trash'></i></a> " . "</td>
              <td>
                " . "<a href='./formularioModificar.php?id=" . $fila['id'] . "' >Editar <i class='bx bxs-edit'></i></a>" . "
              </td>

							<td>" . "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#venderProducto' onclick='venderProducto(" . $fila['id'] . ")'>Vender</button>" . "
							</td>
						</tr>";
	}
	$mostrar .= "</tbody></table>";
} else {
	// $mostrar .= "No se encuentran resultados para la busqueda";
	// En caso de que no hayan resultados para la busqueda, se muestra la tabla en blanco
	$mostrar .= "
				<h1>Productos</h1>
				<hr>
				<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalNewProduct'>Agregar producto</button>
				<br><br>
				<table class='table'>
  			<thead class='table-light'>
					<tr>
						<th scope='col'>Nro</th>
						<th scope='col'>Imagen</th>
						<th scope='col'>Nombre</th>
						<th scope='col'>Categoria</th>
						<th scope='col'>Descripción</th>	
						<th scope='col'>Precio</th>	
						<th scope='col'>Stock</th>	
						<th scope='cols' colspan='3'>Acción</th>	
					</tr>
  			</thead>
  			<tbody>";
}
echo $mostrar;
$conectar->close();