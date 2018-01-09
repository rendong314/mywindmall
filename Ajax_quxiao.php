<?php

require_once(dirname(__FILE__).'/include/config.inc.php'); 

$uid=isset($uid) ? $uid : '' ;
$ordernum=isset($ordernum) ? $ordernum : '' ;

$row = $dosql -> GetOne("SELECT * FROM `#@__goodsorder` WHERE `username`='".$uid."' AND `ordernum`='".$ordernum."'");
if($row['checkinfo']=='confirm' and $row['fangshi']=='1'){
	$sql=("DELETE FROM `#@__goodsorder` WHERE `username`='".$uid."' AND `ordernum`='".$ordernum."'");
	}else{
	$sql="update `#@__goodsorder` set quxiaodingdan='1' WHERE `username`='".$uid."' AND `ordernum`='".$ordernum."'";
	}
	if($dosql->ExecNoneQuery($sql))
	{
		echo "1";
		
		exit();
	}else{
		echo "2";
		
		exit();
		}


?>