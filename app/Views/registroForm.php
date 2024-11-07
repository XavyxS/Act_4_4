<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">

</head>
<body>
<?php include('header.php'); ?>
  <main>
  <div class="conteiner">
    <h2>Registro de Usuario</h2>
    <form class="formulario" action="/registro" method="POST">
      <label for="name">Nombre:</label>
      <input type="text" name="name" require>
      <label for="email">Correo:</label>
      <input type="email" name="email" require>
      <label for="password">Contraseña</label>
      <input type="password" name="password" require>
      <div class="botones">
        <button class="stboton" type="submit">Registro</button>
      </div>
    </form>
  </div>
  </main>
  <?php include('footer.php'); ?>
  </body>
</html>
