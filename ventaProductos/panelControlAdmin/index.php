<?php
session_start();
error_reporting(0);
$varSesion = $_SESSION['usuario'];

if ($varSesion == null || $varSesion = '') {
  echo '<script>
          alert("Has cerrado tu sesión. Debes iniciar sesión otra vez");
          window.history.go(-1);
        </script>';
  die();
} else {
  include '../conexionDB.php';

  $acentos = $conexion->query("SET NAMES 'utf8'");
  $id = $_REQUEST['id'];
  $SQL_cliente = "SELECT * FROM clientes";
  $respuesta_cliente = $conexion->query($SQL_cliente);
  $SQL_categoria = "SELECT * FROM categoria";
  $respuesta_categoria = $conexion->query($SQL_categoria);

  if (!$respuesta_categoria = $conexion->query($SQL_categoria)) {
    echo $conexion->error;
  }

  if (!$respuesta_cliente = $conexion->query($SQL_cliente)) {
    echo $conexion->error;
  }
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <!-- box icons -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS ALERTIFY -->
  <link rel="stylesheet" type="text/css" href="./alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="./alertify/css/themes/default.css">
  <!-- ESTILOS -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/header.css">
  <title>Productos | Proyecto Ecommerce</title>
  <!-- JQUERY -->
  <script type="text/javascript" src="./js/jquery-3.6.1.min.js"></script>
  <!-- ALERTIFY JS -->
  <script src="./alertify/alertify.js"></script>
  <!-- SCRIPT PERSONAL -->
  <script src="./js/funcionesProducto.js"></script>
  <style>
    /* .header .navegation-index{
      display: flex;
      justify-content: space-between;
      padding: 0 15px
    } */

    .container {
      position: relative;
    }

    #registros {
      width: 100%;
      position: absolute;
      top: 0;
    }

    #alertDeleteProduct {
      position: absolute;
      bottom: 0;
      right: 5px;
      border-radius: 10px;
      width: 200px;
      height: 40px;
      text-align: center;
      display: flex;
      justify-content: center;
    }

    thead {
      border-bottom: 2px solid black;
    }
  </style>
</head>

<body>
  <?php include('./layouts/header.php') ?>

  <!-- MODAL PARA AGREGAR UN NUEVO PRODUCTO ⬇⬇⬇⬇⬇⬇ -->
  <div class="modal fade" id="modalNewProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalNewProductLabel" aria-hidden="true">
    <div class="modal-dialog">
      <!-- CONTENIDO DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
      <div class="modal-content">
        <!-- CABECERA DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
        <div class="modal-header">
          <!-- TITULO DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
          <h5 class="modal-title" id="modalNewProductLabel">Agregar nuevo producto</h5>
          <!-- BOTON PARA CERRAR EL MODAL ⬇⬇⬇⬇⬇⬇ -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- CUERPO DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
        <div class="modal-body">
          <!-- FORMULARIO PARA AGREGAR NUEVO PRODUCTO ⬇⬇⬇⬇⬇⬇-->
          <form action="./procesos/subirProducto.php" method="post" enctype="multipart/form-data">
            <!-- id del producto -->
            <input type="hidden" id="idProducto">

            <label for="nombreProducto">Nombre del producto:</label><label id="alertNombreP"></label>
            <input type="text" name="nombreP" id="nombreProducto" class="form-control">

            <label for="categoria">Categoría:</label><label id="alertCategoriaP"></label>
            <select name="categoriaP" id="categoria" class="form-control">
              <!-- INCLUIMOS EL CODIGO PARA MOSTRAR LAS CATEGORIAS ⬇⬇⬇⬇ -->
              <?php
              // trae la conexion ⬇⬇⬇⬇
              require "../conexionDB.php";
              //me permite trabajar con caracteres españoles ⬇⬇⬇⬇
              $acentos = $conexion->query("SET NAMES 'utf8'");
              //selecciona todo los registros de la tabla categoria ⬇⬇⬇⬇
              $SQL = "SELECT * FROM categoria";
              //verifica y ejecuta la SQL ⬇⬇⬇⬇
              if (!$respuesta = $conexion->query($SQL)) {
                // si algo esta mal lo informa ⬇⬇⬇⬇
                echo $conexion->error;
              }

              //mientras tenga registros la variable "respuesta" ⬇⬇⬇⬇
              //se guarda en la variable "dato" cada uno de los campos ⬇⬇⬇⬇
              while ($dato = $respuesta->fetch_assoc()) {
                //genera los option dependiendo de los datos de la tabla categoria ⬇⬇⬇⬇
                echo "<option value='" . $dato["id"] . "'>" . $dato["nombre"] . "</option>";
              }
              ?>
            </select>

            <label for="imagenProducto">Imagen del producto:</label><label id="alertImagenP"></label>
            <input type="file" name="imagenP" id="imagenProducto" class="form-control">

            <label for="descripcion">Descripción</label><label id="alertDescripcionP"></label>
            <textarea name="descripcionP" id="descripcion" rows="1" class="form-control"></textarea>

            <label for="precio">Precio:</label><label id="alertPrecioP"></label>
            <input type="number" min="0" name="precioP" id="precio" class="form-control">

            <label for="stock">Stock:</label><label id="alertStockP"></label>
            <input type="number" min="0" name="stockP" id="stock" class="form-control">

            <div class="modal-footer">
              <!-- BOTON PARA CANCELAR -->
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <!-- BOTON PARA AGREGAR PRODUCTO -->
              <!-- <button type="submit" class="btn btn-primary" onclick="agregarProducto()">Agregar</button> -->
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </form>
        </div>
        <!-- PIE DEL MODAL -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="editProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="productoId" id="idproducto">

          <label for='nombreP'>Nombre</label><label id="alertNombre"></label>
          <input type='text' id='nombreP' class='form-control' name='nombre'>

          <label for='categoriaP'>Categoria</label><label id="alertCategoria"></label>
          <select name='categoria' id='categoriaP' class="form-control">
            <?php
            while ($dato1 = $respuesta_categoria->fetch_assoc()) {
              if ($dato1["id"] == $dato["categoria"]) { ?>
                <option selected value='<?php echo $dato1["id"] ?>'><?php echo $dato1["nombre"] ?></option>
              <?php } else { ?>
                <option value='<?php echo $dato1["id"] ?>'><?php echo $dato1["nombre"] ?></option>
              <?php } ?>
            <?php } ?>
          </select>

          <label for='descripcionP'>Descripción</label><label id="alertDescripcion"></label>
          <textarea id='descripcionP' rows='3' name='descripcion' class="form-control"></textarea>

          <label for='precioP'>Precio</label><label id="alertPrecio"></label>
          <input type='number' id='precioP' class="form-control" name='precio'>

          <label for='stockP'>Stock</label><label id="alertStock"></label>
          <input type='number' id='stockP' name='stock' class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" onclick="actualizarProducto()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>


  <main>
    <!-- SE CARGAN LOS REGISTROS -->
    <div class="container">
      <div id="registros"></div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
</body>

</html>