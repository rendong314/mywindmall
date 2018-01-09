<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$cid = empty($cid) ? 53 : intval($cid);
$id = empty($id) ? 0 : intval($id);
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
<?php echo GetHeader();?>
</head>

<body style="max-width:640px;margin:0 auto;">
<?php
	//检测文档正确性
	$r = $dosql->GetOne("SELECT * FROM `#@__goods` WHERE id=$id");
	if(@$r){
    	//增加一次点击量
    	$row = $dosql->GetOne("SELECT * FROM `#@__goods` WHERE typeid=$cid AND id=$id");
	}else{
	    ShowMsg('非法操作','-1');
	    exit();
	}
?>
<!--加入购车弹出 start-->
<div class="cart_fixed_bg">
  <div class="cart_fixed">
    <div class="cart_con">
      <li class="pos"><a href="javascript:;" class="cart_con_close"><img src="images/a15.png" alt="" onclick="cart_close()"></a><span class="fl cart_con_pic"><img src="<?php echo $r['picurl'];?>" alt=""></span><span class="fr cart_con_text"><font class="red">￥<span id="price"><?php echo $r['salesprice'];?></span> </font><br>
        库存：<span id="kucun"><?php echo $r['housenum'];?></span>件<br>
        请选择规格</span>
        <div class="cl"></div>
      </li>
      <input type="hidden" id="goodsid" value="<?php echo $r['id']; ?>">
      <input type="hidden" id="typeid" value="<?php echo $r['typeid']; ?>">
      <input type="hidden" name="aid" id="aid" value="<?php echo $id; ?>" />
      <input type="hidden" name="molds" id="molds" value="4" />
      <input type="hidden" id="attrid" value="">

      <?php
		 $dosql->Execute("select id,attrname from `#@__goodsattr` where goodsid=".$cid."",1);
		 $ii=1;
		 while($row1=$dosql->GetArray(1))
		 {
		?>
            <!--规格JS-->    
            <script type="text/javascript">
            function lei<?php echo $ii; ?>(id,aid,goodsid)
            {
                $('#'+id).addClass('a79_28f').siblings().removeClass('a79_28f');
                typeid=$("#typeid").val();
                var sa=$("#"+id).text();
				document.getElementById('count<?php echo $ii; ?>').value=sa;
                kj(typeid,goodsid);
                /*$.ajax({
                         type:"POST",
                         url:"Ajax_item.php",
                         data:"id="+sa+"&flag=1", 
                         success:function(data){
                               //根据返回值进行处理
                            if(data != '')
                            {
                                document.getElementById('count<?php echo $ii; ?>').value=sa;
                                kj(typeid,goodsid);
                            }
                                         
                        }
                });*/
            }
            </script>
      		<li class="cart_type01"><font class="line_3"><?php echo $row1['attrname'];?></font><br>
		<?php 
            $row2 = $dosql->Execute('SELECT value FROM `#@__goodsprice` WHERE `goodsid`='.$id,2);
            $j=1;
			while($row2=$dosql->GetArray(2))
			{
				$rowattr = unserialize($row2['value']);
				$r[$j]=@$rowattr[$row1['id']];
				$j++;
			}
			$a=array_unique($r);
			
			for($i=1;$i<count($r);$i++)
			{
				if(!empty($a[$i]))
				{
		?>
        <a class="a79" onclick="lei<?php echo $ii; ?>(<?php echo $i.$row1['id']; ?>,<?php echo $row1['id']; ?>,<?php echo $id; ?>)" id="<?php echo $i.$row1['id']; ?>" ><?php echo @$a[$i]; ?></a>
        <?php
				}
			}
		?>
        <div class="cl"></div>
      </li>
      <input type="hidden" id="count<?php echo $ii; ?>" value="">
      <?php
			$ii++;
		}
	  ?>
	<script type="text/javascript">
    function kj(typeid,goodsid)
    {
        var count='';
        <?php
        $dosql->Execute("select id,attrname from `#@__goodsattr` where goodsid=".$row['typeid']."");
        $ii=1;
        while($row1=$dosql->GetArray())
        {
        ?>
            count<?php echo $ii; ?>=$("#count<?php echo $ii; ?>").val();
            count=count+","+count<?php echo $ii; ?>;
        <?php
        $ii++;
        }
        ?>
        $.ajax({
                 type:"POST",
                 url:"Ajax_item.php",
                 data:"count="+count+"&flag=2&typeid="+typeid+"&goodsid="+goodsid, 
				 async : false,
                 success:function(data){
                       //根据返回值进行处理
                    if(data != '')
                    {
                        var myVariable = data;
                        var stringArray =myVariable.split(",");
                        stringArray[0]=$.trim(stringArray[0]);
                        //alert(stringArray[0])
                        $("#kucun").text(stringArray[0]);
                        $("#price").text(stringArray[1]);
                        $("#attrid").val(stringArray[2]);
                        var kucun=$("#kucun").text();
                        //var count=$("#count").val();
                        if(parseInt(count) > parseInt(kucun))
                        {
                            count=$("#count").val(kucun);
                        }
                    }	 
                }
        })
    }
    
    </script>      
