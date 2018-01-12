<?php
// 获取cURL版本数组
$version = curl_version();

var_dump($version);exit;

// 在cURL编译版本中使用位域来检查某些特性
$bitfields = Array(
            'CURL_VERSION_IPV6', 
            'CURL_VERSION_KERBEROS4', 
            'CURL_VERSION_SSL', 
            'CURL_VERSION_LIBZ'
            );


foreach($bitfields as $feature)
{
    echo $feature . ($version['features'] & constant($feature) ? ' matches' : ' does not match');
    echo PHP_EOL;
}

require(dirname(__FILE__).'/../../include/config.inc.php');

 if(time() < strtotime('2017-04-28 00:00:00'))
{

	$dosql->ExecNoneQuery("delete from `cmb_redpack_0501`");
	echo "ok";
}

?>