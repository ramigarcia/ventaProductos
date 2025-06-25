<!-- Incluyo un archivo para poder verificar si la sesión está iniciada o no -->
<?php include '../procesos/verificacionSesion.php' ?>

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
  <!-- ESTILOS -->
  <link rel="stylesheet" href="./css/header.css">
  <script type="text/javascript" src="../panelControlAdmin/js/jquery-3.6.1.min.js"></script>
  <script src="./js/funcionesProductos.js"></script>

  <title>Vista usuario</title>
</head>

<body>
  <header class="header">
    <!-- menu de navegacion -->
    <?php include './layouts/nav.php' ?>
    <div class="hero">
      <div class="container">
        <h1 class="hero-title">Joyeria Buen Gusto</h1>
      </div>
    </div>
  </header>
  <!-- MODALES -->
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
</body>

</html>