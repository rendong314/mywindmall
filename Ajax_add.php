<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$action=isset($action) ? $action : '' ;
if($action == 'insert_html')
{//添加收货地址页面
?>

	<ul class="ddy_add_tj">
		<li class="tc pos">编辑收货地址</li>
		<li><input type="text" placeholder="姓名" class="grey_9 ddy_add_inp" id="sname"></li>
		<li><input type="text" placeholder="联系电话" class="grey_9 ddy_add_inp" id="mobile"></li>
		<li style="padding-left:5%;">
        省：<select id="Select1" class="grey_9 ddy_add_inp" style="border:1px solid #ccc; width:50%;"></select><br><br>
        市：<select id="Select2" class="grey_9 ddy_add_inp" style="border:1px solid #ccc; width:50%;"></select><br><br>
        区：<select id="Select3" class="grey_9 ddy_add_inp" style="border:1px solid #ccc; width:50%;"></select><br>
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
	
	if($defaults=='1'){
		$dosql->execnonequery("update `#@__address` set `defaults`=0 where uid='$uid'");
		$sql=("insert into `#@__address` (`uid`,`sname`,`mobile`,`province`,`city`,`country`,`address`,`code`,`defaults`) values('$uid','$sname','$mobile','$province','$city','$country','$address','$code','1')");
		//echo $sql;die;
		}else{
		$sql=("insert into `#@__address` (`uid`,`sname`,`mobile`,`province`,`city`,`country`,`address`,`code`,`defaults`) values('$uid','$sname','$mobile','$province','$city','$country','$address','$code','0')");	
		//echo $sql;	die;
		}
	

	if($dosql->execnonequery($sql))
	{
		$dosql->Execute("select * from `#@__address` where `uid`='$uid' order by id desc");
		while($row_add=$dosql->GetArray()){
?>
        <li class="addre"><br>
          <span onClick="moren(<?php echo $row_add['id']; ?>)">
          <p><span><?php echo $row_add['sname']?></span>&nbsp;&nbsp;<span><?php echo $row_add['mobile'] ?></span>
            <?php if($row_add['defaults']=='1'){?>
            <span style="color:#fff; border-radius:5px; background:#F00; padding:1% 2%; font-size:12px;">默认</span>
            <?php }?>
          </p>
          <p><?php echo $row_add['province'].'&nbsp;'.$row_add['city'].'&nbsp;'.$row_add['country'].'&nbsp;'.$row_add['address'];?>(<?php echo $row_add['code'] ?>)</p>
          <br>
          </span>
          <ul class="tc biji">
            <li style="border-right:1px solid #eee;" onClick="Lqb_bianji(<?php echo $row_add['id']; ?>)"><img src="images/upda.png"><a href="javascript:;">编辑</a></li>
            <li onClick="Lqb_del(<?php echo $row_add['id']; ?>)"><img src="images/del.png"><a href="javascript:;">删除</a></li>
          </ul>
        </li>
        <div class="cl"></div>
        <div class="solid1"></div>
<?php
		}
	}else{
		echo 1;
		}
}















else if($action == 'select_html')
{//收货地址列表 页面
?>

<section>
<?php
$uid=isset($uid) ? $uid : '' ;
$flag_row=$dosql->getone("select * from `#@__address` where `uid`='$uid' and `defaults`=1");
?>
<ul>
		<li class="addre">
        <p><span><?php echo $flag_row['sname']; ?></span>&nbsp;
        <span><?php echo $flag_row['mobile']; ?></span>
        <span class="fr" style="color:green;">默认地址</span></p>
        <p><?php echo $flag_row['province'].$flag_row['city'].$flag_row['country']; ?></p>
        </li>
        <div class="cl"></div>
		<div class="solid"></div>
        
<?php
$dosql->Execute("select * from `#@__address` where `uid`='$uid' and `defaults`<>1 order by id desc");
while($row=$dosql->GetArray()){
?>        
        <li class="addre">
        <p><span><?php echo $row['sname']; ?></span>&nbsp;
        <span><?php echo $row['mobile']; ?></span>
        <span class="fr" onClick="Lqb_Update(<?php echo $row['id']; ?>)" style="color:ff5100;">设为默认地址</span></p>
        <p><?php echo $flag_row['province'].$flag_row['city'].$flag_row['country']; ?></p>
        </li>
        <div class="cl"></div>
		<div class="solid"></div>
<?php
}
?>         
</ul>
</section>
<div style="height:60px;"></div>
<div class="tianjia1">

    <p><a href="javascript:Lqb_Add()" id="queding">添加新地址</a></p>

    </div>

<?php
}











