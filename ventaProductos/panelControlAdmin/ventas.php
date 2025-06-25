<!-- Incluyo un archivo para poder verificar si la sesión está iniciada o no -->
<?php include '../procesos/verificacionSesion.php' ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/header.css">
  <title>Ventas</title>
  <style>
    thead {
      border-bottom: 2px solid black;
    }
  </style>
</head>

<body>
  <?php include './layouts/header.php' ?>
  <main>
    <div class="container">
      <h1>Clientes</h1>
      <hr>
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Id Venta</th>
            <th>Id Cliente</th>
            <th>Id producto</th>
            <th>Cantidad</th>
            <th>Fecha Venta</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require '../conexionDB.php';
          $SQL = "SELECT * FROM ventas";
          if ($resultado = $conexion->query($SQL)) {
          } else {
            echo $conexion->error;
          }

          while ($mostrar = $resultado->fetch_assoc()) {
            ?>
            <tr>
              <td id="idc">
                <?php echo $mostrar['id_venta'] ?>
              </td>
              <td>
                <?php echo $mostrar['id_cliente'] ?>
              </td>
              <td>
                <?php echo $mostrar['id_producto'] ?>
              </td>
              <td>
                <?php echo $mostrar['cantidad'] ?>
              </td>
              <td>
                <?php echo $mostrar['fecha_venta'] ?>
              </td>
            </tr>
          </tbody>
        <?php } ?>
      </table>
    </div>
  </main>
</body>

</html>