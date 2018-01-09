<?php require_once(dirname(__FILE__).'/include/config.inc.php');

//获取用户信息
$r_user = $dosql->GetOne("SELECT * FROM `#@__member` WHERE id='".AuthCode($_COOKIE['username'])."'");

$wxuser = json_decode($r_user['wx_info'],true);
$c_uname = AuthCode($_COOKIE['username']);
/*setCookie("cookieName","mgzs",time()+3600);
if(empty($_COOKIE['cookieName'])){
	//header("location:goodscar.php");
	echo $_COOKIE['cookieName']."1";
	}else{
	setCookie("cookieName","zs",time()-3600);	
	echo $_COOKIE['cookieName']."2";
	}*/
?>
<script type="text/javascript" src="js/Cookie.js"></script>
<script type="text/javascript" language="javascript">
		window.onload = function () {
			var ck = new Cookie("HasLoaded");  //每个页面的new Cookie名HasLoaded不能相同
			if (ck.Read() == null) {//未加载过，Cookie内容为空
				//alert("首次打开页面");
				var dd = new Date();
				dd = new Date(dd.getYear() + 1900, dd.getMonth(), dd.getDate());
				dd.setDate(dd.getDate() + 365);
				ck.setExpiresTime(dd);
				ck.Write("true");  //设置Cookie。只要IE不关闭，Cookie就一直存在
			}
			else {
				//alert("页面刷新");
				location.reload()
				delCookie("HasLoaded");
			}
 }
function delCookie(name){//为了删除指定名称的cookie，可以将其过期时间设定为一个过去的时间
   var date = new Date();
   date.setTime(date.getTime() - 10000);
   document.cookie = name + "=a; expires=" + date.toGMTString();
}
/*function clearCookie(){ 
    var keys=document.cookie.match(/[^ =;]+(?=\=)/g); 
    if (keys) { 
        for (var i = keys.length; i--;) 
            document.cookie=keys[i]+'=0;expires=' + new Date( 0).toUTCString() 
        } 
}*/	
</script>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link href="style/webstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js" ></script>
<script type="text/javascript" src="js/zVy3.js"></script>
<script type="text/javascript" src="js/zVy5.js"></script>
<script type="text/javascript" src="js/payfor.js"></script> 
<?php echo GetHeader(0)?>
</head>
<body style="max-width:640px;margin:0 auto;">
<!--main start-->
<script type="text/javascript">
function lqb_shan()
{
	var num3 = $("input[name='sel[]']:checked").length;
		if(num3==0){
			//alert("请选择要删除的商品");
			$(".xianshi").text("请选择要删除的商品！").show(300);
							setTimeout(function () {
							$(".xianshi").hide(300);
							}, 2000);
			return false;
			}else{
		 if(confirm("亲！确认删除吗？")){
			
					$("#form").attr("action","goodscar_del.php");
					$("#form").submit();
				
		 }else{
			 return false;
		 }
		 }
	
}
</script>
<form action="orderinfo.php" method="post" id="form">
<section>
  <div class="main_cart_tit"><span class="quanxuan"><img src="images/a22.png" id="quanxuanimg" style="width:16px;height:16px; float:left;"><span class="fl">全选</span></span><a href="javascript:lqb_shan();" class="fr"><img src="images/a21.png" alt="" class="main_cart_del"><font class="grey_9">删除</font></a>
    <div class="cl"></div>
  </div>
<?php
$dosql->Execute("select * from `#@__goodscar` where uid='$c_uname'",1);
$i=1;
while($row=$dosql->GetArray(1)){
	
	$r = $dosql -> GetOne("select * from `#@__goods` where id=".$row['goodsid']);
	$rowattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$row['attrid']);
	$row_attr = unserialize($rowattr['value']);
