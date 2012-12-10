<?php


  
  /**
   * Joins key:value pairs by inner_glue and each pair together by outer_glue
   * @param string $inner_glue The HTTP method (GET, POST, PUT, DELETE)
   * @param string $outer_glue Full URL of the resource to access
   * @param array $array Associative array of query parameters
   * @return string Urlencoded string of query parameters
   */
  function implode_assoc($inner_glue, $outer_glue, $array) {
      $output = array();
      foreach($array as $key => $item) {
          $output[] = $key . $inner_glue . urlencode($item);
      }
      return implode($outer_glue, $output);
  }
  
  
  
  
  //GETパラメータを解析
  function parseGETParm(){
  
    $GET = "";
  
    if(DEBUG == 1 && @$_GET["url"] !=""){
      $parse = parse_url($_GET["url"]);
      parse_str($parse["query"],$GET);
  
    }else{
      foreach($_GET as $key => $val){
        $GET[$key] = $val;
      }
    }
    return $GET;
  }
  

  
  //GETパラメータを解析
  
  
  function ConvertHankaku($str,$enc ="UTF-8"){
     return mb_convert_kana( $str, "ask",$enc);
  }

  function Send_Error($str){
    if(is_array($str)){
      $str = implode("\n",$str);
    }
    
    dbg(__FILE__.__LINE__.$str);

    trigger_error($str, E_USER_NOTICE);
  }
 

 
 function dbg($str){
  
  global $DevUserAr;

  #if(in_array(MY_ID,$DevUserAr)){

    if(is_array($str)){
      $str = "[".date('Y/m/d h:i:s')."] ".print_r($str,true);
    }else{
      $str = "[".date('Y/m/d h:i:s')."] {$str}";
    }
    
    //chmod("/tmp/debug.txt",0777);
    file_put_contents("/tmp/debug_".APP_ID.".txt",$str."\n",FILE_APPEND);
    
  #}

 }
 







?>