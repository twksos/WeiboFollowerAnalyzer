<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');

session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$num_per_page = 5000;
if (!empty($_GET['id'])){
  $id= $_GET['id'];
  $cursor= $_GET['cursor'] || 0;
  $followers = $c->followers_ids_by_id($id,$cursor,$num_per_page);
  echo json_encode($followers);
} else if (!empty($_GET['name'])){
  $name= $_GET['name'];
  $cursor= $_GET['cursor'] || 0;
  $followers = $c->followers_ids_by_name($name,$cursor,$num_per_page);
  echo json_encode($followers);
}
?>
