<?php

require_once(dirname(__FILE__).'/include/config.inc.php'); 

$uid=isset($uid) ? $uid : '' ;
$ordernum=isset($ordernum) ? $ordernum : '' ;

$row = $dosql->GetOne("SELECT * FROM `#@__goodsorder` WHERE `username`='".$uid."' and `ordernum`='".$ordernum."'");
$checkinfo = $row['checkinfo'].',getgoods';

$sql="update `#@__goodsorder` set `checkinfo`='".$checkinfo."' where `username`='".$uid."' and `ordernum`='".$ordernum."'";

	if($dosql->ExecNoneQuery($sql))
	{
			
		$row_ord = $dosql -> GetOne('SELECT * FROM `#@__goodsorder` WHERE ordernum="'.$ordernum.'"');
		
		if($row_ord['fangshi']=='0' and $row_ord['jifen_zt']==''){
				$dosql->Execute('SELECT * FROM `#@__goodsorder` WHERE ordernum="'.$ordernum.'"');
				$aid == '';
				while($row1 = $dosql->GetArray())
				{
					$aid += $row1['jifen'].',';
					if($row1['attrstr'] == ''){
						$s1="update `#@__goods` set housenum=housenum-".$row1['goodsnum']." where id=".$row1['goodsid'];
						$dosql->ExecNoneQuery($s1);
						}else{
						$s2="update `#@__goodsprice` set homenum=homenum-".$row1['goodsnum']." where id=".$row1['attrstr'];
						$dosql->ExecNoneQuery($s2);	
						}
				}
				
					$sql = "UPDATE `#@__member` SET integral=integral+'".$aid."' WHERE id='".$uid."'";
					$dosql->ExecNoneQuery($sql);
					$sql = "UPDATE `#@__goodsorder` SET jifen_zt='1' WHERE ordernum='".$ordernum."'";
					$dosql->ExecNoneQuery($sql);
			}
		
		echo '1';
	}else{
		echo '2';
	}


?>