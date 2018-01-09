<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 
$a = isset($a) ? $a : '';
$goodsid = isset($goodsid) ? $goodsid : '';
$attrid = isset($attrid) ? $attrid : '';
$gwc = isset($gwc) ? $gwc : '';
$shuxing = isset($shuxing) ? $shuxing : '';
$sel = isset($sel) ? $sel : '';
$count = isset($count) ? $count : '';
$c_uname = AuthCode($_COOKIE['username']);
if(empty($goodsid)){
	header("Location:index.php");
	}
//假设现在登录的会员ID为1，接openid的时候替换下即可。传收货地址id 169行  date-url的值
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
<script type="text/javascript" src="js/getarea.js"></script>
<script type="text/javascript" src="templates/default/js/jquery.min.js"></script>
<script type="text/javascript" src="js/jsAddress.js"></script>
<script type="text/javascript">
function Lqb_Add()
{
	$.ajax({
		type:"POST",
		data:"action=insert_html",
		url:"Ajax_add.php",
		success: function(data){
			$("#add_insert").html(data);
			$("#add_list").hide();
			$("#body").hide();
			$("#add_insert").show(500);
			return false;
		}
	})
}
function Lqb_Back()
{
	$("#add_insert").hide(500);
	$("#add_list").hide(500);
	$("#body").show(500);
}
function Lqb_List()
{
	var uid=$("#uid").val();
	$.ajax({
		type:"POST",
		data:"action=select_html&uid="+uid,
		url:"Ajax_add.php",
		success: function(data){
			$("#add_list").html(data);
			$("#add_insert").hide();
			$("#body").hide();
			$("#add_list").show(500);
			return false;
		}
	})
}
function Lqb_Update(id)
{
	var uid=$("#uid").val();
	$.ajax({
		type:"POST",
		data:"action=update&uid="+uid+"&id="+id,
		url:"Ajax_add.php",
		success: function(data){
			if(data == 1)
			{
				Lqb_Back();
				location.reload();
				return false;
			}
			else
			{
				alert('操作失败!');
			}
		}
	})
}
function Lqb_Add_Insert()
{
	var sname=$("#sname").val();
	if(sname == "")
	{
		alert("请输入姓名！");
		$("#sname").focus();
		return false;
	}
	var mobile=$("#mobile").val();
	if(mobile == "")
	{
		alert("请输入电话！");
		$("#mobile").focus();
		return false;
	}
	var province=$("#Select1").val();
	if(province == "请选择")
	{
		alert("请选择省份！");
		return false;
	}
	var city=$("#Select2").val();
	var country=$("#Select3").val();
	var address=$("#address").val();
	
	if(address == "")
	{
		alert("请填写详细收货地址！");
		$("#address").focus();
		return false;
	}
	code=$("#code").val();
	if(code == "")
	{
		code='000000';
	}
	var uid=$("#uid").val();
	$.ajax({
		type:"POST",
		data:"action=insert&sname="+sname+"&mobile="+mobile+"&province="+province+"&city="+city+"&country="+country+"&address="+address+"&code="+code+"&uid="+uid,
		url:"Ajax_add.php",
		success: function(data){
			if(data == 1)
			{
				Lqb_Back();
				location.reload();
				return false;
			}
			else
			{
				alert('添加失败，请重新添加');
			}
		}
	})
}
</script>

<?php echo GetHeader();?>
</head>
<style>
select{ border:none;}
</style>
<body style="max-width:640px;margin:0 auto;">
<div id="add_insert" style="display:none;"></div>
<div id="add_list" style="display:none;"></div>
<!--main start--> 
<div id="body">