<!--规格JS END-->      
      <li><span class="fl">购买数量</span><span class="fr cart_sum"> 
        <script type="text/javascript" src="js/payfor.js"></script> 
        <font class="fl font_18"><img src="images/a16.png" alt="" class="thpic_left reduce" onClick="setAmount.reduce('#qty_item_1')" style="width:20px; height:20px;"></font>
        <input type="text" name="buynum" value="1" class="fl tc cart_sum_inp" id="qty_item_1" onKeyUp="setAmount.modify('#qty_item_1')">
        <font class="fl font_18"><img src="images/a17.png" alt="" class="thpic_left add" onClick="setAmount.add('#qty_item_1')" style="width:20px; height:20px;"></font> </span>
        <div class="cl"></div>
      </li>
    </div>
    <div class="cart_bot tc"> <a href="javascript:;" class="cart_bot_bg01" onclick="ShoppingCar();">加入购物车</a> <a href="javascript:;" class="cart_bot_bg02" onclick="Purchase();">立即购买</a> 
      <script type="text/javascript">
function Purchase()//购买
{
	attrid=$("#attrid").val();
	goodsid=$("#goodsid").val();
	count=$("#qty_item_1").val();
	kucun=$("#kucun").text();
	$.ajax({
		type:"POST",
		url:"Ajax_Purchase.php",
		async : false,
		data:"attrid="+attrid+"&goodsid="+goodsid+"&count="+count+"&kucun="+kucun,
		success: function(data){
			if(data == '1'){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
				else if(data == '2'){
				$(".xianshi").text("请先登录！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;	
				}
				else if(data == '3'){
				$(".xianshi").text("请选择商品属性！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;	
				}
				else if(data == '4'){
					if(attrid =='')
					{
						window.location.href='orderinfobuy.php?count='+count+'&goodsid='+goodsid
					}else
					{
						window.location.href='orderinfobuy.php?count='+count+'&attrid='+attrid+'&goodsid='+goodsid
					}
				return false;	
				}
			/*if(data ==1)
			{
				if(attrid =='')
				{
					window.location.href='orderinfobuy.php?count='+count+'&goodsid='+goodsid
				}else
				{
					window.location.href='orderinfobuy.php?count='+count+'&attrid='+attrid+'&goodsid='+goodsid
				}
				
			}*/else
			{
				Alert(data);
			}
		}
	}) 
}

function ShoppingCar()//加入购物车
{	
	attrid=$("#attrid").val();
	goodsid=$("#goodsid").val();
	count=$("#qty_item_1").val();
	kucun=$("#kucun").text();
	$.ajax({
		type:"POST",
		url:"Ajax_ShoppingCar.php",
		async : false,
		data:"attrid="+attrid+"&goodsid="+goodsid+"&count="+count+"&kucun="+kucun,
		success: function(data){
			//alert(data)
			if(data == '1'){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
			else if(data == '2'){
				$(".xianshi").text("请先登录！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}	
			else if(data == '3'){
				$(".xianshi").text("请选择商品属性！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
			else if(data == '4'){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
			else if(data == '5'){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}	
			else if(data == '6'){
				$(".xianshi").text("成功加入购物车！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				ShoppingCar2(attrid,goodsid,count);
				return false;
				}
			else if(data == '7'){
				$(".xianshi").text("加入失败！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}	
			else
				{
					Alert(data);
				}				
			/*if(data == '成功加入购物车!')
			{
				ShoppingCar2(attrid,goodsid,count);

			}else
			{
				if(data == 2)
				{
					Alert_Te('请先登录');
				}else
				{
					//Alert(data);
				}	
			}*/
		}
	})
	
}
function ShoppingCar2(attrid,goodsid,count)
{
	$("#attrid_1").val(attrid);
	$("#goodsid_1").val(goodsid);
	$("#count_1").val(count);
    document.getElementById("ShoppingCar").submit();
	
}

</script>
      <div class="cl"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
function cart_list()
{
	$(".cart_fixed_bg").show();
	return false;
}
</script> 
<script type="text/javascript">
function cart_close()
{
	$(".cart_fixed_bg").hide();
	$("#shuliang").text($("#qty_item_1").val());
	return false;
}
</script> 
<!--加入购车弹出 start-->

<!--banner start-->
<div class="banner mar_5">
  <div id="Banner">
    <div class="swipe" style="overflow: hidden; visibility: visible; list-style: none; position: relative;">
      <ul id="slider" style="position: relative; overflow: hidden; transition: left 600ms ease; width:1905px; left: -1270px;">
        <?php
	  if(!empty($r['picarr'])){
	  	 $goodspic=explode(',',$r['picarr']);
		 foreach($goodspic as $goodspicarr){
	  ?>
        <li onclick="window.location.href=&#39;javascript:void(0)&#39;" style="float: left; display: block; width: 635px;"><img src="<?php echo $goodspicarr?>" alt="" width="100%" style=" max-height:300px;"></li>
        <?php
		 }}else{
	   ?>
        <li onclick="window.location.href=&#39;javascript:void(0)&#39;" style="float: left; display: block; width: 635px;"><img src="<?php echo $r['picurl'];?>" alt="" width="100%" style=" max-height:300px;"></li>
        <?php
		 }
	   ?>
      </ul>
      <div id="pagenavi_pro">
        <?php
	  if(!empty($r['picarr'])){
	  	 $goodspic=explode(',',$r['picarr']);
		 $num = count($goodspic);
		 //echo $num;
		 for($i=1; $i<=$num; $i++){
	  ?>
        <a <?php if($i=='1'){?>class="active"<?php }?> href="javascript:void(0);"></a>
        <?php
      }}else{
		 ?>
        <a class="active" href="javascript:void(0);"></a>
        <?php }?>
      </div>
    </div>
  </div>
</div>
<!--收藏JS-->
<script type="text/javascript">
var active=0,
as=document.getElementById('pagenavi_pro').getElementsByTagName('a');	
for(var i=0;i<as.length;i++){
(function(){
var j=i;
as[i].onclick=function(){
	t2.slide(j);
	return false;
}
})();
}
var t1=new TouchScroll({id:'wrapper','width':5,'opacity':0.7,color:'#555',minLength:20});
var t2=new TouchSlider({id:'slider', speed:600, timeout:3000, before:function(index){
as[active].className='';
active=index;
as[active].className='active';
}});
function AddUserFavorite()
{
	var aid   = $("#aid").val();
	var molds = $("#molds").val();
	$.ajax({
		url : "member.php",
		type: "post",
		async : false,
		data:{"a":"savefavorite", "aid":aid, "molds":molds},
		dataType:'html',
		success:function(data){
			if(data == 1){
				//alert("收藏成功！");
				$(".shoucang").attr("src","images/a088.png");
				$(".sc_text").css("color","red").text("已收藏");
				$(".xianshi").text("收藏成功！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return;
			}
			else if(data == 2){
				//alert("亲，您已经收藏过该商品！");
				$.post("Ajax_delfavorite.php",{a:'delfavorite',aid:aid,uid:<?php echo $c_uname?>},function(data){
					if(data == 3){
						$(".shoucang").attr("src","images/a08.png");
						$(".sc_text").css("color","#000").text("收藏");
						$(".xianshi").text("取消收藏！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
						return;
								}	
					})
				return;
			}
			else{
				//alert("收藏失败！");
				$(".xianshi").text("收藏失败！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return;
			}
		}
	});
}
</script> 
<!--banner end--> 

<!--main start-->
<section>
  <div class="pro_xqy_con line_2"><span class="fl pro_xqy_tit"><?php echo $r['title'];?><br>
    <font class="red">价格：￥ <?php echo $r['salesprice'];?>
    </font></span><span class="fr pro_collection tc" onclick="AddUserFavorite(<?php echo $id; ?>,4)">
    <?php $shoucang = $dosql->GetOne("SELECT id FROM `#@__userfavorite` WHERE aid='$id' and uid='$c_uname'");
	if(empty($shoucang)){
	?>
    <img src="images/a08.png" alt="" class="shoucang">
    <br>
    <span class="sc_text">收藏</span>
    <?php
	}else{
	?>
    <img src="images/a088.png" alt="" class="shoucang">
    <br>
    <span class="red sc_text">已收藏</span>
    <?php }?>
    </span>
    <div class="cl"></div>
  </div>
  <div class="pro_xqy_con"><span class="fl">优惠：<?php echo GetFragment(8);?></span> <span class="fr">销量：<?php echo $r['monthsell'];?></span>   <span class="fr" style=" margin-right:5%;-webkit-tap-highlight-color:transparent;">
   <?php $zan_img = $dosql->GetOne("SELECT id FROM `#@__zan` WHERE goodsid='$id' and uid='19233'");
	if(empty($zan_img)){
	?>
   <img src="images/zan_hui.png" class="zan" style="width:18px; height:18px; cursor:pointer;" onClick="zan()">
    <?php
	}else{
	?>
   <img src="images/zan.png" class="zan" style="width:18px; height:18px; cursor:pointer;" onClick="qx_zan()">
   <?php }?>  
  ：<span class="zanshu">
   <?php 
  $zan = $dosql -> GetOne("select count(id) as zanshu from `#@__zan` where goodsid ='$id'");
  echo $zan['zanshu'];
  ?></span>
    </span>
<!--点赞AJAX-->    
<script>
	function zan()
	{
		$.ajax({
			type:"POST",
			url:"Ajax_dianzan.php",
			data:"a=zanadd&goodsid=<?php echo $id; ?>&uid=19233",
			success: function(data)
			{
				
				if(data==1)
				{
					//alert('成功点赞！')
					$(".zan").attr("onClick","qx_zan()");
					$(".zan").attr("src","images/zan.png");
					$(".xianshi").text("成功点赞！").show(300);
					setTimeout(function () {$(".xianshi").hide(300);}, 2000);
					$(".zanshu").text(<?php echo $zan['zanshu']+1?>);
					return false;
				}
				else if(data==2)
				{
					$(".xianshi").text("点赞失败！").show(300);
					setTimeout(function () {$(".xianshi").hide(300);}, 2000);
					return false;
				}

				else if(data==4)
				{
					//alert('网络错误！')	
					$(".xianshi").text("网络错误！").show(300);
					setTimeout(function () {$(".xianshi").hide(300);}, 2000);
					return false;
				}
			}
		})
	}
	function qx_zan()
	{
		$.ajax({
			type:"POST",
			url:"Ajax_dianzan.php",
			data:"a=delzan&goodsid=<?php echo $id?>&uid=19233",
			success: function(data)
			{
				if(data==5)
				{
					var zanshu = $(".zanshu").text();
					$(".zan").attr("src","images/zan_hui.png");
					$(".zan").attr("onClick","zan()");	
					$(".zanshu").text(zanshu-1);
					$(".xianshi").text("取消点赞！").show(300);
					setTimeout(function () {$(".xianshi").hide(300);}, 2000);
				}
			}					
		})
	}
	</script>  
<!--点赞AJAX END-->       
    <div class="cl"></div>
  </div>
  <div class="pro_jf mar_3"><span class="pro_jf_bor fl">积分</span><span class="fl" id="jf">
    <?php if($r['integral']!='0'){?>
    购买可获得<?php echo $r['integral'];?>积分
    <?php }else{?>
    此商品暂不支持积分！
    <?php }?>
    </span><span class="fr font_16 jiantou">></span> 
    <!--点击之后-->
    <div class="jfxq" style="display:none;"><br>
      <br>
      <?php if($r['integral']!='0'){?>
      购买可获得<?php echo $r['integral'];?>积分
      <?php }else{?>
      此商品暂不支持积分！
      <?php }?>
    </div>
    <div class="cl"></div>
  </div>
  <!--积分窗口JS--> 
  <script>
  $(".pro_jf").click(function(){
	  var pro_jf_bor = $(".pro_jf_bor").text();
	  if(pro_jf_bor=='积分'){
		   $(".pro_jf_bor").text("积分详情");
		   $(".pro_jf").height(100);
		   $("#jf").hide();
		   $(".jiantou").text("∨");
		  }else{
			   $(".pro_jf_bor").text("积分");
			   $(".pro_jf").height(30);
			   $("#jf").show();
			   $(".jiantou").text(">");
			  }
	  $(".jfxq").toggle();
	  })
  </script>
  <!--<div class="pro_sum mar_3" onClick="cart_list()"><span class="fl">数量：<span id="shuliang">1</span></span><span class="fr font_16">></span>
    <div class="cl"></div>
  </div>-->
  <div class="pro_xqy_con"><span class="fl pro_xqy_logo"><img src="images/a09.jpg" alt=""></span><span class="fl pro_xqy_name"><font class="font_16 line_2">永富超市</font><br>
    <font class="fl" style="padding-right:1%"><img src="images/a10.png" alt=""></font><font class="fl green">微信认证</font></span>
    <div class="cl"></div>
  </div>
  <div><a href="goods_type.php" class="fl pro_xqy_shop tc"><span class="fl pro_xqy_shop_icon"><img src="images/a11.png" alt=""></span><span class="fl">全部商品</span></a><a href="index.php" class="fr pro_xqy_shop tc"><span class="fl pro_xqy_shop_icon"><img src="images/a12.png" alt=""></span><span class="fl">进入店铺</span></a>
    <div class="cl"></div>
  </div>
  <ul class="pro_xqy_type tc">
    <!--<li><a href="javascript:;" class="solid" id="tuwen">图文详情</a></li>-->
    <li><a href="javascript:;" class="solid" id="shuxing" style="height:39px;">商品属性</a></li>
    <li><a href="javascript:;" id="tuijain">商品推荐</a></li>
    <div class="cl"></div>
  </ul>
  <div class="pro_xqy_text"> <?php echo $r['content'];?> </div>
  <div class="pro_xqy_sq" style="display:none;"> <?php echo $r['guige'];?> </div>
  <div class="pro_xqy_tuijian" style="display:none;">
    <section>
      <ul class="main_pro_list font_12">
        <?php 

	$dosql->Execute("SELECT linkurl,typeid,id,picurl,title,salesprice FROM `#@__goods` WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND id != $id AND checkinfo=true ORDER BY orderid,id DESC limit 6");
	  if($dosql->GetTotalRow() > 0){
while($row_tj = $dosql->GetArray())
{       
 		if($row_tj['linkurl'] == '') $gourl = 'goods_show.php?cid='.$row_tj['typeid'].'&amp;id='.$row_tj['id'];
        else $gourl = $row['linkurl'];
?>
        <li><a href="<?php echo $gourl;?>"><img src="<?php echo $row_tj['picurl'];?>" alt="" height="150">
          <div style="height:40px;"><?php echo mb_substr($row_tj['title'],0,30,'utf-8');?></div>
          <span class="fl"><font class="jptj_red font_14">￥<?php echo $row_tj['salesprice'];?></font></span> <span class="fr main_pro_list_icon"></span>
          <div class="cl"></div>
          </a></li>
        <?php 
		}}else{
		?>
        <div style="height:40px;">暂无相关推荐！</div>
        <?php }?>
        <div class="cl"></div>
      </ul>
      <div class="cl"></div>
    </section>
  </div>
</section>
<!--main end--> 
<!--产品详情JS--> 
<script>
$("#tuwen").click(function(){
	$(".pro_xqy_text").show();
	$(".pro_xqy_sq").hide();
	$(".pro_xqy_tuijian").hide();
	$("#tuwen").attr("class","solid").css("height","39");
	$("#shuxing").attr("class","").css("height","40");
	$("#tuijain").attr("class","");
	})
$("#shuxing").click(function(){
	$(".pro_xqy_text").hide();
	$(".pro_xqy_sq").show();
	$(".pro_xqy_tuijian").hide();
	$("#tuwen").attr("class","");
	$("#shuxing").attr("class","solid").css("height","39");
	$("#tuijain").attr("class","").css("height","40");
	})
$("#tuijain").click(function(){
	$(".pro_xqy_text").hide();
	$(".pro_xqy_sq").hide();
	$(".pro_xqy_tuijian").show();
	$("#tuwen").attr("class","");
	$("#shuxing").attr("class","").css("height","40");
	$("#tuijain").attr("class","solid").css("height","39");
	})			
</script> 
<!--footer start-->
<footer>
  <div style="height:60px;"></div>
  <ul class="pro_xqy_bot tc">
    <li class="pro_xqy_bot_icon01 fl" style="margin-left:2%;"><a href="goodscar.php"><img src="images/a13.png" alt=""></a></li>
    <li class="pro_xqy_bot_icon01 fl" style="margin-left:2%;"><a href="member.php?c=default"><img src="images/a14.png" alt=""></a></li>
    <li class="pro_xqy_bot_btn01 fr"><a href="javascript:;"  onClick="cart_list()" >立即购买</a></li>
    <li class="pro_xqy_bot_btn02 fr"><a href="javascript:;"  onClick="cart_list()" >加入购物车</a></li>
    <li><a href="#"></a></li>
    <div class="cl"></div>
  </ul>
</footer>
<!--footer end--> 

<div class="xianshi" style="position:fixed; top:50%; left:25%; background:rgba(0,0,0,.5); width:50%; padding:0.5% 2%; height:30px;line-height:30px;margin-top:-15px;border-radius:3px;color:#fff;z-index:9999;text-align:center; display:none"></div>
</body>
</html>
