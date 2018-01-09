<?php

require_once(dirname(__FILE__).'/include/config.inc.php'); 

$goodsid=isset($goodsid) ? $goodsid : '' ;

$uid=isset($uid) ? $uid : '' ;

$a=isset($a) ? $a : '' ;

if($a=='zanadd')
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
			else
			{
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
	else
	{
		echo "4";	
		
		exit();		
	}
}

else if($a=='delzan')
{
	$sql=("DELETE FROM `#@__zan` WHERE `goodsid`='".$goodsid."' AND `uid`='".$uid."'");
	
	if($dosql->ExecNoneQuery($sql))
	{
		echo "5";
		
		exit();
	}
}
?>