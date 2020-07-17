<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>


<?php 

  $client = new Google_Client();
  $client->setApplicationName('YouTube Data API');
  $client->setScopes(['https://www.googleapis.com/auth/youtube.force-ssl']);

  $client->setAuthConfig('./client_secret.json');
  $client->setAccessType('offline');

  // Request Auth from User
  $authUrl = $client->createAuthUrl();
  printf("Open this link in your browser:\n%s\n", $authUrl);
  print('Enter verification code: ');
  $authCode = trim(fgets(STDIN));

  //Exchange Auth Code for an Access Token
  $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
  $client->setAccessToken($accessToken);


?>

  <!-- Navbar -->
  <nav id="navbar">
    <div class="container">
      <div class="navbar__content">
        <a href="#" class="navbar_logo">YOUTUBE API</a>

        <div class="navbar_menu">
          <li class="navbar_menu-list"><a id="login" href="#">LOGIN</a></li>
          <li class="navbar_menu-list"><a id="logout" href="#">LOGOUT</a></li>
        </div>
      </div>
    </div>
  </nav>

  <!-- Form Section -->
  <section id="form">
    <div class="container">
      <form action="#" method="POST" class="index-form">
        <div class="inputbox">
          <label for="search-video">Search Videos</label>
          <input type="text" placeholder="Search Videos" name="search-video" id="videoSearch">
        </div>

        <div class="input_button">
          <button class="btn btn-dark">Search</button>
        </div>
      </form>
    </div>
  </section>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>