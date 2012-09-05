<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Engine</title>
<link href='style.css' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="underscore.js"></script>
<script type="text/javascript" src="samefans.js"></script>
</head>

<body>
<?php
if($_SESSION['token']){
?>
  <form action=''>
    <section>
      <input id='user-0-name' type="text" />
      <p>VS</p>
      <input id='user-1-name' type="text" />
    </section>
    <button id='load' type='button'>load</button>
  </form>
  <div id='content'>
    <section><label><span class='user-0-name'></span>的粉丝数量：</label><span id="user-0-fans"></span></section>
    <section><label><span class='user-1-name'></span>的粉丝数量：</label><span id="user-1-fans"></span></section>
    <section><label>共同粉丝数量：</label><span id="common-fans"></span></section>
    <section><label>共同粉丝数量占<span class='user-0-name'></span>粉丝百分比：</label><span id="common-fans-user-0-percentage"></span></section>
    <section><label>共同粉丝数量占<span class='user-1-name'></span>粉丝百分比：</label><span id="common-fans-user-1-percentage"></span></section>
  </div>
<?php
} else {
?>
  <p><a href="<?php echo $code_url;?>">
    <img src="weibo_login.png" title="Click to Auth" alt="Click to Auth" border="0" />
  </a></p>
<?php
}
?>
</body>
</html>
