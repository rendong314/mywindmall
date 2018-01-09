<?php

$pay_openid = isset($_GET["pay_openid"])?$_GET["pay_openid"]:'abc';

if(isset($_COOKIE['username'])){
	header("location:index.php");
}
else
{


$Appid		  ="wx13a72a1f7e9deb53"; 


$url= "http://https.agamemnon.cn/oauthtemp_msg.php";

$redirect_uri = urlencode($url);

$URL = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=$Appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=$pay_openid#wechat_redirect";

header("location:$URL");
}


?>