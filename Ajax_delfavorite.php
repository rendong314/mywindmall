<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
$a = isset($a) ? $a : '';
$aid = isset($aid) ? $aid : '';
$uid = isset($uid) ? $uid : '';
if($a == 'delfavorite')
{
	$dosql->ExecNoneQuery("DELETE FROM `#@__userfavorite` WHERE `aid`='".$aid."' AND `uid`='".$uid."'");
	echo "3";
	exit();
}else{
	echo "4";
	exit();
	}
?>