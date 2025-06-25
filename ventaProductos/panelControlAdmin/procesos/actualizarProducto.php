<?php
/* require '../../conexionDB.php';
	$id = $_REQUEST['id'];
	$nombre = $_REQUEST['nombre'];
	$stock = $_REQUEST['stock'];
	$descripcion = $_REQUEST['descripcion'];
	$precio = $_REQUEST['precio'];
	$categoria = $_REQUEST['categoria'];

 $SQL = "UPDATE productos 
				 SET nombre='$nombre',
						 descripcion='$descripcion', 
						 categoria='$categoria', 
						 stock='$stock', 
						 precio= '$precio' 
				 WHERE 
						 productos.id = '$id'";

 if (!$respuesta = $conexion->query($SQL)) {
	 echo $conexion->error;
 } else {
	 header("location: ../index.php");
 }*/

include '../../conexionDB.php';
//pasar parametros al modal
if (isset($_POST['idproducto'])) {
	$id_p = $_POST['idproducto'];
	$sql_p = "SELECT * FROM productos WHERE id = $id_p";
	$resultado = $conexion->query($sql_p);
	$arreglo = array();
	while ($dato = $resultado->fetch_assoc()) {
		$arreglo = $dato;
	}
	echo json_encode($arreglo);
} else {
	$arreglo['status'] = 200;
	$arreglo['message'] = "Registro Inexistente";
}

//actualizar producto
if (isset($_POST['productId'])) {
	$id = $_POST['productId'];
	$nombre = $_POST['productNombre'];
	$categoria = $_POST['productCategoria'];
	$descripcion = $_POST['productDescripcion'];
	$precio = $_POST['productPrecio'];
	$stock = $_POST['productStock'];
	$sql_up = "UPDATE productos SET nombre ='$nombre', categoria ='$categoria', descripcion ='$descripcion', precio ='$precio', stock ='$stock' WHERE id = $id";
	$ejec = $conexion->query($sql_up);
}

?>