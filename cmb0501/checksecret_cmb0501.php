<?php

require_once(dirname(__FILE__).'/../../include/config.inc.php');
include 'redpack.php';

$openid=isset($_POST['openid'])?$_POST['openid']:"";
$secretsign=isset($_GET['secretsign'])?$_GET['secretsign']:"";
$checkstr=isset($_POST['checkstr'])?$_POST['checkstr']:"";

if($openid=="" || $secretsign=="" || $checkstr==""){ 	echo "5"; 	exit; }

if($checkstr!=substr(md5(md5($openid."314")),-21)) { 	echo "5"; 	exit; } 


if(substr(md5(md5($secretsign)),-20)=="ad2fce94492d0e23ffff" || substr(md5(md5($secretsign)),-20)=="a43caff700a692e30bd7" || substr(md5(md5($secretsign)),-20)=="213a23856695aedb4acf" || substr(md5(md5($secretsign)),-20)=="f96b0c822238cf84a325" || substr(md5(md5($secretsign)),-20)=="b624c1402ed34fca176a" || substr(md5(md5($secretsign)),-20)=="0ced071db70d4febc961" || substr(md5(md5($secretsign)),-20)=="062a3caa8797630d1ed2" || substr(md5(md5($secretsign)),-20)=="5c2ce85bb26d8dffe18d" || substr(md5(md5($secretsign)),-20)=="7bb41999505c241f4cd1" || substr(md5(md5($secretsign)),-20)=="b042b1c317b07e45a707" || substr(md5(md5($secretsign)),-20)=="9173368cf57677d2a50a" || substr(md5(md5($secretsign)),-20)=="3be7d535e6191a09ff11" || substr(md5(md5($secretsign)),-20)=="ddf736c285cee08872bc" || substr(md5(md5($secretsign)),-20)=="f7fa0a62e446e59501cd" || substr(md5(md5($secretsign)),-20)=="5ccd0f88b0215d33c9c5" || substr(md5(md5($secretsign)),-20)=="da9a7894d942465027b1" || substr(md5(md5($secretsign)),-20)=="057388bbb8c921a2a41a" || substr(md5(md5($secretsign)),-20)=="a85b5f124558dc97eca1" || substr(md5(md5($secretsign)),-20)=="c3d38d8292f52021c7d0" || substr(md5(md5($secretsign)),-20)=="6c25b3b5f424498b83ab" || substr(md5(md5($secretsign)),-20)=="ab80a89214b284447398" || substr(md5(md5($secretsign)),-20)=="495fe35a017f77cc9f8f" || substr(md5(md5($secretsign)),-20)=="ce119372598ad230cb3b" || substr(md5(md5($secretsign)),-20)=="12c0b47e989f7bf2f318" || substr(md5(md5($secretsign)),-20)=="a7c4155e4504ffefa8fb" || substr(md5(md5($secretsign)),-20)=="a256c643869ab7b3c0cf" || substr(md5(md5($secretsign)),-20)=="6a2424146a6d4388b893" || substr(md5(md5($secretsign)),-20)=="72c63ee61dea2fcb2ba5" || substr(md5(md5($secretsign)),-20)=="b492102e3b421c444ab7" || substr(md5(md5($secretsign)),-20)=="4e469d1b54bca013b928" || substr(md5(md5($secretsign)),-20)=="2332d2f903e9008e8d45" || substr(md5(md5($secretsign)),-20)=="2dcffd27924819338712" || substr(md5(md5($secretsign)),-20)=="8edd4ccd562d679474ba" || substr(md5(md5($secretsign)),-20)=="22528df001109def1067" || substr(md5(md5($secretsign)),-20)=="c44787bb8dedf20c8fba" || substr(md5(md5($secretsign)),-20)=="8b208262b4c9c0972d22" || substr(md5(md5($secretsign)),-20)=="e29ca81e6c53865940ea" || substr(md5(md5($secretsign)),-20)=="4b669b182e384d50d9a1" || substr(md5(md5($secretsign)),-20)=="95e02266715451387bdf" || substr(md5(md5($secretsign)),-20)=="1e89edf4c694e170fff8" ){

	$r = $dosql->GetOne("SELECT id FROM `cmb_redpack_0501` WHERE pay_openid='$openid' AND red_status=1");
	if(!empty($r)){echo '3';exit;}else{
	
		$pay_openid=$openid;
		$msg_openid=$openid;
		$red_type=1;
		$redpack_money=500;
		$sendname='招商银行';
		$wish='招商银行，因你而变';
		$actname='招行请你坐地铁';
		$gid=$secretsign;
	
		$red_status=SendRedpack($pay_openid,$msg_openid,$red_type,$redpack_money,$sendname,$wish,$actname,$gid);
		echo $red_status;
	}
}else{
	
	echo "4";

}    　　
?>



