<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JS Software</title>
</head>
<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">


<body>
  <header>
    <div class="menu">
      <ul>
        <li class="logo">
          <img src="<?= base_url('images/Logo_JS_Software_200.png') ?>" alt="JS Software">
        <li class="menu-item hidden"><a href="/">Home</a></li>
        <li class="menu-item hidden"><a href="/loginForm">Inicio de Sesión</a></li>
        <li class="menu-item hidden"><a href="/registroForm">Registro</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div class="hero">
      <h1>Bienvenidos a JS Software</h1>
      <h2>Desarrollando el Software del presente y del futuro</h2>
    </div>
  </main>

  <?php include('footer.php'); ?>
</body>

</html>