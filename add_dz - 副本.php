<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//echo $dizhi;
if($dizhi==''){
	ShowMsg('请选择收货地址！','-1');
	exit();
}
//echo $aa;
//echo $youhuiquan;
if($aa=='dingdanadd'){
	function dingdan(){
     global $dosql;
     $ordernum=date("Ymd").rand(1000,9999);
     $dingdan=$dosql->GetOne("select ordernum from `#@__goodsorder` where `ordernum`='$ordernum'");
     if(!empty($dingdan)){//判断订单号重复
       dingdan();
     }else{
       return $ordernum;
     }
  }
	$ordernum = dingdan();

	$add_row=$dosql->getone("select * from `#@__address` where `id`='$dizhi' and `defaults`=1");
	$posttime=time();
	//明天记得修改优惠券状态
	//print_r($goodsnum);die;
	$qian=explode(",",$youhuiquan);
	for($i=0;$i<count($goodsid);$i++){
		$zongjia=$goodsnum[$i]*$goodsprice[$i];
		$month = strtotime(date('Y-m'));
		if($fangshi == '0'){
			$check = 'confirm,huodaofukuan';
		$sql="INSERT INTO `#@__goodsorder` (username,goodsid,goodsnum,goodsprice,attrstr,truename,telephone,zipcode,postarea_prov,postarea_city,postarea_country,address,ordernum,youhuiquanid,youhuiquan,amount,buyremark,posttime,checkinfo,peisongtime,fangshi,peisongfei,jifen,paymode,month) values('".$uid."','".$goodsid[$i]."','".$goodsnum[$i]."','".$goodsprice[$i]."','".$attrid[$i]."','".$add_row['sname']."','".$add_row['mobile']."','".$add_row['code']."','".$add_row['province']."','".$add_row['city']."','".$add_row['country']."','".$add_row['address']."','".$ordernum."','".$youhuiquanid."','".$qian['0']."','".$zongjia."','".$beizhu."','".$posttime."','".$check."','".$peisongtime."','".$fangshi."','".$peisongfei."','".$jifen[$i]."','1','".$month."')";
		}elseif($fangshi == '1'){
			if($goodsid[$i]=='829'){
				$sql="INSERT INTO `#@__goodsorder` (username,goodsid,goodsnum,goodsprice,attrstr,truename,telephone,zipcode,postarea_prov,postarea_city,postarea_country,address,ordernum,youhuiquanid,youhuiquan,amount,buyremark,posttime,checkinfo,peisongtime,fangshi,peisongfei,jifen,paymode,month) values('".$uid."','".$goodsid[$i]."','".$goodsnum[$i]."','".$goodsprice[$i]."','".$attrid[$i]."','".$add_row['sname']."','".$add_row['mobile']."','".$add_row['code']."','".$add_row['province']."','".$add_row['city']."','".$add_row['country']."','".$add_row['address']."','".$ordernum."','".$youhuiquanid."','".$qian['0']."','".$zongjia."','".$beizhu."','".$posttime."','confirm','".$peisongtime."','".$fangshi."','0','".$jifen[$i]."','1','".$month."')";	
			}else{
		$sql="INSERT INTO `#@__goodsorder` (username,goodsid,goodsnum,goodsprice,attrstr,truename,telephone,zipcode,postarea_prov,postarea_city,postarea_country,address,ordernum,youhuiquanid,youhuiquan,amount,buyremark,posttime,checkinfo,peisongtime,fangshi,peisongfei,jifen,paymode,month) values('".$uid."','".$goodsid[$i]."','".$goodsnum[$i]."','".$goodsprice[$i]."','".$attrid[$i]."','".$add_row['sname']."','".$add_row['mobile']."','".$add_row['code']."','".$add_row['province']."','".$add_row['city']."','".$add_row['country']."','".$add_row['address']."','".$ordernum."','".$youhuiquanid."','".$qian['0']."','".$zongjia."','".$beizhu."','".$posttime."','confirm','".$peisongtime."','".$fangshi."','".$peisongfei."','".$jifen[$i]."','1','".$month."')";	
			}
		}
		if($dosql->ExecNoneQuery($sql)){
			$dosql->ExecNoneQuery("DELETE FROM `#@__goodscar` WHERE id=".$carid[$i]);
		}
	}
	$dosql->ExecNoneQuery("UPDATE `#@__youhuiquan` SET `zhuangtai`=1 WHERE id=".$youhuiquanid);
	if($fangshi == '0'){
		//ShowMsg('订单提交成功！','member.php?c=default');
		$row_id = $dosql->GetOne("SELECT * FROM `#@__goodsorder` WHERE `ordernum`='".$ordernum."'");
		header('location:member.php?c=ordershow&id='.$row_id['id']);
		exit();
		}elseif($fangshi == '1'){
		//ShowMsg('订单提交成功！','wxapi/jsapi.php?ordernum='.$ordernum);
		//header('location:wxapi/jsapi.php?ordernum='.$ordernum);
		header('location:data/api/demo/js_api_call.php?id='.$ordernum);
		//$dosql->ExecNoneQuery("UPDATE `#@__member` SET `integral`=integral+".$jifen." WHERE id=".$youhuiquanid);
		exit();	
			}
	//$dosql->ExecNoneQuery($sql);
}elseif($aa=='buyadd'){
	
	function dingdan(){
     global $dosql;
     $ordernum=date("Ymd").rand(1000,9999);
     $dingdan=$dosql->GetOne("select ordernum from `#@__goodsorder` where `ordernum`='$ordernum'");
     if(!empty($dingdan)){//判断订单号重复
       dingdan();
     }else{
       return $ordernum;
     }
  }
	$ordernum = dingdan();

	$add_row=$dosql->getone("select * from `#@__address` where `id`='$dizhi' and `defaults`=1");
	$posttime=time();
	//明天记得修改优惠券状态
	$qian=explode(",",$youhuiquan);
	
		$zongjia=$goodsnum*$goodsprice;
		//echo $fangshi;die;
		$month = strtotime(date('Y-m'));
		if($fangshi == '0'){
		$check = 'confirm,huodaofukuan';
		$sql="INSERT INTO `#@__goodsorder` (username,goodsid,goodsnum,goodsprice,attrstr,truename,telephone,zipcode,postarea_prov,postarea_city,postarea_country,address,ordernum,youhuiquanid,youhuiquan,amount,buyremark,posttime,checkinfo,peisongtime,fangshi,peisongfei,jifen,paymode,month) values('".$uid."','".$goodsid."','".$goodsnum."','".$goodsprice."','".$attrid."','".$add_row['sname']."','".$add_row['mobile']."','".$add_row['code']."','".$add_row['province']."','".$add_row['city']."','".$add_row['country']."','".$add_row['address']."','".$ordernum."','".$youhuiquanid."','".$qian['0']."','".$zongjia."','".$beizhu."','".$posttime."','".$check."','".$peisongtime."','".$fangshi."','".$peisongfei."','".$jifen."','1','".$month."')";
		}elseif($fangshi == '1'){
			
			if($goodsid=='829'){
				$sql="INSERT INTO `#@__goodsorder` (username,goodsid,goodsnum,goodsprice,attrstr,truename,telephone,zipcode,postarea_prov,postarea_city,postarea_country,address,ordernum,youhuiquanid,youhuiquan,amount,buyremark,posttime,checkinfo,peisongtime,fangshi,peisongfei,jifen,paymode,month) values('".$uid."','".$goodsid."','".$goodsnum."','".$goodsprice."','".$attrid."','".$add_row['sname']."','".$add_row['mobile']."','".$add_row['code']."','".$add_row['province']."','".$add_row['city']."','".$add_row['country']."','".$add_row['address']."','".$ordernum."','".$youhuiquanid."','".$qian['0']."','".$zongjia."','".$beizhu."','".$posttime."','confirm','".$peisongtime."','".$fangshi."','0','".$jifen."','1','".$month."')";	
				}else{
		$sql="INSERT INTO `#@__goodsorder` (username,goodsid,goodsnum,goodsprice,attrstr,truename,telephone,zipcode,postarea_prov,postarea_city,postarea_country,address,ordernum,youhuiquanid,youhuiquan,amount,buyremark,posttime,checkinfo,peisongtime,fangshi,peisongfei,jifen,paymode,month) values('".$uid."','".$goodsid."','".$goodsnum."','".$goodsprice."','".$attrid."','".$add_row['sname']."','".$add_row['mobile']."','".$add_row['code']."','".$add_row['province']."','".$add_row['city']."','".$add_row['country']."','".$add_row['address']."','".$ordernum."','".$youhuiquanid."','".$qian['0']."','".$zongjia."','".$beizhu."','".$posttime."','confirm','".$peisongtime."','".$fangshi."','".$peisongfei."','".$jifen."','1','".$month."')";	
				}
		}
	$dosql->ExecNoneQuery($sql);
	$dosql->ExecNoneQuery("UPDATE `#@__youhuiquan` SET `zhuangtai`=1 WHERE id=".$youhuiquanid);
	if($fangshi == '0'){
		//ShowMsg('订单提交成功！','member.php?c=default');
		$row_id = $dosql->GetOne("SELECT * FROM `#@__goodsorder` WHERE `ordernum`='".$ordernum."'");
		header('location:member.php?c=ordershow&id='.$row_id['id']);
		exit();
		}elseif($fangshi == '1'){
		//ShowMsg('订单提交成功！','wxapi/jsapi.php?ordernum='.$ordernum);
		//header('location:wxapi/jsapi.php?ordernum='.$ordernum);
		header('location:data/api/demo/js_api_call.php?id='.$ordernum);
		//$dosql->ExecNoneQuery("UPDATE `#@__member` SET `integral`=integral+".$jifen." WHERE id=".$youhuiquanid);
		exit();	
			}
	//$dosql->ExecNoneQuery($sql);
	}


?>