else if($action == 'update')
{//设为默认地址
	$uid=isset($uid) ? $uid : '' ;
	
	$id=isset($id) ? $id : '' ;
	
	$dosql->execnonequery("update `#@__address` set `defaults`=0 where uid='$uid'");
	
	$sql=("update `#@__address` set `defaults`=1 where uid='$uid' and id='$id'");
	
	$shoujian = $dosql ->GetOne("select * from `#@__address` where uid='$uid' and id='$id'");
      
	if($dosql->execnonequery($sql))
	{
	?>	
    <div class="ddy_sjr_add"  onClick="ddy_add_list()">
        <input type="hidden" value="<?php echo $shoujian['id']; ?>" name="dizhi">
        <span onClick="Lqb_List()"><span class="dizhi" >收件人：<?php echo $shoujian['sname']; ?>（<?php echo $shoujian['mobile']; ?>）<br>
        <font class="grey_9"><?php echo $shoujian['address']; ?></font></span> </span> 
    </div>
    <?php
	}else{
		echo 1;
		}
}










else if($action == 'del')
{//删除地址
	$uid=isset($uid) ? $uid : '' ;
	
	$id=isset($id) ? $id : '' ;
	
	$sql="DELETE FROM `#@__address` where uid='$uid' and id='$id'";
	//echo $sql;die;
	if($dosql->ExecNoneQuery($sql))
	{
		$dosql->Execute("select * from `#@__address` where `uid`='$uid' order by id desc");
		while($row_add=$dosql->GetArray()){
	?>
   <li class="addre"><br>
          <span onClick="moren(<?php echo $row_add['id']; ?>)">
          <p><span><?php echo $row_add['sname']?></span>&nbsp;&nbsp;<span><?php echo $row_add['mobile'] ?></span>
            <?php if($row_add['defaults']=='1'){?>
            <span style="color:#fff; border-radius:5px; background:#F00; padding:1% 2%; font-size:12px;">默认</span>
            <?php }?>
          </p>
          <p><?php echo $row_add['province'].'&nbsp;'.$row_add['city'].'&nbsp;'.$row_add['country'].'&nbsp;'.$row_add['address'];?>(<?php echo $row_add['code'] ?>)</p>
          <br>
          </span>
          <ul class="tc biji">
            <li style="border-right:1px solid #eee;" onClick="Lqb_bianji(<?php echo $row_add['id']; ?>)"><img src="images/upda.png"><a href="javascript:;">编辑</a></li>
            <li onClick="Lqb_del(<?php echo $row_add['id']; ?>)"><img src="images/del.png"><a href="javascript:;">删除</a></li>
          </ul>
        </li>
        <div class="cl"></div>
        <div class="solid1"></div>
        
    <?php
		}
	}else{
		echo "1";
		}
}






else if($action == 'bianji')
{//设为默认地址
	$uid=isset($uid) ? $uid : '' ;
	$id=isset($id) ? $id : '' ;
	$sname=isset($sname) ? $sname : '' ;
	$mobile=isset($mobile) ? $mobile : '' ;
	$province=isset($province) ? $province : '' ;
	$city=isset($city) ? $city : '' ;
	$country=isset($country) ? $country : '' ;
	$address=isset($address) ? $address : '' ;
	$defaults=isset($defaults) ? $defaults : '' ;
	$dosql->execnonequery("update `#@__address` set `defaults`=0 where uid='$uid'");
	
	$sql=("update `#@__address` set `sname`='$sname', `mobile`='$mobile', `province`='$province', `city`='$city', `country`='$country', `address`='$address', `defaults`='$defaults' where uid='$uid' and id='$id'");
	if($dosql->execnonequery($sql))
	{
		$dosql->Execute("select * from `#@__address` where `uid`='$uid' order by id desc");
		while($row_add=$dosql->GetArray()){
	?>
   <li class="addre"><br>
          <span onClick="moren(<?php echo $row_add['id']; ?>)">
          <p><span><?php echo $row_add['sname']?></span>&nbsp;&nbsp;<span><?php echo $row_add['mobile'] ?></span>
            <?php if($row_add['defaults']=='1'){?>
            <span style="color:#fff; border-radius:5px; background:#F00; padding:1% 2%; font-size:12px;">默认</span>
            <?php }?>
          </p>
          <p><?php echo $row_add['province'].'&nbsp;'.$row_add['city'].'&nbsp;'.$row_add['country'].'&nbsp;'.$row_add['address'];?>(<?php echo $row_add['code'] ?>)</p>
          <br>
          </span>
          <ul class="tc biji">
            <li style="border-right:1px solid #eee;" onClick="Lqb_bianji(<?php echo $row_add['id']; ?>)"><img src="images/upda.png"><a href="javascript:;">编辑</a></li>
            <li onClick="Lqb_del(<?php echo $row_add['id']; ?>)"><img src="images/del.png"><a href="javascript:;">删除</a></li>
          </ul>
        </li>
        <div class="cl"></div>
        <div class="solid1"></div>
        
    <?php
		}
	}else{
		echo "1";
		}
}




