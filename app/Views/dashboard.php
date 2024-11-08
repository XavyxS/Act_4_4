<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">

</head>

<body>
  <?php include('header_user.php'); ?>
  <main>
    <?php $session = session(); ?>
    <h1>Bienvenido, <?= esc($session->get('name')) ?>!</h1>

  </main>
  <?php include('footer.php'); ?>

</body>

</html>