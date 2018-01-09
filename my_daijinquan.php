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
<title>我的代金券</title>
</head>

<body style="max-width:640px;margin:0 auto;">
<!-- main start -->
<?php
$tim=time();
$dosql->Execute("SELECT * FROM `#@__youhuiquan` WHERE uid='$c_uname' and zhuangtai<1 and dqsj>'$tim' ORDER BY id");
$i=1;
if($dosql->GetTotalRow() > 0)
while($row = $dosql->GetArray())
{
?>
<div class="dhdjq_bor">
	<div class="wddjq_yel">
		<div class="wddjq_line">
			<span class="fl wddjq_l tc font_18">￥<font class="font_30">
            <?php $r = $dosql -> GetOne("SELECT * FROM `#@__daijinquan` WHERE id='".$row['jine_id']."'");
			echo $r['jine'];
			?>
            </font></span>
			<span class="fr wddjq_r"><font class="font_18">代金卷</font><br>有效期截止：<br><?php echo date("Y-m-d", $row['dqsj']);?></span>
			<div class="cl"></div>
		</div>
	</div>
	<div class="wddjq_con">
	使用规则<br><?php echo $r['xxgz'];?>
	</div>
</div>
<?php
$i++;}else{
?>
<div class="nonelist">您还没有代金卷哦！快去<a href="youhuiquan.php">兑换</a>吧</div>
<?php }?>
	</script>
<!-- main start -->
<!--footer start-->
<div style="height:50px;"></div>
<?php require_once("footer.php");?>
<!--footer end-->
</body>
</html>
