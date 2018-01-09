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
	$row=$dosql->getone("select id from `#@__goodsprice` where goodsid='$goodsid'");

	if($row)
	{
		if(empty($attrid)){ 
		echo '3';
		exit;
		}
	}
	
	/***/	
	$rowp=$dosql->getone("select count from `#@__goodscar` where `uid`='$c_uname' and `goodsid`='$goodsid' and `attrid`='$attrid'");
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
	echo 6;
}
?>