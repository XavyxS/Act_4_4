<header>
  <div class="menu">

    <ul>
      <li class="logo">
        <img src="<?= base_url('images/Logo_JS_Software_200.png') ?>" alt="JS Software">
      <!-- <li class="menu-item hidden"><a href="/">Home</a></li> -->
      <!-- <?php $session = session(); ?> -->
      <li class="menu-item hidden"><a href="#">Usuario: <strong><?= esc($session->get('name')) ?></strong> </a></li>
      <li class="menu-item hidden"><a href="/logout">Cerrar Sesión</a></li>
    </ul>
  </div>
</header>