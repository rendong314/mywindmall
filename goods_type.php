<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 
$cid = empty($cid) ? "" : intval($cid);
$clsid= isset($clsid) ? $clsid : '';
$sort = $_GET['sort'];
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
<?php echo GetHeader();?>
</head>

<body style="max-width:640px;margin:0 auto;">
<!-- main start -->
<section>
  <ul class="fl main_fl_type tc"  style="width:30%;height:90%;position:fixed;left:0;top:0;overflow-y:auto;">
    <li><a href="goods_type.php" <?php if($cid == ''){?> class="main_fl_type_on"<?php }?>>限时促销</a></li>
    <?php 
	$dosql->Execute("SELECT * FROM `#@__goodstype` WHERE parentid='0' AND checkinfo=true ORDER BY orderid,id DESC");
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == '') $gourl = 'goods_type.php?cid='.$row['id'].'&clsid='.$row['id'];
			else $gourl = $row['linkurl'];
	?>
    <li><a href="<?php echo $gourl;?>" <?php if($cid == $row['id']){?>class="main_fl_type_on"<?php }?>><?php echo $row['classname'];?></a></li>
    <?php $i++;}?>
  </ul>
  <ul class="fr main_fl_con tc" style="width:70%;height:90%;position:fixed;right:0;top:0;overflow-y:auto;">
    <?php 
	if($cid == ''){
		$dosql->Execute("SELECT * FROM `#@__goodstype` WHERE id='73' ORDER BY orderid,id DESC");
		}else{
	$dosql->Execute("SELECT * FROM `#@__goodstype` WHERE parentid='$cid' AND checkinfo=true ORDER BY orderid,id DESC");
		}
		$i=1;
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == '') $gourl = 'goods_list.php?cid='.$row['id'].'&clsid='.$clsid;
			else $gourl = $row['linkurl'];
	?>
    <li><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" style="border-radius:50%; height:100px;"><br>
      <?php echo mb_substr($row['classname'],0,5,'utf-8');?></a></li>
    <?php }?>
  </ul>
  <div class="cl"></div>
</section>
<div style="height:60px;"><?php require_once('footer.php');?></div>
<!-- main start -->
</body>
</html>
