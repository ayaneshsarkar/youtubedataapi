<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>

  <!-- Navbar -->
  <nav id="navbar">
    <div class="container">
      <div class="navbar__content">
        <a href="#" class="navbar_logo">YOUTUBE API</a>

        <div class="navbar_menu">
          <li class="navbar_menu-list"><a href="#">LOGIN</a></li>
          <li class="navbar_menu-list"><a href="#">LOGOUT</a></li>
        </div>
      </div>
    </div>
  </nav>

  <!-- Form Section -->
  <section id="form">
    <div class="container">
      <form action="#" method="POST" class="index-form">
        <div class="inputbox">
          <label for="search-channel">Search Videos</label>
          <input type="text" placeholder="Search Videos" name="search-channel" id="channelSearch">
        </div>

        <div class="input_button">
          <button class="btn btn-dark">Search</button>
        </div>
      </form>
    </div>
  </section>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>