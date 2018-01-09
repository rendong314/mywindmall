<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
$id = isset($id) ? $id : '0';
$uid = isset($uid) ? $uid : '0';
//$jine = isset($jine) ? $jine : '0';
$jifen = isset($jine) ? $jifen : '0';
$time = time();

$r = $dosql -> GetOne("SELECT * FROM `#@__member` WHERE id='$uid'");
if($r['integral'] < $jifen){
	echo "1";
}else{
//查询优惠券表中是否存在改用户
	$sql = "SELECT * FROM `#@__youhuiquan` WHERE uid='$uid'";
	if($dosql->ExecNoneQuery($sql))
		{
		//$dosql->Execute("SELECT * FROM `#@__youhuiquan` WHERE uid=$uid");
			/*while($row = $dosql->GetArray())
			{
				$qian .= $row['qian'].',';
			}*/
			//$qian = substr($qian,0,strlen($qian)-1);
			//$qianarr = explode(',',$qian);
			
			/*if(in_array($jine, $qianarr)){
				$sql = "UPDATE `#@__youhuiquan` SET shuliang=shuliang+1 where uid=$uid and qian=$jine";	
				if($dosql->ExecNoneQuery($sql))
				{
					$sql = "UPDATE `#@__member` SET integral=integral-$jifen where id=1";	
					if($dosql->ExecNoneQuery($sql)){
						echo "1";
						exit();
						}
				}
			} else {*/
				$row = $dosql -> GetOne("SELECT * FROM `#@__daijinquan` WHERE id=$id");
				$dqsj = $row['syqx']+$time;
				$sql = "INSERT INTO `#@__youhuiquan` (uid, dqsj, jine_id, shuliang) VALUES ('$uid', '$dqsj','$id', '$uid')";	
				if($dosql->ExecNoneQuery($sql))
				{
					$sql = "UPDATE `#@__member` SET integral=integral-$jifen where id='$uid'";	
					if($dosql->ExecNoneQuery($sql)){
						echo "2";
						exit();
						}
				//}
			}
	
	}else{
			echo "3";
			exit();
	}
}

?>