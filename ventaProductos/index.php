<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/iniciarSesion.css">
  <title>Iniciar sesión</title>
</head>

<body>
  <!-- FORMULARIO -->
  <form action="./procesos/iniciarSesion.php" class="formulario" method="POST">
    <legend>Inicia Sesión</legend>
    <hr>
    <label for="user">
      <span>Usuario</span>
      <input type="text" name="usuario" id="user" required>
    </label>
    <label for="pss">
      <span>Contraseña</span>
      <input type="password" name="contraseña" id="pss" required>
    </label>
    <button type="submit" class="btn">Iniciar Sesión</button>
  </form>
  <div class="buttom-f">
    <a class="register" href="registrarUsuario.php">Crear Cuenta</a>
    <a class="inicio" href="#">Recuperar contraseña</a>
  </div>
  <script src="js/validar.js"></script>
</body>

</html>