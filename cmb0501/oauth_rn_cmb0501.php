<?php  
require_once(dirname(__FILE__).'/../../include/config.inc.php');
	
if(time() < strtotime('2017-03-06 08:00:00'))
{
	echo "<script>alert('您好，红包尚未开始领取，保持耐心，稍等一下。');</script>"; 
	exit;
}

$Appid =  "wxd0a329f2b1cff07b";

$url= "http://cmbhd.superwx.cn/NingXiaBoc/port/cmb0501/oauthtemp_rn_cmb0501.php";

$redirect_uri = urlencode($url);

$URL = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=$Appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=abc#wechat_redirect";

header("location:$URL");



?>