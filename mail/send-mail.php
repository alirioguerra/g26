<?php

function isValidJSON($str) {
  json_decode($str);
  return json_last_error() == JSON_ERROR_NONE;
}

//Load Composer's autoloader
require 'include/Mail.php';
require 'vendor/autoload.php';

// takes raw data from the request 
$json_params = file_get_contents('php://input');

if (strlen($json_params) > 0 && isValidJSON($json_params)){
  // Converts it into a PHP object 
  $data = json_decode($json_params, true);  
} else {
  
  http_response_code(422);
  echo json_encode([
    'success' => false,
    'error' => true,
    'message' => 'Invalid request'
  ]);
  exit;
}

$mail = new \App\Mail();
$validate = $mail->validate($data);

if($validate['error']){
  http_response_code(422);
  echo json_encode($validate);
} else {
  $response = $mail->send($data);

  if($response['error']) {
    http_response_code(500);
  }
  echo json_encode($response);
}