<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>


<?php 

  session_start();

  $client = new Google_Client();
  $client->setAuthConfig('client_secret.json');
  $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
  $client->setRedirectUri('https://fullstackayanesh.xyz/loggedin');
  $client->setAccessType('offline');
  $client->setApprovalPrompt('consent');
  $client->setIncludeGrantedScopes(true);

  $authURL = $client->createAuthUrl();
  $authURL = filter_var($authURL, FILTER_SANITIZE_URL);

  if(isset($_GET['code'])) {

    $client->authenticate($_GET['code']);
    $accessToken = $client->getAccessToken();

    $client->setAccessToken($accessToken);
    $_SESSION['access_token'] = $accessToken;

    $oauth = new Google_Service_Oauth2($client);
    $data = $oauth->userinfo->get();

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
        <?php endif; ?>
        <?php if(isset($_SESSION['access_token'])): ?>
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
    <div class="container">
      <pre style="font-size: 1.6rem;">
        <?php print_r($data); ?>
      </pre>
    </div>
  <?php endif; ?>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>





  <!-- <form action="/" method="GET" id="loginForm" style="display: none">
          <input type="hidden" name="login" value="true">
        </form>
        <form action="/" method="GET" id="logoutForm" style="display: none">
          <input type="hidden" name="logout">
        </form> -->
