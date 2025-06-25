<?php
session_start();
$usuario = $_REQUEST['usuario'];
$_SESSION['usuario'] = $usuario;
$contraseña = $_REQUEST['contraseña'];

require '../conexionDB.php';

//consultamos si usuario y contraseña son iguales abajo
$SQL = "SELECT * FROM usuarios WHERE usuario = '" . $usuario . "' AND contraseña = '" . $contraseña . "'";

//ejecutamos la consulta abajo
$resultado = mysqli_query($conexion, $SQL);

//validamos abajo
$filas = mysqli_fetch_array($resultado);

if ($filas['type_user'] == "user") {
  header("location: ../public/index.php");
} else if ($filas['type_user'] == "admin") {
  header("location: ../panelControlAdmin/index.php");
} else {
  // echo "El usuario y/o contraseña es incorrecto";
  header("location: ../errorLogin.php");
}
mysqli_free_result($resultado);
mysqli_close($conexion);
