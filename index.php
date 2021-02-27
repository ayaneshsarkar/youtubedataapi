<?php require_once(__DIR__ . '/includes/header.php'); ?>
<?php require_once(__DIR__ . '/vendor/autoload.php'); ?>

<!-- FOR GOOGLE -->


<?php 

  $redirectURI = 'https://fullstackayanesh.xyz/loggedin';

  session_start();

  $client = new Google_Client();
  $client->setAuthConfig('client_secret.json');
  $client->addScope('profile');
  $client->addScope('email');
  $client->setRedirectUri($redirectURI);
  $client->setAccessType('offline');
  $client->setIncludeGrantedScopes(true);

  $authURL = $client->createAuthUrl();
  $authURL = filter_var($authURL, FILTER_SANITIZE_URL);

  if(isset($_GET['code'])) {
    $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $accessToken = $client->getAccessToken();
    $_SESSION['access_token'] = $accessToken;
    header('Location: ' . filter_var($redirectURI, FILTER_SANITIZE_URL));
  }

  if(isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);

    $oauth = new Google_Service_Oauth2($client);
    $data = $oauth->userinfo->get();

    $_SESSION['data'] = $data;
  }

  if(isset($_GET['logout'])) {

    unset($_SESSION['access_token']);
    unset($_SESSION['data']);

    $client->revokeToken();

    session_destroy();

    header('Location: /');
  }

  

  $inputValue = '';

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $unfilteredQuery = filter_input(INPUT_POST, 'search-video', FILTER_SANITIZE_STRING);
    $query = str_replace(' ', '+', $unfilteredQuery);

    $inputValue = htmlspecialchars($unfilteredQuery);

    // AIzaSyAth-FzxYIc5PSSuQAomHN5qQS8G8Bly0c

    $apiKey = '__YOUR_YOUTUBE_API_KEY__';

    $apiURL = "https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=25&q=$query&key=$apiKey";
    $apiURL = filter_var($apiURL, FILTER_SANITIZE_URL);

    $youtubeData = json_decode(file_get_contents($apiURL));

    $_SESSION['youtube_data'] = $youtubeData;

  }
  

?>


<!-- FOR FACEBOOK -->
<?php
/*
  session_start();

  $fb = new Facebook\Facebook([
    'app_id' => '297048008200610',
    'app_secret' => 'eae5abb7f5bfcb89dc075b16c0d529a4',
    'default_graph_version' => 'v2.3',
    // . . .
  ]);


  $helper = $fb->getRedirectLoginHelper();

  $accessToken = $helper->getAccessToken();
  $_SESSION['access_token'] = $aToken;

  // if(isset($_SESSION['access_token'])) {
  //   $aToken = $_SESSION['access_token'];
  // } else {
  //   $aToken = $helper->getAccessToken();
  // }

  if(isset($aToken)) {

    if(isset($_SESSION['access_token'])) {
      $fb->setDefaultAccessToken($_SESSION['access_token']);
    } else {
      $_SESSION['access_token'] = (string) $aToken;

      $oAuth2Client = $fb->getOAuth2Client();

      $longLiveAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['access_token']);
      $_SESSION['access_token'] = (string) $longLiveAccessToken;

      $fb->setDefaultAccessToken($_SESSION['access_token']);
    }

  }

  if(isset($_GET['code'])) {
    header('Location: /');
  }

  $graphResponse = $fb->get("me?fields=name,email,picture");
  $fbUser = $graphResponse->getGraphUser();

  $_SESSION['username'] = $fbUser;

  $permissions = ['email'];
  $fbLoginURL = $helper->getLoginUrl("https://fullstackayanesh.xyz/loggedin", $permissions);

  if($_GET['logout']) {
    unset($_SESSION['access_token']);
    unset($_SESSION['username']);

    session_destroy();

    header('Location: /');
  }
*/
/*
  session_start();

  if(isset($_GET['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    unset($_SESSION['fb_id']);

    session_destroy();
    header('Location: /');
  }

*/
  
?>

  <!-- Navbar -->
  <nav id="navbar">
    <div class="container">
      <div class="navbar__content">
        <a href="/" class="navbar_logo">YOUTUBE API</a>
        <div class="navbar_menu">
        <?php if(!isset($_SESSION['access_token'])): ?>
          <li class="navbar_menu-list" id="login">
            <a href="<?= $authURL; ?>">LOGIN</a>
          </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['access_token'])): ?>
          <li class="navbar_menu-list">
            <a id="logout" href="/?logout">LOGOUT</a>
          </li>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Form Section -->
  <section id="form">
    <div class="container">
      <form action="/" method="POST" class="index-form">
        <div class="inputbox">
          <label for="search-video">Search Videos</label>
          <input type="text" placeholder="Search Videos" name="search-video" id="videoSearch"
          value="<?= ($inputValue != '') ? $inputValue : '' ?>">
        </div>

        <div class="input_button">
          <button type="submit" class="btn btn-dark">Search</button>
        </div>
      </form>
    </div>
  </section>

  <?php if(isset($_SESSION['access_token'])): ?>
    <div class="container">
      <pre style="font-size: 1.6rem;">
        <?= $_SESSION['data']['email']; ?>
      </pre>
    </div>
  <?php endif; ?>

  <?php if(isset($_SESSION['youtube_data'])): ?>
    <section id="videoNames">
      <div class="container">
        <?php foreach($_SESSION['youtube_data']->items as $item): ?>

          <?php if(!empty($item->id->videoId)): ?>
            <h3><?= $item->snippet->title; ?></h3>
          <?php endif; ?>

        <?php endforeach; ?>

      </div>
    </section>
  <?php endif; ?>

  <!-- <script src="./js/index.js"></script> -->
  <?php require_once(__DIR__ . '/includes/footer.php'); ?>