<form action="add_dz.php" id="form" method="post">
<section>
	<div class="ddy_top">确认订单后请尽快付款！</div>
    
    <!--收货地址-->
	<div class="ddy_sjr_add">
    <?php 
	
	$add_row=$dosql->getone("select * from `#@__address` where `uid`='$c_uname' and `defaults`=1");
	if(is_array($add_row)){
	?>
    <input type="hidden" value="<?php echo $add_row['id']; ?>" name="dizhi">
    <span onClick="Lqb_List()"><span class="dizhi" >收件人：<?php echo $add_row['sname']; ?>（<?php echo $add_row['mobile']; ?>）<br><font class="grey_9"><?php echo $add_row['address']; ?></font></span>
    <div style="width:15px; height:15px; float:right;">
        <img src="images/a20.png" style="cursor:pointer;" >
        </div>
        </span>
  	<?php
	}
	else
	{
	?>
    <input type="hidden" value=""  name="dizhi">
    <p style="text-align:center; cursor:pointer; line-height:30px;" class="dizhi"  onClick="Lqb_Add()">添加收货地址</p>
	<?php
    }
	?>
    <!--收货地址-->
        
    </div>
	<div class="ddy_sjr_fk"><span class="fl">付款方式</span><span class="fr">
    <select name="fangshi">
    	<option value="1">在线支付</option>
        <option value="0">货到付款</option>
    </select>
    </span><div class="cl"></div></div>
	<div class="grey_bg"></div>
    <?php
	$he=0;
	if($attrid){
		$r1 = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = ".$goodsid."");
		$sql = "SELECT * FROM `#@__goods` WHERE id = ".$goodsid."";
		$rowattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$attrid);
		$r_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$rowattr['value']."'");
		
		$integral=$r1['integral']*$count;
		$sum += $integral;
		if($rowattr){
			$jiage=$r_jiage['price']*$count;
			$he+=$jiage;
			}else{
			$jiage=$r1['salesprice']*$count;
			$he+=$jiage;
			}
		
		}else{
			$r1 = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = ".$goodsid."");
			$integral=$r1['integral']*$count;
			$sum += $integral;
			$jiage=$r1['salesprice']*$count;
			$he+=$jiage;
			}
		$row = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = ".$goodsid." and songhuo='true'");			
		if($row){
			$peisongattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$attrid);
			$peisong_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$peisongattr['value']."'");
			$ps_jiage .= $peisong_jiage['price']*$count;
			}	
		/*$r1 = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = ".$goodsid."");
		$shuliang=$_POST["buynum"];	
		$rowattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$r["attrid"]);
		$r_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$rowattr['value']."'");
		$integral=$r1['integral']*$shuliang;
		$sum += $integral;
			if($r_jiage){
			$jiage=$r_jiage['price']*$shuliang;
			$he+=$jiage;
			}else{
			$jiage=$r1['salesprice']*$shuliang;
			$he+=$jiage;
				}
				
		$row = $dosql -> GetOne("SELECT * FROM `#@__goodscar` WHERE id = ".$goodsid." and peisong='true'");			
		if($row){
			$peisongattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$row["attrid"]);
			$peisong_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$peisongattr['value']."'");
			$ps_jiage .= $peisong_jiage['price']*$shuliang;
			}*/
		
		
	
	
?>  
<input type="hidden" value="<?php echo $id; ?>" name="carid">
<input type="hidden" value="<?php echo $attrid; ?>" name="attrid">
<input type="hidden" value="<?php echo $r1['id']; ?>" name="goodsid">
<input type="hidden" value="<?php echo $count ?>" name="goodsnum">
<input type="hidden" value="<?php if($r_jiage['price']){echo $r_jiage['price'];}else{echo $r1['salesprice'];} ?>" name="goodsprice">
<input type="hidden" value="<?php if($ps_jiage > GetFragment(14)){echo "0";}else{ echo GetFragment(9);}?>" name="peisongfei">
<input type="hidden" value="<?php echo $r1['integral']*$count; ?>" name="jifen" >
	<div class="ddy_pro">
		<span class="fl ddy_pro_pic"><img src="<?php echo $r1['picurl'];?>" alt="" height="62"></span>
		<span class="fl ddy_pro_con grey_9"><?php echo $r1['title'];?></span>
		<span class="fr tr"><font class="red">￥
		<?php echo $jiage;?></font><br>	
      <!--<script type="text/javascript" src="js/payfor.js"></script>
      <font class="fl font_18" style="border:1px solid #ccc; background:#eee"><img src="images/a16.png" alt="" class="thpic_left reduce" onClick="setAmount.reduce('#qty_item_1')" style="width:20px; height:20px;"></font>
      <input type="text" name="buynum" value="<?php echo $row['count'];?>" class="fl tc ddy_pro_sum_inp" id="qty_item_1" onKeyUp="setAmount.modify('#qty_item_1')" style="border:1px solid #ccc; height:24px;">
      <font class="fl font_18" style="border:1px solid #ccc; background:#eee"><img src="images/a17.png" alt="" class="thpic_left add" onClick="setAmount.add('#qty_item_1')" style="width:20px; height:20px;"></font>--> 
		</span>
		<div class="cl"></div>
	</div>
   
	<div class="ddy_sjr_fk" style="padding: 2% 3% 2% 3%;"><span class="fl">配送时间</span><span class="fr">
    <select name="peisongtime" style=" padding:1px 3px; float:right;">
		<option value="双休日">双休日</option>
        <option value="工作日双休日均可">工作日双休日均可</option>
        <option value="双休日节假日均可">双休日节假日均可</option>
    </select>
    </span>
	<div class="cl"></div></div>
	<div class="ddy_djq"><span class="fl">代金卷</span><span class="fr"> <select name="youhuiquan" style=" padding:1px 3px; float:right" id="hyj" onChange="javascript:window.hyj()" accept-charset="utf-8">
    	
    <?php
	$tim=time();
	$dosql->Execute("select * from `#@__youhuiquan` where zhuangtai<1 and dqsj>'$tim'");
	$tiaoshu=$dosql->GetTotalRow();
	if($tiaoshu>0){	
	?>
		<option value="0">请选择优惠券</option>    
    <?php
	while($youhui=$dosql->GetArray()){
		
		$daijin=$dosql->getone("select * from `#@__daijinquan` where id=".$youhui['uid']);
	?>
    	
        	<option value="<?php echo $daijin['jine'].",".$youhui['id'] ?>"><?php echo $daijin['xxgz'] ?></option>
        
    <?php	
	}	}else{
				echo '<option value="0">暂无可用优惠券</option>';
	}
	
	?>
    </select></span><div class="cl"></div></div>
	<div class="ddy_djq"><span class="fl">商品小计：</span><span class="fr"><font class="red">￥<?php echo $he?></font></span><div class="cl"></div></div>
	<textarea class="ddy_gbook grey_9" placeholder="给卖家留言" name="beizhu" style="width:90%; min-height:100px;"></textarea>
	<div class="ddy_djq"><span class="fl">商品金额</span><span class="fr"><font class="red">￥<span id="price"><?php echo $he?></span></font></span><div class="cl"></div></div>
	<div class="ddy_djq"><span class="fl">总优惠</span><font class="red fr">￥<span class="hyj">0</span></font><div class="cl"></div></div>
    <div class="ddy_djq"><span class="fl">配送费</span><span class="fr"><font class="red">￥<span class="peisongfei"><?php if($ps_jiage > GetFragment(14)){echo "0";}else{ echo GetFragment(9);}?></span></font></span><div class="cl"></div></div>
    <div class="ddy_djq"><span class="fl">可得积分</span><font class="red fr"><?php echo $sum;?></font><div class="cl"></div></div>
    
   
