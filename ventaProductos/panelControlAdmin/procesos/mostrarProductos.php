<!-- esta manera el buscador no esta integrado -->

<?php
$conectar = new mysqli("localhost", "root", "", "venta-productos");
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

if (isset($_POST['mostrar'])) {
	?>
	<h1>Productos</h1>
	<hr>
	<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalNewProduct'>Agregar producto</button>
	<br><br>
	<table class='table table-striped table-sm'>
		<thead>
			<tr>
				<th>Nro</th>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Categoria</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Stock</th>
				<th>Eliminar</th>
				<th>Editar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$resultado = $conectar->query($seleccionar);
			while ($fila = $resultado->fetch_assoc()) {
				?>
				<tr>
					<td id="idp">
						<?php echo $fila['id'] ?>
					</td>
					<td>
						<img width='100' height='100' src='./images/<?php echo $fila['id'] ?>/<?php echo $fila['imagen'] ?>'>
					</td>
					<td>
						<?php echo $fila['nombre'] ?>
					</td>
					<td>
						<?php echo $fila['categoria'] ?>
					</td>
					<td>
						<?php echo $fila['descripcion'] ?>
					</td>
					<td>
						<?php echo $fila['precio'] ?>
					</td>
					<td>
						<?php echo $fila['stock'] ?>
					</td>

					<td>
						<button onclick="si_no_delete(<?php echo $fila['id'] ?>)" type='button' class='btn btn-danger'>Eliminar</button>
					</td>

					<td>
						<button onclick="editProducto(<?php echo $fila['id'] ?>)" type='button' class='btn btn-primary'
							data-bs-toggle='modal' data-bs-target='#editProducto'>Editar</button>
					</td>
				</tr>
				<?php
			}
}
?>