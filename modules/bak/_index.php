<?php
/*
 * Created on 2010/01/29
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 // include class
require_once "Services/Twitter.php";
require_once('Services/JSON.php');

$json = new Services_JSON(); 


$user = '77boadrums';
$pass = 'takotako';


#$user = '77drm';
#$pass = 'kerokero';

$st = & new Services_Twitter($user, $pass);

$str = "日本語";

$str =  mb_convert_encoding($str,"UTF-8","auto");


#$a = $st->getFriends();
$a = $st->setUpdate($str);


#$a = $json->decode($a);

//print_r($a);

exit;
?>
