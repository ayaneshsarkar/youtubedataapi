<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>


<?php 

  $client = new Google_Client();
  $client->setClientId('1069726268917-ujklm8ishbk9kl7t1509sur73mems6di.apps.googleusercontent.com');
  $client->setClientSecret('jD7CE7mOxPZygmWHvzn7k9mJ');
  $client->setRedirectUri('https://fullstackayanesh.xyz');

  $client->addScope('email');
  $client->addScope('profile');

  session_start();

  if(isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token['error'])) {
      $client->setAccessToken($token['access_token']);

      $_SESSION['access_token'] = $token['access_token'];

      $service = new Google_Service_Oauth2($client);

      $data = $service->userinfo->get();

      if(!empty($data['given_name'])) {
        $_SESSION['first_name'] = $data['given_name'];
      }

      if(!empty($data['email'])) {
        $_SESSION['email'] = $data['email'];
      }
    }

  }


?>

  <!-- Navbar -->
  <nav id="navbar">
    <div class="container">
      <div class="navbar__content">
        <a href="#" class="navbar_logo">YOUTUBE API</a>
        <div class="navbar_menu">
        <?php if(!isset($_SESSION['access_token'])): ?>
          <li class="navbar_menu-list"><a id="login" href="<?= $client->createAuthUrl(); ?>">LOGIN</a></li>
        <?php else: ?>
          <li class="navbar_menu-list"><a id="logout" href="#">LOGOUT</a></li>
        <?php endif; ?>
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

  <?php if(isset($_SESSION['access_token'])): ?>
  <h1><?= $_SESSION['email']; ?></h1>
  <?php endif; ?>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>





  <!-- <form action="/" method="GET" id="loginForm" style="display: none">
          <input type="hidden" name="login" value="true">
        </form>
        <form action="/" method="GET" id="logoutForm" style="display: none">
          <input type="hidden" name="logout">
        </form> -->
