<?php  
require_once(dirname(__FILE__).'/../../include/config.inc.php');
require_once(dirname(__FILE__).'/../../include/config.rn.php');
//require_once(dirname(__FILE__).'/../../include/rnpdo.class.php');


$Appid	= 'wx13a72a1f7e9deb53';
$Secret = 'f2cfb865e94ec669749c63ef1f4e6bf7'; 
 
$code = $_GET["code"];
$pay_openid = $_GET["state"];

$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$Appid.'&secret='.$Secret.'&code='.$code.'&grant_type=authorization_code';

$res=file_get_contents($get_token_url);


$json_obj = json_decode($res,true);

$msg_openid = $json_obj['openid'];

//获取用户基本信息用
$access_token = $json_obj['access_token'];

$get_token_url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$msg_openid.'&lang=zh_CN'; 

$res=file_get_contents($get_token_url);

//end

$pid=substr(md5(md5($msg_openid.$pay_openid."jingg")),-21);

header("location:index.php?openid=$msg_openid&pay_openid=$pay_openid&checkstr=$pid&id=4&info=$res");






?>