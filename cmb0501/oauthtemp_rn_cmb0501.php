<?php  

require_once(dirname(__FILE__).'/../../include/config.inc.php');


$Appid =  "wxd0a329f2b1cff07b";
$Secret = "3f0e9dd2f1e223c410975c33edc96ff9";

 
$code = $_GET["code"];
$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$Appid.'&secret='.$Secret.'&code='.$code.'&grant_type=authorization_code';

$res=file_get_contents($get_token_url);
$json_obj = json_decode($res,true);

$openid = $json_obj['openid'];

$pid=substr(md5(md5($openid."314")),-21);

header("location:index_cmb0501.php?openid=$openid&checkstr=$pid");




?>