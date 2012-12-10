<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
  <head>
    <title>爆発寸前GIG</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
    {literal}
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    {/literal}
    </style>
  </head>
  <body>
    <div>
      <h2>aa</h2>
<form name="frm1" action="{$smarty.server.SCRIPT_NAME}" method="POST">
<input name="trn" value="write" type="hidden">
<textarea name="tweet" rows="4" cols="40"></textarea>
<br />
<input value="投稿" type="submit" name="button">
</form>
      <p><a href='{$smarty.server.SCRIPT_NAME}?trn=clear'>セッションクリア</a></p>
  </body>
</html>