?>
  <div class="grey_bg"></div>
  <div class="main_cart_box"> <span class="fl main_cart_icon" id="selectbox"><img src="images/a22.png" alt="" id="tupian<?php echo $i;?>" zongjia='<?php $r_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$rowattr['value']."'");if($r_jiage){echo $r_jiage['price']*$row['count'];}else{ echo $r['salesprice']*$row['count'];}?>'>
    <input name="sel[]" id="sel<?php echo $i;?>" type="checkbox" class="sel" value="<?php echo $row["id"]?>" style="display:none">
    <input name="gg_id[]" type="checkbox" id="gg_id" value="<?php echo $rowattr['id']?>" style="display:none">
    </span><a href="goods_show.php?cid=<?php echo $r['typeid'];?>&id=<?php echo $row['goodsid'];?>"> <span class="fl main_cart_pic"><img src="<?php echo $r['picurl'];?>" alt="" height="55"></span> <span class="fl main_cart_con grey_9"><?php echo $r['title'];?><br>
    <?php
		$dosql->Execute("select * from `#@__goodsattr` where goodsid=".$r['typeid'],2);
		while($r_guige=$dosql->GetArray(2)){
		echo $r_guige['attrname'].":";
	    echo $row_attr[$r_guige['id']]."&nbsp;&nbsp;";
		 }
		
		?>
    </span></a> <span class="fr tr"><font class="red">￥</font>
    <font class="red" class="each" id="jine<?php echo $i;?>"><?php $r_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$rowattr['value']."'");if($r_jiage){echo $r_jiage['price']*$row['count'];}else{echo $r['salesprice']*$row['count'];}?></font><br>
    <input type="hidden" class="danjia<?php echo $i;?>" value="<?php if($r_jiage['price']){ echo $r_jiage['price'];}else{ echo $r['salesprice'];}?>">
    <input type="hidden" class="zongjia<?php echo $i;?>" value="">
    <font class="fl font_18" style="border:1px solid #ccc; background:#eee"><img src="images/a16.png" alt="" class="thpic_left reduce jian<?php echo $i;?>" onClick="setAmount.reduce('#qty_item_1<?php echo $i;?>')" style="width:20px; height:20px;"><input type="hidden" value="<?php echo $row['goodsid'];?>"></font>
    
    <input type="text" name="buynum[<?php echo $r['id'] ?>]" value="<?php echo $row['count'];?>" class="fl tc ddy_pro_sum_inp" id="qty_item_1<?php echo $i;?>" onKeyUp="setAmount.modify('#qty_item_1<?php echo $i;?>')" style="border:1px solid #ccc; height:22px;" readOnly="true">
    
    
    <font class="fl font_18" style="border:1px solid #ccc; background:#eee"><img src="images/a17.png" alt="" class="thpic_left add jia<?php echo $i;?>" onClick="setAmount.add('#qty_item_1<?php echo $i;?>')" style="width:20px; height:20px;"></font> </span>
    <div class="cl"></div>
  </div>
<input type="hidden" id="kucun<?php echo $i;?>" value="<?php if($rowattr['homenum']){echo $rowattr['homenum'];}else{echo $r['housenum'];}?>">
  <?php $i++;}?>
  <div class="cl"></div>
  <div class="grey_bg"></div>
</section>
<!--main end--> 

<!--footer start-->
<footer>
  <div style="height:60px;"></div>
  <ul class="main_cart_bot">
    <li class="main_cart_bot_btn fr tc" id="ceng sddd"><a href="javascript:;" id="check">结算（<span id="jss">0</span>）</a></li>
    <li>合计：<font class="red">￥<span id="price">0</span></font><br>
      不含运费</li>
    <div class="cl"></div>
  </ul>
