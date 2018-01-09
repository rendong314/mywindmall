<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$action=isset($action) ? $action : '' ;

if($action == 'insert_html')
{//添加收货地址页面
?>
<header class="top_bg">
	<span class="fl top_meau"><a href="javascript:Lqb_Back();" class="top_return">返回</a></span>
	<span class="fl top_logo main_top_text tc">编辑地址</span>

	<div class="cl"></div>
</header>

	<ul class="ddy_add_tj">
		<li class="tc pos">编辑收货地址</li>
		<li><input type="text" placeholder="姓名" class="grey_9 ddy_add_inp" id="sname"></li>
		<li><input type="text" placeholder="联系电话" class="grey_9 ddy_add_inp" id="mobile"></li>
		<li style="padding-left:5%;">
        省：<select id="Select1" class="grey_9 ddy_add_inp" style="border:1px solid #ccc;"></select>
        市：<select id="Select2" class="grey_9 ddy_add_inp" style="border:1px solid #ccc;"></select>
        区：<select id="Select3" class="grey_9 ddy_add_inp" style="border:1px solid #ccc;"></select>
        </li>
		<li><input type="text" placeholder="详细地址" class="grey_9 ddy_add_inp" id="address"></li>
		<li><input type="text" placeholder="邮政编码（选填）" class="grey_9 ddy_add_inp" id="code"></li>
		<div class="grey_bg"></div>
		<a href="javascript:Lqb_Add_Insert();" class="ddy_add_btn tc">保存</a>
	</ul>
<script type="text/javascript">
addressInit('Select1', 'Select2', 'Select3');
</script>
<?php
}








else if($action == 'insert')
{//添加收货地址 执行语句
	$sname=isset($sname) ? $sname : '' ;
	
	$mobile=isset($mobile) ? $mobile : '' ;
	
	$Select1=isset($Select1) ? $Select1 : '' ;
	
	$Select2=isset($Select2) ? $Select2 : '' ;
	
	$Select3=isset($Select3) ? $Select3 : '' ;
	
	$address=isset($address) ? $address : '' ;
	
	$code=isset($code) ? $code : '' ;
	
	$uid=isset($uid) ? $uid : '' ;
	
	$dosql->execnonequery("update `#@__address` set `default`=0 where uid='$uid'");
	
	$sql=("insert into `#@__address` (`uid`,`sname`,`mobile`,`province`,`city`,`country`,`address`,`code`,`default`) values('$uid','$sname','$mobile','$province','$city','$country','$address','$code','1')");
	
	if($dosql->execnonequery($sql))
	{
		echo 1;
	}
}















else if($action == 'select_html')
{//收货地址列表 页面
?>

<section>
<?php
$uid=isset($uid) ? $uid : '' ;
$flag_row=$dosql->getone("select * from `#@__address` where `uid`='$uid' and `default`=1");
?>

  <div class="font_14 add_name"><?php echo $flag_row['sname']; ?>       <?php echo $flag_row['mobile']; ?></div>
  <div class="add_text font_14" style="cursor:pointer;background:none;"><?php echo $flag_row['province'].$flag_row['city'].$flag_row['country']; ?><br />
  <?php echo $flag_row['address']; ?><p style="text-align:right; color:green;  margin-top: -25px;">默认地址</p>
  </div>
 
<?php
$dosql->Execute("select * from `#@__address` where `uid`='$uid' and `default`<>1 order by id desc");
while($row=$dosql->GetArray()){
?>
  <div class="font_14 add_name"><?php echo $row['sname']; ?>       <?php echo $row['mobile']; ?></div>
  <div class="add_text font_14" onClick="up_add()" style="cursor:pointer;background:none;"><?php echo $row['province'].$row['city'].$row['country']; ?><br />
  <?php echo $row['address']; ?><p style="text-align:right; margin-top: -25px;"><a href="javascript:;" onClick="Lqb_Update(<?php echo $row['id']; ?>)" style="color:#ff5100;">设为默认地址</a></div>
  </div>
<?php
}
?>  
<ul>
		<li class="addre">
        <p><span><?php echo $flag_row['sname']; ?></span><span><?php echo $flag_row['mobile']; ?></span></p>
        <p><?php echo $flag_row['province'].$flag_row['city'].$flag_row['country']; ?></p>
            <ul class="tc biji">
            <li style="border-right:1px solid #eee;"><img src="images/upda.png"><a href="?c=address_update&id=<?php echo $row['id']; ?>">编辑</a></li>
            <li><img src="images/del.png"><a href="?a=deleteaddress&id=<?php echo $row['id']; ?>">删除</a></li>
            </ul>
        </li>
        <div class="cl"></div>
		<div class="solid"></div>
	</ul>
</section>
<div style="height:60px;"></div>
<div class="tianjia">

    <p><a href="javascript:Lqb_Add()" id="queding">添加新地址</a></p>

    </div>

<?php
}











else if($action == 'update')
{//设为默认地址
	$uid=isset($uid) ? $uid : '' ;
	
	$id=isset($id) ? $id : '' ;
	
	$dosql->execnonequery("update `#@__address` set `default`=0 where uid='$uid'");
	
	$sql=("update `#@__address` set `default`=1 where uid='$uid' and id='$id'");
	
	if($dosql->execnonequery($sql))
	{
		echo 1;
	}
}
?>























































