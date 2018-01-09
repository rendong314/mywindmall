<?php

require_once(dirname(__FILE__).'/include/config.inc.php'); 

$uid=isset($uid) ? $uid : '' ;
$ordernum=isset($ordernum) ? $ordernum : '' ;

$sql=("DELETE FROM `#@__goodsorder` WHERE `username`='".$uid."' AND `ordernum`='".$ordernum."'");
	
	if($dosql->ExecNoneQuery($sql))
	{
		echo "1";
		
		exit();
	}else{
		echo "2";
		
		exit();
		}


?>