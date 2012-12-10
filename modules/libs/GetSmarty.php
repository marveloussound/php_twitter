<?php
/*
 * Created on 2009/08/06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 

  
  require_once("Smarty.class.php");
  
  $smarty = new Smarty();

  
  // template, cache, configuration files
  if(defined("TEMPLATE_DIR")){
    $smarty->template_dir = TEMPLATE_DIR;
  }
  
  if(defined("TEMPLATE_C_DIR")){
    $smarty->compile_dir = TEMPLATE_C_DIR;
  }
  
  if(defined("CACHE_DIR")){
    $smarty->cache_dir = CACHE_DIR;
  }
  

  function convert_encoding_to_utf8($template_source, &$smarty) {
    if (function_exists("mb_convert_encoding")) {
      $enc = mb_detect_encoding($template_source, "auto");
      if ($enc != "UTF-8") {
        return mb_convert_encoding($template_source, "UTF-8", $enc);
      }
    }
    return $template_source;
  }
  function convert_encoding_to_euc($template_source, &$smarty) {
    if (function_exists("mb_convert_encoding")) {
      $enc = mb_detect_encoding($template_source, "auto");
      if ($enc != "EUC-JP") {
        return mb_convert_encoding($template_source, "EUC-JP", $enc);
      }
    }
    return $template_source;
  }
  
  $smarty->default_modifiers = array('escape:"htmlall":"utf-8"');
  
  @$smarty->register_prefilter("convert_encoding_to_euc");
  @$smarty->register_postfilter("convert_encoding_to_utf8");
 
?>