</footer>
<?php require_once('footer.php');?>
<input name="total" id="total" type="hidden" value="0">
<input name="a" id="a" type="hidden" value="order">
</form>
<!--footer end--> 
<script>
$(function(){
	var m=1000000;
	<?php
	$dosql->Execute("select * from `#@__goodscar` where uid='$c_uname'");
	 $i=1;
	 while($row=$dosql->GetArray()){
	?>
	
	$(".jian<?php echo $i;?>").click(function(){
	var danjia = $(".danjia<?php echo $i;?>").val();
	var ddy_pro_sum_inp = $('#qty_item_1<?php echo $i;?>').val();
	var jine = $("#jine<?php echo $i;?>").text();
	//var price = parseInt(ddy_pro_sum_inp)*parseInt(danjia);

	if(parseFloat(jine).toFixed(2) != parseFloat(danjia).toFixed(2)){

			jg=(parseInt($("#jine<?php echo $i;?>").text()*m)-parseInt(danjia*m))/m;
			$("#jine<?php echo $i;?>").text(jg);
			$("#tupian<?php echo $i;?>").attr("zongjia",jg);
			
			ch=$("#sel<?php echo $i; ?>").attr("checked");
			if(ch == 'checked'){
				$("#price").text((parseInt($("#price").text()*m)-parseInt(danjia*m))/m);
			}
		}
	})
		
	$(".jia<?php echo $i;?>").click(function(){
	var danjia = $(".danjia<?php echo $i;?>").val();
	var ddy_pro_sum_inp = $('#qty_item_1<?php echo $i;?>').val();
	var jine = $("#jine<?php echo $i;?>").text();
	var kucun = $("#kucun<?php echo $i;?>").val();
	var qty_item_1 = $("#qty_item_1<?php echo $i;?>").val();

	//var price = parseInt(parseInt(ddy_pro_sum_inp*m)*danjia/m);
	//$("#jine<?php echo $i;?>").text(price);
	if(eval(qty_item_1) > eval(kucun)){
		//alert("库存不足");
		$(".xianshi").text("库存不足！").show(300);
							setTimeout(function () {
							$(".xianshi").hide(300);
							}, 2000);
		$("#qty_item_1<?php echo $i;?>").val(kucun);
		return false;
		}else{
	
	jg=(parseInt($("#jine<?php echo $i;?>").text()*m)+parseInt(danjia*m))/m;

	$("#jine<?php echo $i;?>").text(jg);
	$("#tupian<?php echo $i;?>").attr("zongjia",jg);
	
	ch=$("#sel<?php echo $i; ?>").attr("checked");
	if(ch == 'checked'){
		$("#price").text((parseInt($("#price").text()*m)+parseInt(danjia*m))/m);
	}
		}
	
	
	
	
	
	
	
		})		
	<?php
	 $i++;}
	?>
	
//单选
	$("#selectbox img").click(function(){
		var src = $(this).attr("src")
		if(src=="images/a22.png")
		{
			//alert("111");
			//取消
			var x_zong = (parseFloat($(this).attr("zongjia"))*m)/m;
			$(this).attr("src","images/a23.png")
			$(this).siblings("input").attr("checked",true)
			var num = $("input[name='sel[]']:checked").length
			$("#jss").text(num)
			if($("#price").text()==0){
				$("#price").text(x_zong)
				$("#total").val(x_zong);
				}else{
					var zong = $("#price").text();
					$("#price").text((parseFloat(x_zong)*m+parseFloat(zong)*m)/m);
					$("#total").val((parseFloat(x_zong)*m+parseFloat(zong)*m)/m);
					}
		
		}else{
			//选中
			var x_zong = (parseFloat($(this).attr("zongjia"))*m)/m;
			$(this).attr("src","images/a22.png");
			$(this).siblings("input").attr("checked",false);
			var num2 = $("input[name='sel[]']:checked").length;
			$("#jss").text(num2);
			if($("#price").text()==0){
				$("#price").text(0)
				}else{
					var zong = $("#price").text();
					$("#price").text((parseFloat(zong)*m-parseFloat(x_zong)*m)/m);
					$("#total").val((parseFloat(zong)*m-parseFloat(x_zong)*m)/m);
					
					}
			}
		})
		
		
//全选
	$(".quanxuan").click(function(){
		var danxuan = $("input[name='sel[]']")
		if(danxuan.attr('checked') == "checked")
		{
			danxuan.attr('checked',false)
			$("#quanxuanimg").attr("src","images/a22.png");
			danxuan.siblings("img").attr("src","images/a22.png");
			var num3 = $("input[name='sel[]']:checked").length;
			$("#jss").text(num3);
			$("#price").text(0);
			$("#total").val(0);
			}else{
				
				danxuan.attr('checked',true);
				$("#quanxuanimg").attr("src","images/a23.png");
				danxuan.siblings("img").attr("src","images/a23.png");
				var num4 = $("input[name='sel[]']:checked").length;
				$("#jss").text(num4);
				var qx=0;
	<?php
	$dosql->Execute("select * from `#@__goodscar` where uid='$c_uname'");
	 $i=1;
	 while($row=$dosql->GetArray()){
	?>
	
	qx1=$("#jine<?php echo $i; ?>").text();
	qx=(parseFloat(qx)*m+parseFloat(qx1)*m)/m;
	<?php
	 $i++;}
	?>
	$("#price").text(qx);
	$("#total").val(qx);
				}	
	})
	
	
$(".del").click(function(){
		var url = $(this).attr("url")
	   if(confirm("亲！确认删除吗？")){
	  		location.href=url
  		 }else{
			 return false
			 }
	})
	
$("#check").click(function(){
		var total = $("#total").val()
		var num = $("input[name='sel[]']:checked").length
		if(total==0)
		{
			$(".xianshi").text("请选择需要结算的商品！").show(300);
							setTimeout(function () {
							$(".xianshi").hide(300);
							}, 2000);
			return false
		}else if(num==0)
		{
			$(".xianshi").text("请选择需要结算的商品！").show(300);
							setTimeout(function () {
							$(".xianshi").hide(300);
							}, 2000);
			return false
		}
		$("#form").submit()
	})	
	
})
</script>
<div class="xianshi" style="position:fixed; top:50%; left:25%; background:rgba(0,0,0,.5); width:50%; padding:0.5% 2%; height:30px;line-height:30px;margin-top:-15px;border-radius:3px;color:#fff;z-index:9999;text-align:center; display:none"></div>
</body>
</html>
