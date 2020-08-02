<?php

  session_start();

  $json = file_get_contents('php://input');
  $data = json_decode($json);

  $_SESSION['username'] = $data->name;
  $_SESSION['fb_id'] = $data->id;
  $_SESSION['email'] = $data->email;

  echo json_encode([
    'username' => $_SESSION['username'],
    'fb_id' => $_SESSION['fb_id'],
    'email' => $_SESSION['email']
  ]);