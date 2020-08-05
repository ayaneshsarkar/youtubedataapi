<?php 

$token = 'EAAEOKeECkaIBANG1aZCHmFTXcDKDKQmOMk7PaAObjk2oXMNBkla1A2unyD8h6MCCCtLhWz2MEakZC92JqwC0YZCvDYZAlky9OrHcD6j8yWdqWsMVenpKz26BecsTgV7EahTcZCCxRYKPPPGm5HmmkbaM9jZB6ak1bnWdspZCtq0hLaa1Jp1iRiq';

$response = file_get_contents('php://input');

$response = json_decode($response, true);

$message = $response['entry'][0]['messaging'][0]['message']['text'];
$sender = $response['entry'][0]['messaging'][0]['sender']['id'];


$url = "https://graph.facebook.com/v8.0/me/messages?access_token=$token";
$ch = curl_init($url);



$jsonData = '{

  "messaging_type": "RESPONSE",
  "recipient": {
    "id": "'. $sender .'"
  },
  "message": {
    "text": "Hello!"
  }

}';

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

if(!empty($message)) {
  $result = curl_exec($ch);
}