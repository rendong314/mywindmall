<?php
require_once(dirname(__FILE__).'/include/config.inc.php'); 
$flag = isset($flag) ? $flag : '';
/*if($flag == '1')
{
	$id = isset($id) ? $id : '';
	echo $id;
}else*/
 if($flag == '2')
{
	$count = isset($count) ? $count : '';
	$typeid = isset($typeid) ? $typeid : '';
	$goodsid = isset($goodsid) ? $goodsid : '';
	//echo '<pre>';
	$arr=explode(",",$count);
	for($i=0;$i<=count($arr);$i++)
	{
		if(@$arr[$i] == '')
		{
			array_splice($arr,$i,1);
		}		
	}
	$dosql->Execute("select id from `#@__goodsattr` where goodsid='$typeid'");
	$i=0;
	while($row=$dosql->GetArray())
	{
		$attr[$row['id']]=@$arr[$i];
		$i++;
	}
	$value=serialize($attr);
	$rowp=$dosql->getone("select id,homenum,price,jifen from `#@__goodsprice` where value='$value' and goodsid=".$goodsid);
	//print_r($rowp);exit;
	if(!empty($rowp))
	{
		echo $rowp['homenum'].",".$rowp['price'].",".$rowp['id'].",".$rowp['jifen'];
	}
}
?>
