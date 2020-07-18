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