else if($action == 'address')
{//设为默认地址
	$uid=isset($uid) ? $uid : '' ;
	
	$shoujian = $dosql ->GetOne("select * from `#@__address` where uid='$uid' AND defaults='1'");
	if($shoujian['id'])
	{
	?>	
    <div class="ddy_sjr_add"  onClick="ddy_add_list()">
        <input type="hidden" value="<?php echo $shoujian['id']; ?>" name="dizhi">
        <span onClick="Lqb_List()"><span class="dizhi" >收件人：<?php echo $shoujian['sname']; ?>（<?php echo $shoujian['mobile']; ?>）<br>
        <font class="grey_9"><?php echo $shoujian['address']; ?></font></span> </span> 
    </div>
<?php
	}else
	{
		echo 1;
	}
}




else if($action == 'yincang_bianji')
{//设为默认地址
	$uid=isset($uid) ? $uid : '' ;
	
	$dosql->Execute("select * from `#@__address` where `uid`='$uid' order by id desc");
		while($yincang_bianji=$dosql->GetArray()){
	?>	
    <div class="ddy_add_fixed2 bianji<?php echo $yincang_bianji['id'];?>">
    <ul class="ddy_add_con2">
      <li class="tc pos">编辑收货地址<a href="#" class="ddy_add_con_close" onclick="cart_close2()"><img src="images/a38.png" alt=""></a></li>
     
      <li>
        <input type="text" placeholder="姓名" class="grey_9 ddy_add_inp sname<?php echo $yincang_bianji['id'];?>" value="<?php echo $yincang_bianji['sname'];?>">
      </li>
      <li>
        <input type="tel" placeholder="联系电话" class="grey_9 ddy_add_inp mobile<?php echo $yincang_bianji['id'];?>" value="<?php echo $yincang_bianji['mobile'];?>">
      </li>
      <li><span class="fl">黑龙江省、哈尔滨市、双城区</span>
        <input type="hidden" id="Select1" class="grey_9 ddy_add_inp province<?php echo $yincang_bianji['id'];?>" name="province" value="黑龙江省">
        <input type="hidden" id="Select2" class="grey_9 ddy_add_inp city<?php echo $yincang_bianji['id'];?>" name="city" value="哈尔滨市">
        <input type="hidden" id="Select3" class="grey_9 ddy_add_inp country<?php echo $yincang_bianji['id'];?>" name="county" value="双城区">
        <span class="fr ddy_add_icon"><img src="images/a39.png" alt=""></span></a><div class="cl"></div></li>
      <li>
        <input type="text" placeholder="详细地址" class="grey_9 ddy_add_inp address<?php echo $yincang_bianji['id'];?>" value="<?php echo $yincang_bianji['address'];?>">
      </li>
      <li>
        <input type="tel" placeholder="邮政编码（选填）" class="grey_9 ddy_add_inp code<?php echo $yincang_bianji['id'];?>" value="<?php echo $yincang_bianji['code'];?>">
      </li>
      <div class="grey_bg"></div>
      <li><span class="fl">设为默认收货地址</span>
        <input type="radio" class="fr ddy_add_inp03 default<?php echo $yincang_bianji['id'];?>" name="defaults" id="defaults" value="1" <?php if($yincang_bianji['defaults']=='1'){echo "checked";}?>>
        <div class="cl"></div>
      </li>
      <a href="javascript:;" class="ddy_add_btn tc" onClick="Lqb_Add_bianji(<?php echo $yincang_bianji['id'];?>)">保存</a>
    </ul>
  </div>
<?php
	
		}
}

?>

































