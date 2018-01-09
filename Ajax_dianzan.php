<?php

require_once(dirname(__FILE__).'/include/config.inc.php'); 

$goodsid=isset($goodsid) ? $goodsid : '' ;

$uid=isset($uid) ? $uid : '' ;

$flag=isset($flag) ? $flag : '' ;

if($flag=='1')
{
	if(!empty($goodsid) and !empty($uid))
	{
		$row = $dosql -> GetOne("SELECT id FROM `#@__zan` where goodsid='".$goodsid."' and uid='".$uid."'");
		
		if(!is_array($row))
		{
			$sql="INSERT INTO `#@__zan` (goodsid, uid) values('".$goodsid."', '".$uid."')";
			
			if($dosql->ExecNoneQuery($sql)){
				
				echo "1";
				
				exit();
			
			}
		
		}else{
			echo "2";
				
			exit();
			}
	}
	else
	{
		echo "3";	
		
		exit();		
	}
}

else if($flag=='2')
{
	$sql=("DELETE FROM `#@__zan` WHERE `goodsid`='".$goodsid."' AND `uid`='".$uid."'");
	
	if($dosql->ExecNoneQuery($sql))
	{
		echo "4";
		
		exit();
	}
}
?>