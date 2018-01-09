<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 
$c_uname = AuthCode($_COOKIE['username']);
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link href="style/webstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="js/zVy3.js"></script> 
<script type="text/javascript" src="js/zVy5.js"></script> 
<title>兑换代金券</title>
</head>

<body style="max-width:640px;margin:0 auto;">
<!-- main start -->
<?php
$dosql->Execute("SELECT * FROM `#@__daijinquan` WHERE checkinfo='true' ORDER BY id");
$i=1;
while($row = $dosql->GetArray())
{
?>
<div class="dhdjq_bor">
	<div class="dhdjq_bg">
		<span class="fl dhdjq_date"><?php echo $row['jine'];?>元代金券<br>有效期：<br><?php echo $row['syqx']/86400;?>天</span>
		<span class="fr tc dhdjq_jf djlq<?php echo $i?>"><?php echo $row['sxjf'];?>积分<br>点击领取</span>
		<div class="cl"></div>
	</div>
	<div class="dhdjq_ck lingqu<?php echo $i?>"><span class="fl">查看详细规则</span><span class="fr"><img class="lingqu_on<?php echo $i?>" src="images/a41.png" alt=""></span><div class="cl"></div></div>
	<div class="dhdjq_ck_text dhdjq<?php echo $i?>"><?php echo $row['xxgz'];?></div>
</div>
<input type="hidden" name="" class="djq_id<?php echo $i?>" value="<?php echo $row['id'];?>">
<input type="hidden" name="" class="jine<?php echo $i?>" value="<?php echo $row['jine'];?>">
<input type="hidden" name="" class="jifen<?php echo $i?>" value="<?php echo $row['sxjf'];?>">
<?php
$i++;}
?>
</div>
<script type="text/javascript">
<?php
$dosql->Execute("SELECT * FROM `#@__daijinquan` WHERE checkinfo='true' ORDER BY id");
$i=1;
while($row = $dosql->GetArray())
{
?>
$(".lingqu<?php echo $i?>").click(function(){
	$(".dhdjq<?php echo $i?>").toggle(300);
		var src = $(".lingqu_on<?php echo $i?>").attr('src');
		if (src=='images/a41.png') {
			$(".lingqu_on<?php echo $i?>").attr("src","images/a42.png");
		}else{
			$(".lingqu_on<?php echo $i?>").attr("src","images/a41.png");
		}
		
		return false;
	})
	
//领取代金券
$(".djlq<?php echo $i?>").click(function(){
	var djq_id = $(".djq_id<?php echo $i?>").val();
	var jine = $(".jine<?php echo $i?>").val();
	var jifen = $(".jifen<?php echo $i?>").val();
	$.post("Ajax_youhuiquan.php",{id:djq_id,uid:<?php echo $c_uname?>,jine:jine,jifen:jifen},function(data){
		if(data==1){
			//alert("积分不足");
			$(".xianshi").text("积分不足").show(500);
			 	setTimeout(function () {
				$(".xianshi").hide(500);
			}, 2000);
			}else if(data==2){
				//alert("领取成功");
				$(".xianshi").text("领取成功").show(500);
			 	setTimeout(function () {
				$(".xianshi").hide(500);
			}, 2000);
				}else if(data==3){
					//alert("网络错误");
					$(".xianshi").text("网络错误").show(500);
					setTimeout(function () {
					$(".xianshi").hide(500);
				}, 2000);
				}
		});
	})
		
<?php
$i++;}
?>

	</script>
<!-- main start -->
<!--footer start-->
<div style="height:50px;"></div>
<?php require_once("footer.php");?>
<!--footer end-->
<div class="xianshi" style="position:fixed; top:50%; left:25%; background:rgba(0,0,0,.5); width:50%; padding:0.5% 2%; height:30px;line-height:30px;margin-top:-15px;border-radius:3px;color:#fff;z-index:9999;text-align:center; display:none"></div>
</body>
</html>
