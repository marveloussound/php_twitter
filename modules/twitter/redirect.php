<?php

  /* Start session and load library. */


  session_start();
  
  
  $twit = new Twitter(CONSUMER_KEY,CONSUMER_SECRET);


  $twit->getRequestToken(requestTokenURL(), OAUTH_CALLBACK);  
  

  $_SESSION['request_token'] = $twit->getToken();  
  $_SESSION['request_token_secret'] = $twit->getTokenSecret();  
  
  $auth_url = $twit->getAuthorizeUrl(authorizeURL());  
   
  header("Location:{$auth_url}");

?>