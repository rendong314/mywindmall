<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$sel = $_POST['sel'];
if(empty($sel)){
	ShowMsg('数据错误',-1);
	//header("Location: goodscar.php"); 
	}else{
		foreach($sel as $v){
			//echo $v;
			$dosql->ExecNoneQuery("DELETE FROM `#@__goodscar` WHERE `id`=".$v."");
		}
		header("Location: goodscar.php"); 
		exit();
	}
?>