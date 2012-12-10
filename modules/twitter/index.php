<?php
/*
 * Created on 2010/08/11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
  session_start();

  
 
  try{
        

    //
    if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret']) || $_GET["trn"]=="clear") {
      session_destroy();
      $_SESSION = array();
      
      if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
        echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://twitter.com/apps">https://twitter.com/apps</a>';
        exit;
      }
      

      //初期接続画面
      $smarty->display("connect.tpl");
      exit;
      
    }else{


      $twit = new Twitter(CONSUMER_KEY,CONSUMER_SECRET);
      
      $twit->setToken($_SESSION['access_token']);
      $twit->setTokenSecret($_SESSION['access_token_secret']);

        
      if($_POST["trn"]=="write"){


        print $twit->updateTweet($_POST["tweet"]);
      

      }elseif($_GET["id"]){
        
        require_once 'XML/Unserializer.php';
        //print $twit->get("users/show/{$_GET[id]}", array());
        
        $xml =  $twit->get("friends/ids", array("id"=>$_GET[id]));
        //$follow_ar = simplexml_load_string($xml); 
        $unserializer = new XML_Unserializer();
        $unserializer->setOption('parseAttributes',true);
        $unserializer->unserialize($xml);
        $follow_ar = $unserializer->getUnserializedData();
        asort($follow_ar["id"]);

        $xml =  $twit->get("followers/ids", array("id"=>$_GET[id]));
        //$follow_ar = simplexml_load_string($xml); 
        $unserializer = new XML_Unserializer();
        $unserializer->setOption('parseAttributes',true);
        $unserializer->unserialize($xml);
        $follower_ar = $unserializer->getUnserializedData();
        asort($follower_ar["id"]);
        
        $diff_ar = array_diff($follow_ar["id"],$follower_ar["id"]);
        
        foreach($diff_ar as $id){
        	$id."<br />";
        }
        
      }
      
      
      
      $smarty->display("input.tpl");

    }
    

    
  } catch(Exception $e){
  	
    
    print $e->getMessage();
    
    
  }
  







 
?>
