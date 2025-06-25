<?php
include '../../conexionDB.php'; //INCLUIMOS LA CONEXIÓN A LA BASE DE DATOS
// RECIBIMOS LOS DATOS POR METODO POST, FILES Y LOS ALMACENAMOS EN SUS RESPECTIVAS VARIABLES
$nombreProducto = $_POST['nombreP'];
$categoria = $_POST['categoriaP'];
$descripcion = $_POST['descripcionP'];
$precio = $_POST['precioP'];
$stock = $_POST['stockP'];
$nombreImagen = uniqid() . $_FILES['imagenP']['name']; //Obtiene el nombre de la imagen
$tipo_imagen = $_FILES['imagenP']['type'];
$tamanio_imagen = $_FILES['imagenP']['size']; //Obtiene el nombre de la imagen
$archivo = $_FILES['imagenP']['type'];
$insertar = "INSERT INTO 
  productos (
    imagen, 
    nombre, 
    categoria, 
    descripcion, 
    precio, 
    stock
  ) 
  VALUES (
    '$nombreImagen',
    '$nombreProducto',
    '$categoria',
    '$descripcion',
    '$precio',
    '$stock'
  )";
$resultado = mysqli_query($conexion, $insertar);
$id_ultimo = $conexion->insert_id;
echo $conexion->error;
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/ventaProductos/panelControlAdmin/images/' . $id_ultimo . '/';
if (!file_exists($carpeta_destino)) {
  mkdir($carpeta_destino);
}
if ($resultado) {
  move_uploaded_file($_FILES['imagenP']['tmp_name'], $carpeta_destino . $nombreImagen);
} else {
  echo "error";
}
// INSERTAMOS LOS DATOS DEL PRODUCTO A LA BASE DE DATOS

if (!$resultado) {
  echo '
    <script>
    alert("Ocurrió un error al tratar de ingresar los datos del producto");
    window.history.go(-1);
    </script>';
} else {
  header("location: ../index.php");
}