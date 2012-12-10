<?php

  /* Start session and load library. */


  session_start();

  if($_SESSION['access_token'] !="" && $_SESSION['access_token_secret'] !=""){
    header("Location:./index.php");
  }
  
  $twit = new Twitter(CONSUMER_KEY,CONSUMER_SECRET);
  
  
  
  
  $verifier = $_GET['oauth_verifier'];  
  
  
  $twit->setToken($_SESSION['request_token']);  
  $twit->setTokenSecret($_SESSION['request_token_secret']);
  
  
  $twit->getAccessToken(accessTokenURL(), $verifier);  


  $_SESSION['access_token'] = $twit->getToken();  
  $_SESSION['access_token_secret'] = $twit->getTokenSecret();  
  
  $prof = $twit->get('account/verify_credentials');
  $xml = simplexml_load_string($prof); 

  header("Location:./index.php?id={$xml->id}");
  

?>

