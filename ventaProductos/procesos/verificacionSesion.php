<?php
session_start();
error_reporting(0);
$varSesion = $_SESSION['usuario'];

if ($varSesion == null || $varSesion = '') {
  echo '<script>alert("Has cerrado tu sesión. Debes iniciar sesión otra vez");</script>';
  header("location: ../index.php");
  die();
}
?>