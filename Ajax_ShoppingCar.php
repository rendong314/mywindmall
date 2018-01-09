<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
$attrid = isset($attrid) ? $attrid : '0';
$goodsid = isset($goodsid) ? $goodsid : '';
$count = isset($count) ? $count : '';
$kucun = isset($kucun) ? $kucun : '';
$c_uname = AuthCode($_COOKIE['username']);
if($kucun == '0')
{
	echo '1';
	exit;
}
if(empty($c_uname))
{
	echo "2";//请先登录
	exit;
}else
{
	//$site=$dosql->getone("select * from `#@__goods` where id='$goodsid'");
	$row=$dosql->getone("select id from `#@__goodsprice` where goodsid='$goodsid'");
	if($row)
	{
		if(empty($attrid)){ 
		echo '3';
		exit();die;
		}
	}
	
	if(empty($attrid))
		{
			$row_goods=$dosql->getone("select housenum from `#@__goods` where id='$goodsid'");
			//$count1=$row_goods['housenum']-$rowp['count'];//剩余库存
			if($row_goods['housenum'] < $kucun || $row_goods['housenum'] < $count || $count=='')
			{
				{
					echo '4';
					exit;
				}
			}
		}else
		{
			$row_goodsprice=$dosql->getone("select homenum from `#@__goodsprice` where id='$attrid'");
			//$count1=$row_goodsprice['homenum']-$rowp['count'];//剩余库存
				if($row_goodsprice['homenum'] < $kucun || $row_goodsprice['homenum'] < $count || $count=='')
				{
					echo '5';
					exit;
				}

		}	
	$rowp=$dosql->getone("select count from `#@__goodscar` where `uid`='$c_uname' and `goodsid`='$goodsid' and `attrid`='$attrid'");
	$peisong =$dosql->getone("select songhuo from `#@__goods` where `id`='$goodsid'");

	if(empty($rowp))
	{
		$sql="insert into `#@__goodscar` (`uid`, `goodsid`, `attrid`, `count`, `peisong`) values ('$c_uname', '$goodsid', '$attrid', '$count', '".$peisong['songhuo']."');";
	}else
	{
	$sql="update `#@__goodscar` set `count`=`count`+'$count' where `uid`='$c_uname' and `goodsid`='$goodsid' and `attrid`='$attrid'";
	}
	
	if($dosql->ExecNoneQuery($sql))
	{
		echo '6';
	}else
	{
		echo '7';
	}
		
	
}
?>