<script type="text/javascript">
function hyj()
{
	var stringArray =$("#hyj").val().split(",");
	var peisongfei = $(".peisongfei").text();
	$("#price1").val(((parseInt($("#price").text()*10000))-(parseInt(stringArray[0]*10000))+(parseInt(peisongfei*10000)))/10000);
	$(".hyj").text((parseInt(stringArray[0]*10000))/10000);
	$("#uhqid").val(stringArray[1]);
}
</script>
    
	<!--<div class="ddy_djq"><span class="fl">运费</span><span class="fr"><font class="red">￥16.00</font></span><div class="cl"></div></div>-->
	<div class="grey_bg"></div>
</section>

<!--main end--> 
<input type="hidden" id="uhqid" name="youhuiquanid" value="0">
<input type="hidden" id="uid" name="uid" value="<?php echo $c_uname; ?>">
<input type="hidden" id="aa" name="aa" value="buyadd">
<!--footer start-->
<footer>
	<div style="height:60px;"></div>
	<ul class="pro_xqy_bot tc">
		<li class="red fl" style="margin-left:2%;">需付：￥<input type="text" value="<?php if($ps_jiage > GetFragment(14)){echo $he;}else{ echo $he+GetFragment(9);}?>" name="fukuan" id="price1" style="width:35px; border:0px; background-color:#FFFFFF;color:red;" disabled></li>
		<li class="ddy_bot_btn01 fr"><a href="goods_type.php">继续购物</a></li>
		<li class="ddy_bot_btn02 fr"><a href="javascript:form.submit();">确认订单</a><!--<input type="submit" value="确认订单" style="border:none; color:#FFFFFF; background-color:rgba(0,0,0,0)">--></li>
		<li><a href="#"></a></li>
		<div class="cl"></div>
	</ul>
</footer>

</form>
<!--footer end-->

<!-- 填写收货地址 -->

<script>
  function fun(){
    if(!$("#ename").val()){
      alert("请输入姓名");
      return false;
    }
    if($("#postarea_prov").val()=="省份"){
      alert("请输入省份");
      return false;
    }
    if($("#postarea_city").val()=="地级市"){
      alert("请输入地级市");
      return false;
    }
    var re = /^1\d{10}$/;
    if(!re.test($("#tel").val())){
      alert("请填写正确电话号码");
      return false;
    }
    if(!$("#address").val()){
      alert("请输入地址");
      return false;
    }
  }
</script>       

<script type="text/javascript">
function ddy_add_list()
{
	$(".ddy_add_fixed").show();
	return false;
}
</script>

<script type="text/javascript">
function cart_close()
{
	$(".ddy_add_fixed").hide();
	return false;
}
</script>

<script class="resources library" src="jss/area.js" type="text/javascript"></script>
<script type="text/javascript">_init_area();</script>
<script type="text/javascript">
var Gid  = document.getElementById ;
var showArea = function(){
  Gid('show').innerHTML = "<h3>省" + Gid('postarea_prov').value + " - 市" +  
  Gid('postarea_city').value + " - 县/区" + 
  Gid('postarea_country').value + "</h3>"
              }
Gid('s_county').setAttribute('onchange','showArea()');
</script>
</div>
<!-- 填写收货地址 --
</body>
</html>
