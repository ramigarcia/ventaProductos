<?php
require '../conexionDB.php';

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$usuario = $_REQUEST["usuario"];
$email = $_REQUEST["email"];
$contraseña = $_REQUEST["contraseña"];

$SQL = "INSERT INTO usuarios(nombre, apellido, usuario, email, contraseña) VALUES ('$nombre', '$apellido', '$usuario', '$email', '$contraseña')";

$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");

if (mysqli_num_rows($verificar_usuario) > 0) {
  echo '<script>
      alert("Este usuario ya existe");
      window.history.go(-1);
  </script>';
  exit;
}

$verificar_email  = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");

if (mysqli_num_rows($verificar_email) > 0) {
  echo '<script>
    alert("Este correo ya existe");
    window.history.go(-1);
  </script>';
  exit;
}

//Ejecutamos la consulta INSERTAR ==> $SQL
$resultado = mysqli_query($conexion, $SQL);
if (!$resultado) {
  echo "Error al registrarse";
  echo $conexion->error;
} else {
  echo "
  Se ha registrado exitosamente, porfavor <a href='../index.php'>inicia tu sesión</a>
  ";
}
//cerramos la conexion//
mysqli_close($conexion);
