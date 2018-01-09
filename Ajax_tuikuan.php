<?php

require_once(dirname(__FILE__).'/include/config.inc.php'); 

$uid=isset($uid) ? $uid : '' ;
$ordernum=isset($ordernum) ? $ordernum : '' ;

$row = $dosql->GetOne("SELECT * FROM `#@__goodsorder` WHERE `username`='".$uid."' and `ordernum`='".$ordernum."'");
$checkinfo = $row['checkinfo'].',tuikuan';

$sql="update `#@__goodsorder` set `checkinfo`='".$checkinfo."' where `username`='".$uid."' and `ordernum`='".$ordernum."'";

	if($dosql->ExecNoneQuery($sql))
	{
		echo '1';
	}else{
		echo '2';
	}


?>