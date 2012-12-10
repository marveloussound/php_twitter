<?php


  mb_language('Japanese');
  ini_set('mbstring.detect_order', 'UTF-8,SJIS,EUC-JP,JIS,ASCII');
  ini_set('mbstring.internal_encoding', 'UTF-8');
  ini_set('mbstring.http_output','UTF-8');
  
  require_once(CONF_DIR."/config_fname.php");
  
  
  
  $include_path = ini_get('include_path') . PATH_SEPARATOR . 
                  LIB_DIR."/Smarty". PATH_SEPARATOR .
                  LIB_DIR."/PEAR";

  ini_set('include_path', $include_path);


  define('CONSUMER_KEY',    'cXGG688g7XDxXkLRjeKVA');
  define('CONSUMER_SECRET', '80Cq8ICT3ywZPUsuFHL36Zs1Y8uZlinmjJchw');
  define('OAUTH_CALLBACK', 'http://www.keyst.org/twitter/callback.php');
  
  
  function accessTokenURL()  { return 'https://api.twitter.com/oauth/access_token'; }
  function authenticateURL() { return 'https://api.twitter.com/oauth/authenticate'; }
  function authorizeURL()    { return 'https://api.twitter.com/oauth/authorize'; }
  function requestTokenURL() { return 'https://api.twitter.com/oauth/request_token'; }
  
  function updateURL() { return 'https://twitter.com/statuses/update.xml'; }

  
  # ----- データベースの設定

  define("DBTYPE"   , "mysql");       # 使用するデータベース
  define("DBSERVER" , "localhost");   # データベースホスト(localhost)
  define("DBNAME"   , "keyst_twitter"); # データベース名
  define("DBUSER"   , "keyst_twitter");        # データベースユーザー
  define("DBPASS"   , "kerokero");        # データベースパスワード


  require_once(LIB_DIR."/GetSmarty.php");
  require_once(LIB_DIR."/MyDB.php");
  
  require_once LIB_DIR."/Twitter.php";
  
  //require_once(LIB_DIR.'/OAuth.php');

  //require_once(LIB_DIR."/functions_mob.php");
  


  header("Content-type: text/html;charset=UTF-8;");

  

?>