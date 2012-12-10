<?php
/*
 * Created on 2010/08/16
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
  class Twitter{
  	
    private $consumer = "";
    public $host = "https://api.twitter.com/1/";
    public $format ="xml";
    
    function Twitter($consumer_key,$consumer_secret){
    	

      require 'HTTP/OAuth/Consumer.php';
      
      $this->consumer = new HTTP_OAuth_Consumer($consumer_key, $consumer_secret);  
         
      $http_request = new HTTP_Request2();  
      $http_request->setConfig('ssl_verify_peer', false);  
      $consumer_request = new HTTP_OAuth_Consumer_Request;  
      $consumer_request->accept($http_request);
      $this->consumer->accept($consumer_request);
      
        
      
    }
    
    function getToken(){
      return $this->consumer->getToken();
    }
    
    function getTokenSecret(){
      return $this->consumer->getTokenSecret();
    }
    
    
    
    function setToken($access_token){
      $this->consumer->setToken($access_token);  
    }
    
    function setTokenSecret($access_token_secret){
      $this->consumer->setTokenSecret($access_token_secret);
    }
    
    function getAuthorizeUrl($url){
    	return $this->consumer->getAuthorizeUrl($url);
    }
    
    function getAccessToken($url, $verifier){
    	$this->consumer->getAccessToken($url, $verifier);
    }
    
    function getMyStatus($id){
      
      
      //https://twitter.com/oauth/77drm/show.xml
      //http://api.twitter.com/1/statuses/show/77drm.xml //id 51662884
      //http://api.twitter.com/1/users/show/51662884.xml
      //print $response =  $this->consumer->getLastRequest();
      
      $response =  $this->consumer->sendRequest("{$host}statuses/show/{$id}.{$this->format}", array(), "GET");  
      return $response->getBody();
      

    }
  
    function updateTweet($tweet){
    	
      $status = $tweet;
      $response = $this->consumer->sendRequest(updateURL(), array('status' => $status), "POST");  
      return $response->getBody();
      
      
    }
    
    function getRequestToken($url, $callback){
      return $this->consumer->getRequestToken($url, $callback);
    }
    
    
    /**
     * GET wrapper for oAuthRequest.
     */
    function get($url, $parameters = array()) {
      $response = $this->oAuthRequest($url, 'GET', $parameters);
      return $response;
    }
    
    function oAuthRequest($url, $method='GET', $parameters){
      if (strrpos($url, 'https://') !== 0 && strrpos($url, 'http://') !== 0) {
        $url = "{$this->host}{$url}.{$this->format}";

      }

      $response =  $this->consumer->sendRequest($url, array(), $method);
      return $response->getBody();
      
    }
  }
  
  
  
?>
