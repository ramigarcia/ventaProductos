<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/registro.css">
  <title>Registro</title>
</head>

<body>
  <!-- FORMULARIO -->
  <form action="./procesos/registrar.php" method="POST" onsubmit="return validar();" class="formulario">
    <legend>Crea tu cuenta</legend>
    <hr>
    <label for="name">
      <span>Nombre</span>
      <input type="text" name="nombre" id="nombre" required>
    </label>
    <label for="surname">
      <span>Apellido</span>
      <input type=" text" name="apellido" id="apellido" required>
    </label>
    <label for="user">
      <span>Usuario</span>
      <input type="text" name="usuario" id="usuario" required>
    </label>
    <label for="email">
      <span>Correo electronico</span>
      <input type="email" name="email" id="email" required>
    </label>
    <label for="pss">
      <span>Contraseña</span>
      <input type="password" name="contraseña" id="contraseña" required>
    </label>
    <button type="submit" class="btn">Crear Cuenta</button>
    <a class="iniciar" href="./index.php">Iniciar Sesión</a>
  </form>
  <script src="./js/validar.js"></script>
</body>

</html>