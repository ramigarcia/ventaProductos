<?php
require '../../conexionDB.php';

if (isset($_POST['idProductoD'])) {
  $id = $_POST['idProductoD'];
  $select_foto = "SELECT * FROM productos WHERE id = '$id'";
  $foto = $conexion->query($select_foto);
  $archivo = $foto->fetch_assoc();
  $foto1 = $archivo['imagen'];
  $SQL = "DELETE FROM productos WHERE id = '$id'";
  $resultado = $conexion->query($SQL);
  if ($resultado) {
    unlink(' /images/' . $id . '/' . $foto1);
    rmdir(' /images/' . $id);
  }else{
    echo "Error";
  }
}