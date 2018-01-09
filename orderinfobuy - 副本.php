<?php require_once(dirname(__FILE__).'/include/config.inc.php');
error_reporting(0);
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
/*function Lqb_Add()
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
			//alert(data)
			if(data == 1)
			{
				//Lqb_Back();
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
*/
function Lqb_Back()
{
	$("#ddy_add_fixed1").hide();
	
}
function moren(id){
		var uid=$("#uid").val();
		$.ajax({
			type:"POST",
			data:"action=update&uid="+uid+"&id="+id,
			url:"Ajax_add.php",
			success: function(data){
				if(data == 1)
				{
					alert('操作失败!');
					
				}
				else
				{
					$(".shoujian").html(data);
					$(".ddy_add_fixed1").hide();
					return false;
				}
			}
		})
	}
function Lqb_del(id){

	var uid=$("#uid").val();
	$.ajax({
		type:"POST",
		data:"action=del&uid="+uid+"&id="+id,
		url:"Ajax_add.php",
		success: function(data){
			if(data == 1)
			{
				alert('操作失败!');
				return false;
			}
			else
			{
				$("#bianji").html(data)
				Lqb_address();
			}
		}
	})
	
	}
function Lqb_bianji(id)
{
	$(".bianji"+id).show();
	$(".ddy_add_fixed1").hide();
}
function Lqb_Add_bianji(id)
{
	var sname=$(".sname"+id).val();
	var mobile=$(".mobile"+id).val();
	var province=$(".province"+id).val();
	var city=$(".city"+id).val();
	var country=$(".country"+id).val();
	var address=$(".address"+id).val();
	var defaults=$(".default"+id).val();
	var uid=$("#uid").val();
	$.ajax({
		type:"POST",
		data:"action=bianji&uid="+uid+"&id="+id+"&sname="+sname+"&mobile="+mobile+"&province="+province+"&city="+city+"&country="+country+"&address="+address+"&defaults="+defaults,
		url:"Ajax_add.php",
		success: function(data){
			if(data == 1)
			{
				$(".xianshi").text("操作失败！").show(300);
				setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				$("#sname").focus();
				return false;
			}
			else
			{
				$("#bianji").html(data)
				$(".ddy_add_fixed2").hide();
				$(".ddy_add_fixed1").show();
				Lqb_address()
				return false;
			}
		}
	})
}
function Lqb_Add_Insert()
{
	var sname=$("#sname").val();
	if(sname == "")
	{
		$(".xianshi").text("请输入姓名！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
		$("#sname").focus();
		return false;
	}
	var mobile=$("#mobile").val();
	if(mobile == "")
	{
		$(".xianshi").text("请输入电话！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
		$("#mobile").focus();
		return false;
	}
	var province=$("#Select1").val();
	if(province == "请选择")
	{
		$(".xianshi").text("请选择省份！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
		return false;
	}
	var city=$("#Select2").val();
	var country=$("#Select3").val();
	var address=$("#address").val();
	
	if(address == "")
	{
		$(".xianshi").text("请填写详细收货地址！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
		$("#address").focus();
		return false;
	}
	code=$("#code").val();
	if(code == "")
	{
		code='000000';
	}
	var uid=$("#uid").val();
	var radio = $("input[name='defaults']:checked").val(); 
	if(radio=='1'){
		var defaults = '1';
		}else{
		var defaults = '0';	
		}
	$.ajax({
		type:"POST",
		data:"action=insert&sname="+sname+"&mobile="+mobile+"&province="+province+"&city="+city+"&country="+country+"&address="+address+"&code="+code+"&uid="+uid+"&defaults="+defaults,
		url:"Ajax_add.php",
		success: function(data){
			if(data == 1)
			{
				//Lqb_Back();
				//location.reload();
				$(".xianshi").text("添加失败，请重新添加！").show(300);
				setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
			}
			else
			{
				//location.reload();
				$("#bianji").html(data);
				$(".ddy_add_fixed1").show();
				$(".ddy_add_fixed").hide();
				$("#hql").html(data);
				$("#sname").attr("value","");
				$("#mobile").attr("value","");
				$("#address").attr("value","");
				$("#code").attr("value","");
				ddy_sjr_add();
				yincang_bianji();
				return false;

			}
		}
	})
}
function ddy_sjr_add()
{
	var uid=$("#uid").val();
	$.post("Ajax_add.php",{action:"address",uid:uid},function(data){
		if(data == 1){
			$(".shoujianren").html('<div class="ddy_sjr_add"><input type="hidden" value=""  name="dizhi"><p style="text-align:center;cursor:pointer; line-height:30px;" class="dizhi" onClick="tianjia1()">添加收货地址</p></div>')
			}else{
				$(".shoujianren").html(data);
				/*$(".xianshi").text("网络错误！").show(300);
				setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);*/
		}
		});
	
}
function Lqb_address()
{
	var uid=$("#uid").val();
	$.post("Ajax_add.php",{action:"address",uid:uid},function(data){
		if(data == 1){
			$(".shoujianren").html('<div class="ddy_sjr_add"><input type="hidden" value=""  name="dizhi"><p style="text-align:center;cursor:pointer; line-height:30px;" class="dizhi" onClick="tianjia1()">添加收货地址</p></div>')
			}else{
				$(".shoujian").html(data);
				/*$(".xianshi").text("网络错误！").show(300);
				setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);*/
		}
		});
	
}
function yincang_bianji()
{
	var uid=$("#uid").val();
	$.post("Ajax_add.php",{action:"yincang_bianji",uid:uid},function(data){
		if(data == 1){
			$(".xianshi").text("网络错误！").show(300);
				setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
			}else{
				$(".yincang_bianji").html(data);
				
		}
		});
	
}
</script>
<?php echo GetHeader();?>
</head>
<style>
select {
	border: 0px solid #FFF;
	background: #FFF;
	appearance: none;
	-moz-appearance: none;
	-webkit-appearance: none;
	min-width: 200px;
	font-size:14px;
}
.magic-radio{
	width:100%;
  display: none; }	
.magic-radio + label {
  position: relative;
  cursor: pointer;
  vertical-align: middle;
  width:100%;}
.magic-radio + label:before{
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    width: 18px;
    height: 18px;
    content: '';
    border: 1px solid #c0c0c0; }
.magic-radio + label:after{
    position: absolute;
    display: none;
    content: ''; }
.magic-radio:checked + label:after{
  display: block; }

.magic-radio + label:before {
  border-radius: 50%; }

.magic-radio + label:after {
  	position: relative;
    float: right;
    margin-right: 13px;
    top: 4px;
    left: 9px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #f00;
  }

.magic-radio:checked + label:before {
  border: 1px solid #f00; }

.magic-radio:checked[disabled] + label:before {
  border: 1px solid #f00; }	
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
     <?php 
	
	$add_row=$dosql->getone("select * from `#@__address` where `uid`='$c_uname' and `defaults`=1");
	if(is_array($add_row)){
	?>
    	<div class="shoujian">
          <div class="ddy_sjr_add"  onClick="ddy_add_list()">
            <input type="hidden" value="<?php echo $add_row['id']; ?>" name="dizhi">
            <span onClick="Lqb_List()"><span class="dizhi" >收件人：<?php echo $add_row['sname']; ?>（<?php echo $add_row['mobile']; ?>）<br>
            <font class="grey_9"><?php echo $add_row['address']; ?></font></span> </span> </div>
        </div>    
      <?php
	}
	else
	{
	?>
    <div class="shoujianren">
      <div class="ddy_sjr_add">
        <input type="hidden" value=""  name="dizhi">
        <p style="text-align:center; cursor:pointer; line-height:30px;" class="dizhi" onClick="tianjia1()">添加收货地址</p>
      </div>
    </div>  
    <?php
    }
	?>
        <!--收货地址--> 
        <div class="ddy_sjr_fk" id="fukuan"><span class="fl">付款方式</span><span class="fr fankui">在线支付</span>
        <div class="cl"></div>
      </div>
<!--付款方式 STATR-->
<div class="ddy_add_fixed_fukuan">
    <ul class="ddy_add_con_fukuan">
      <li class="tc pos" style="padding:3%; border-bottom:1px solid #eee;">支付方式<a href="javascript:;" class="ddy_add_con_close" onclick="cart_close_fukuan()"><img src="images/a38.png" alt=""></a></li>
      <div>
        
        <li class="addre zf">
          <p><input type="radio" name="fangshi" value="1" checked class="fr magic-radio" id="z"><label for="z" class="fl">在线支付</label>
          <div class="cl"></div>
          </p>
        </li>
        <li class="addre hd">
          <p><input type="radio" name="fangshi" value="0" class="fr magic-radio" id="d"><label for="d" class="fl">货到付款</label>
          <div class="cl"></div>
          </p>
          
        </li>
        <div class="cl"></div>

      </div>
    </ul>
  </div>
<script>
$("#fukuan").click(function(){
	$(".ddy_add_fixed_fukuan").show();
	})
$(".hd").click(function(){
	$(".fankui").text('货到付款');
	$(".ddy_add_fixed_fukuan").hide();
	})	
$(".zf").click(function(){
	$(".fankui").text('在线支付');
	$(".ddy_add_fixed_fukuan").hide();
	})	
function cart_close_fukuan(){
	$(".ddy_add_fixed_fukuan").hide();
	}	
</script>
<!--付款方式 END-->  
      <div class="grey_bg"></div>
      <?php
	$he=0;
	if(!empty($attrid)){
		$r1 = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = '".$goodsid."'");
		$sql="SELECT * FROM `#@__goods` WHERE id = ".$goodsid."";
		if(!empty($attrid)){
		$rowattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$attrid);
		$r_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$rowattr['value']."'");
		}
		$integral=$r_jiage['jifen']*$count;
		$sum += $integral;
		
		$jiage=$r_jiage['price']*$count;
		$he+=$jiage;
		
		}else{
			$r1 = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = '".$goodsid."'");
			$integral=$r1['integral']*$count;
			$sum += $integral;
			$jiage=$r1['salesprice']*$count;
			$he+=$jiage;
			}
		$row = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = '".$goodsid."' and songhuo='true'");			
		if($row){
				if(!empty($attrid)){
				$peisongattr = $dosql -> GetOne("select * from `#@__goodsprice` where id=".$attrid);
				$peisong_jiage = $dosql -> GetOne("select * from `#@__goodsprice` where value='".$peisongattr['value']."'");
				$ps_jiage .= $peisong_jiage['price']*$count;
				}else{
				$peisong_jiage = $dosql -> GetOne("SELECT * FROM `#@__goods` WHERE id = '".$goodsid."'");
				$ps_jiage .= $peisong_jiage['salesprice']*$count;
				}
			}	

?>
      <input type="hidden" value="<?php echo $id; ?>" name="carid">
      <input type="hidden" value="<?php echo $attrid; ?>" name="attrid">
      <input type="hidden" value="<?php echo $r1['id']; ?>" name="goodsid">
      <input type="hidden" value="<?php echo $count ?>" name="goodsnum">
      <input type="hidden" value="<?php if($r_jiage['price']){echo $r_jiage['price'];}else{echo $r1['salesprice'];} ?>" name="goodsprice">
      <input type="hidden" value="<?php if($ps_jiage > GetFragment(14)){echo "0";}else{ echo GetFragment(9);}?>" name="peisongfei">
      <input type="hidden" value="<?php echo $sum;?>" name="jifen" >
      <div class="ddy_pro"> <span class="fl ddy_pro_pic"><img src="<?php echo $r1['picurl'];?>" alt="" height="62"></span> <span class="fl ddy_pro_con grey_9"><?php echo $r1['title'];?></span> <span class="fr tr"><font class="red">￥ <?php echo $jiage;?></font><br>
        </span>
        <div class="cl"></div>
      </div>
<div class="ddy_sjr_fk" id="peisong"><span class="fl">配送时间</span><span class="fr ps_fankui">
      <?php
      $r_p = $dosql -> GetOne("SELECT * FROM `#@__infolist` WHERE (classid=45 or parentid=45) AND delstate='' AND checkinfo=true ORDER BY orderid,id");
	  echo $r_p['title'];
	  ?>
      </span>
        <div class="cl"></div>
      </div>      
<!--配送时间 STATR-->
<div class="ddy_add_fixed_peisong">
    <ul class="ddy_add_con_peisong">
      <li class="tc pos" style="padding:3%; border-bottom:1px solid #eee;">配送时间<a href="javascript:;" class="ddy_add_con_close" onclick="cart_close_peisong()"><img src="images/a38.png" alt=""></a></li>
      <div>
         <?php 
		$dosql->Execute("SELECT * FROM `#@__infolist` WHERE (classid=45 or parentid=45) AND delstate='' AND checkinfo=true ORDER BY orderid,id");		$i=1;
		while($row_sj = $dosql->GetArray())
		{
		?>
        <li class="addre">
          <p><input type="radio" name="peisongtime" value="<?php echo $row_sj['title'];?>" class="fr magic-radio" id="<?php echo $i;?>" <?php if($i==1){ echo "checked ";}?>><label for="<?php echo $i;?>" class="fl"><?php echo $row_sj['title'];?></label>
          <div class="cl"></div>
          </p>
        </li>
        <?php $i++;}?>
        <div class="cl"></div>
        
      </div>
    </ul>
  </div>
<script>
$("#peisong").click(function(){
	$(".ddy_add_fixed_peisong").show();
	})
$("input[name='peisongtime']").click(function(){
	$(".ps_fankui").text($(this).val());
	$(".ddy_add_fixed_peisong").hide();
	})

function cart_close_peisong(){
	$(".ddy_add_fixed_peisong").hide();
	}	
</script>
<!--配送时间 END-->      
      <div class="ddy_sjr_fk" id="djq"><span class="fl">代金券</span><span class="fr djq_fankui">请选择代金券</span>
        <div class="cl"></div>
      </div>
<!--代金券 STATR-->
<div class="ddy_add_fixed_daijinquan">
    <ul class="ddy_add_con_daijinquan">
      <li class="tc pos" style="padding:3%; border-bottom:1px solid #eee;">代金券<a href="javascript:;" class="ddy_add_con_close" onclick="cart_close_daijinquan()"><img src="images/a38.png" alt=""></a></li>
      <div style=" height:215px; overflow:auto;">
	<?php
	if($he > '5'){
		$tim=time();
		$dosql->Execute("select * from `#@__youhuiquan` where zhuangtai<1 and dqsj>'$tim' and uid='$c_uname'");
		$tiaoshu=$dosql->GetTotalRow();
		if($tiaoshu>0){	
		?>
        <li class="addre">
			  <p>
              <input type="hidden" value="请选择代金券">
              <input type="radio" name="youhuiquan" value="0" class="fr magic-radio" id="xuanze" checked><label for="xuanze" class="fl">请选择代金券</label>
			  <div class="cl"></div>
			  </p>
			</li>
        <?
			$shu=10;
			while($youhui=$dosql->GetArray()){
				
				$daijin=$dosql->getone("select * from `#@__daijinquan` where id=".$youhui['jine_id']);	
			?>
			<li class="addre">
			  <p><input type="hidden" value="<?php echo $daijin['jine'].'元代金券' ?>" class="fr">
              <input type="radio" name="youhuiquan" value="<?php echo $daijin['jine'].",".$youhui['id'] ?>" class="fr magic-radio" id="<?php echo $shu;?>" ><label for="<?php echo $shu;?>" class="fl"><?php echo $daijin['jine'].'元代金券' ?></label>
              
			  <div class="cl"></div>
			  </p>
			</li>
			  <?php	
			$shu++;}	
		}else{
			?>
            <li class="addre">
			  <p>
              <input type="hidden" value="暂无可用优惠券">
              <input type="radio" name="youhuiquan" value="0" class="fr magic-radio" id="zanwu" checked><label for="zanwu" class="fl">暂无可用优惠券</label>
			  <div class="cl"></div>
			  </p>
			</li>
            <?php
		}
	}else{
		?>
         <li class="addre">
			  <p>
              <input type="hidden" value="商品总额不满足代金券使用规则">
              <input type="radio" name="youhuiquan" value="0" class="fr magic-radio" id="bumanzu" checked><label for="bumanzu" class="fl">商品总额不满足代金券使用规则</label>
			  <div class="cl"></div>
			  </p>
		</li>
        <?php
		}
	?>
        <div class="cl"></div>

        
      </div>
    </ul>
  </div>
<script>
$("#djq").click(function(){
	$(".ddy_add_fixed_daijinquan").show();
	})
$("input[name='youhuiquan']").click(function(){
	var stringArray =$(this).val().split(",");
	var peisongfei = $(".peisongfei").text();
	$("#price1").val(((parseInt($("#price").text()*10000))-(parseInt(stringArray[0]*10000))+(parseInt(peisongfei*10000)))/10000);
	$(".hyj").text((parseInt(stringArray[0]*10000))/10000);
	$("#uhqid").val(stringArray[1]);
	$(".djq_fankui").text($(this).prev().val());
	$(".ddy_add_fixed_daijinquan").hide();
	})

function cart_close_daijinquan(){
	$(".ddy_add_fixed_daijinquan").hide();
	}	
</script>
<!--代金券 END--> 
      <div class="ddy_djq"><span class="fl">商品小计：</span><span class="fr"><font class="red">￥<?php echo $he?></font></span>
        <div class="cl"></div>
      </div>
      <textarea class="ddy_gbook grey_9" placeholder="给卖家留言" name="beizhu" style="width:90%; min-height:100px;"></textarea>
      <div class="ddy_djq"><span class="fl">商品金额</span><span class="fr"><font class="red">￥<span id="price"><?php echo $he?></span></font></span>
        <div class="cl"></div>
      </div>
      <div class="ddy_djq"><span class="fl">总优惠</span><font class="red fr">￥<span class="hyj">0</span></font>
        <div class="cl"></div>
      </div>
      <div class="ddy_djq"><span class="fl">配送费</span><span class="fr"><font class="red">￥<span class="peisongfei"><?php if($ps_jiage >= GetFragment(14)){echo "0";}else{ echo GetFragment(9);}?>
        </span></font></span>
        <div class="cl"></div>
      </div>
      <div class="ddy_djq"><span class="fl">可得积分</span><font class="red fr"><?php echo $sum;?></font>
        <div class="cl"></div>
      </div>
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
        <li class="fl" style="margin-left:2%; color:#F00;">需付：￥
          <input type="text" value="<?php if($goodsid == '829'){echo $he;}else{if($ps_jiage > GetFragment(14)){echo $he;}else{echo $he+GetFragment(9);}}?>" name="fukuan" id="price1" style="width:55px; border:0px; background-color:#f7f7f7;color: red; -webkit-text-fill-color:red; -webkit-opacity:1; opacity: 1; font-size:14px; font-family:'微软雅黑'" disabled>
        </li>
        <!--<li class="ddy_bot_btn01 fr"><a href="goods_type.php">继续购物</a></li>-->
        <li class="ddy_bot_btn02 fr"><a href="javascript:;">确认订单</a>
        <input type="hidden" id="kaiguan" value="1">
        <!--<input type="submit" value="确认订单" style="border:none; color:#FFFFFF; background-color:rgba(0,0,0,0)">--></li>
        <script>
		$(".ddy_bot_btn02").click(function(){
			  var kaiguan= $("#kaiguan").val();
			  if(kaiguan==1){
				  $("#form").submit();
				  $("#kaiguan").val(0);
			  }else{
				   $(".xianshi").text("订单已提交，可在我的订单中查看！").show(300);
					setTimeout(function () {
					$(".xianshi").hide(300);
					}, 3000);
				  return false;
				  }
			})
		</script>
        <li><a href="#"></a></li>
        <div class="cl"></div>
      </ul>
    </footer>
  </form>
  <!--footer end--> 
 <!-- 填写收货地址 -->
  <!--选择收货地址-->
  <div class="ddy_add_fixed1">
    <ul class="ddy_add_con1">
      <li class="tc pos" style="padding:3%; border-bottom:1px solid #eee;">选择收货地址<a href="#" class="ddy_add_con_close" onclick="cart_close()"><img src="images/a38.png" alt=""></a></li>
      <div style="height:365px; overflow:auto;" id="bianji">
        <?php
//$flag_row=$dosql->getone("select * from `#@__address` where `uid`='$c_uname' and `defaults`=1");
?>
        <!--<li class="addre"><br>
        <p><span><?php echo $flag_row['sname']?></span>&nbsp;&nbsp;<span><?php echo $flag_row['mobile'] ?></span><span style="color:#fff; border-radius:5px; background:#F00; padding:1% 2%; font-size:12px;">默认</span></p>
        <p><?php echo $flag_row['province'].'&nbsp;'.$flag_row['city'].'&nbsp;'.$flag_row['country'].'&nbsp;'.$flag_row['address'];?>(<?php echo $flag_row['code'] ?>)</p><br>
            <ul class="tc biji">
            <li style="border-right:1px solid #eee;"><img src="images/upda.png"><a href="?c=address_update&id=<?php echo $flag_row['id']; ?>">编辑</a></li>
            <li><img src="images/del.png"><a href="javascript:;">删除</a></li>
            </ul>
        </li>
        <div class="cl"></div>
		<div class="solid1"></div>--> 
        <span id="hql">
        <?php
$dosql->Execute("select * from `#@__address` where `uid`='$c_uname' order by id desc");
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
        <?php }?>
        </span> </div>
    </ul>
    <div class="tianjia1">
      <p><a href="javascript:Lqb_Add()" id="queding">添加新地址</a></p>
    </div>
  </div>
  <!--选择收货地址 END-->
  
  <!--添加收货地址-->
  <div class="ddy_add_fixed">
    <ul class="ddy_add_con">
      <li class="tc pos">添加收货地址<a href="#" class="ddy_add_con_close" onclick="cart_close1()"><img src="images/a38.png" alt=""></a></li>
      <li>
        <input type="text" placeholder="姓名" class="grey_9 ddy_add_inp" id="sname">
      </li>
      <li>
        <input type="tel" placeholder="联系电话" class="grey_9 ddy_add_inp" id="mobile">
      </li>
      <li><span class="fl">黑龙江省、哈尔滨市、双城区</span>
        <input type="hidden" id="Select1" name="province" value="黑龙江省">
        <input type="hidden" id="Select2" name="city" value="哈尔滨市">
        <input type="hidden" id="Select3" name="county" value="双城区">
        <span class="fr ddy_add_icon"><img src="images/a39.png" alt=""></span></a><div class="cl"></div></li>
      <li>
        <input type="text" placeholder="详细地址" class="grey_9 ddy_add_inp" id="address">
      </li>
      <li>
        <input type="tel" placeholder="邮政编码（选填）" class="grey_9 ddy_add_inp" id="code">
      </li>
      <div class="grey_bg"></div>
      <li><span class="fl">设为默认收货地址</span>
        
        <input type="checkbox" class="fr ddy_add_inp03" name="defaults" value="1" checked>
        <div class="cl"></div>
      </li>
      <a href="javascript:;" class="ddy_add_btn tc" onClick="Lqb_Add_Insert()">保存</a>
    </ul>
  </div>
<!--添加收货地址 END--> 

<!--编辑收货地址-->
<div class="yincang_bianji">
<?php
	$dosql->Execute("select * from `#@__address` where `uid`='$c_uname' order by id desc");
	while($row_bianji=$dosql->GetArray()){
?>
  <div class="ddy_add_fixed2 bianji<?php echo $row_bianji['id'];?>">
    <ul class="ddy_add_con2">
      <li class="tc pos">编辑收货地址<a href="#" class="ddy_add_con_close" onclick="cart_close2()"><img src="images/a38.png" alt=""></a></li>
     
      <li>
        <input type="text" placeholder="姓名" class="grey_9 ddy_add_inp sname<?php echo $row_bianji['id'];?>" value="<?php echo $row_bianji['sname'];?>">
      </li>
      <li>
        <input type="tel" placeholder="联系电话" class="grey_9 ddy_add_inp mobile<?php echo $row_bianji['id'];?>" value="<?php echo $row_bianji['mobile'];?>">
      </li>
      <li><span class="fl">黑龙江省、哈尔滨市、双城区</span>
        <input type="hidden" id="Select1" class="grey_9 ddy_add_inp province<?php echo $row_bianji['id'];?>" name="province" value="黑龙江省">
        <input type="hidden" id="Select2" class="grey_9 ddy_add_inp city<?php echo $row_bianji['id'];?>" name="city" value="哈尔滨市">
        <input type="hidden" id="Select3" class="grey_9 ddy_add_inp country<?php echo $row_bianji['id'];?>" name="county" value="双城区">
        <span class="fr ddy_add_icon"><img src="images/a39.png" alt=""></span></a><div class="cl"></div></li>
      <li>
        <input type="text" placeholder="详细地址" class="grey_9 ddy_add_inp address<?php echo $row_bianji['id'];?>" value="<?php echo $row_bianji['address'];?>">
      </li>
      <li>
        <input type="tel" placeholder="邮政编码（选填）" class="grey_9 ddy_add_inp code<?php echo $row_bianji['id'];?>" value="<?php echo $row_bianji['code'];?>">
      </li>
      <div class="grey_bg"></div>
      <li><span class="fl">设为默认收货地址</span>
        <input type="radio" class="fr ddy_add_inp03 default<?php echo $row_bianji['id'];?>" name="defaults" id="defaults" value="1" <?php if($row_bianji['defaults']=='1'){echo "checked";}?>>
        <div class="cl"></div>
      </li>
      <a href="javascript:;" class="ddy_add_btn tc" onClick="Lqb_Add_bianji(<?php echo $row_bianji['id'];?>)">保存</a>
    </ul>
  </div>
<?php
	}
?> 
</div>
<!--编辑收货地址 END-->  
<script type="text/javascript">
addressInit('Select1', 'Select2', 'Select3');
function tianjia1(){
	$(".ddy_add_fixed").show();
	}
function ddy_add_list()
{
	$(".ddy_add_fixed1").show();
	return false;
}
function cart_close()
{
	$(".ddy_add_fixed1").hide();
	return false;
}
function cart_close1()
{
	$(".ddy_add_fixed").hide();
	return false;
}
function cart_close2()
{
	$(".ddy_add_fixed2").hide();
	return false;
}
function Lqb_Add(){
	$(".ddy_add_fixed1").hide();
	$(".ddy_add_fixed").show();
	return false;
	}
</script> 
<!-- 填写收货地址 --> 
  
  <script>
  function fun(){
    if(!$("#ename").val()){
		$(".xianshi").text("请输入姓名！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
      return false;
    }
    if($("#postarea_prov").val()=="省份"){
	  $(".xianshi").text("请输入省份！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
      return false;
    }
    if($("#postarea_city").val()=="地级市"){
	   $(".xianshi").text("请输入地级市！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
      return false;
    }
    var re = /^1\d{10}$/;
    if(!re.test($("#tel").val())){
	   $(".xianshi").text("请填写正确电话号码！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
      return false;
    }
    if(!$("#address").val()){
	  $(".xianshi").text("请输入地址！").show(300);
		setTimeout(function () {
		$(".xianshi").hide(300);
		}, 2000);
      return false;
    }
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
<!-- 填写收货地址 -->

<div class="xianshi" style="position:fixed; top:50%; left:18%; background:rgba(0,0,0,.5); width:60%; padding:0.5% 2%; height:30px;line-height:30px;margin-top:-15px;border-radius:3px;color:#fff;z-index:9999;text-align:center; display:none"></div>
</body>
</html>
