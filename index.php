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

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="underscore.js"></script>
<script>
function loadFans(userNameInput){
  $.ajax({
    url: "http://weiboapp.twksos.com/followers_ids.php?name=" + $(userNameInput).val(),
    async: false
  }).done(function(data) {
    fans = JSON.parse(data);
    console.log(fans);
    if(fans.error){
      alert('错误：'+fans.error);
    }
    if(fans.next_cursor == 0){
      $(userNameInput).attr('data-fans',data);
      calcIntersection();
    }else {
      alert('暂不支持5000粉丝以上的用户。');
    }
  });
}
function calcIntersection(){
    var user0Ids = JSON.parse($('#user-0-name').attr('data-fans')).ids;
    var user1Ids = JSON.parse($('#user-1-name').attr('data-fans')).ids;
    var intersection = _.intersection(user0Ids, user1Ids);
    $('#user-0-fans').text(user0Ids.length)
    $('#user-1-fans').text(user1Ids.length)
    $('#common-fans').text(intersection.length)
    $('#common-fans-user-0-percentage').text(intersection.length/user0Ids.length)
    $('#common-fans-user-1-percentage').text(intersection.length/user1Ids.length)
}
$(function (){
  _.after(1, calcIntersection);
  $('#load').click(function(){
    loadFans('#user-0-name');
    loadFans('#user-1-name');
  });
});
</script>
</head>

<body>
<?php
if($_SESSION['token']){
?>
  <form>
    <section>
      <input id='user-name-0' type="text" />
      <label>对比的用户名</label>
    </section>
    <section>
      <input id='user-name-1' type="text" />
      <label>对比的用户名</label>
    </section>
    <button id='load'>load</button>
  </form>
  <div id='content'>
    <section><label>用户的粉丝数量</label><span id="user-0-fans"></span></section>
    <section><label>用户的粉丝数量</label><span id="user-1-fans"></span></section>
    <section><label>共同粉丝数量</label><span id="common-fans"></span></section>
    <section><label>共同粉丝数量占用户粉丝百分比</label><span id="common-fans-user-0-percentage"></span></section>
    <section><label>共同粉丝数量占用户粉丝百分比</label><span id="common-fans-user-1-percentage"></span></section>
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
