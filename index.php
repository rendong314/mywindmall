<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 
	/*$useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
	if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false)
	{
	  die('请使用微信访问！');
	 }*/
	$regtime = time();
	
	if(isset($openid)){ 
		$r_user = $dosql->GetOne("SELECT * FROM `#@__member` WHERE openid='".$openid."'");
		if(empty($r_user['id'])){
			$sql = "INSERT INTO `fenxiao1000_member` (username,password,question,answer,cnname,enname,avatar,sex,birthtype,cardnum,intro,email,qqnum,mobile,telephone,address,zipcode,enteruser,expval,integral,regtime,openid,wx_info,yongjin) VALUES('','','','','','','',1,1,'','','','','','','','','',0,0,'$regtime','$openid','$info',0)";
				if($dosql->ExecNoneQuery($sql))
				{
					setcookie('username',AuthCode($dosql->GetLastID(),'ENCODE'), time()+3600*24*90);
				}
			
			
			
			
		}else if(empty($r_user['wx_info'])){
			$sql = "update `fenxiao1000_member` set openid='$openid',regtime='$regtime',wx_info='$info' where id =".$r_user['id'];
			if($dosql->ExecNoneQuery($sql)){
				setcookie('username',AuthCode($r_user['id'],'ENCODE'), time()+3600*24*90);	
			}	
		}else{
			setcookie('username',AuthCode($r_user['id'],'ENCODE'), time()+3600*24*90);
		}
	}else{
		
		if(!isset($_COOKIE['username'])){
			die("网络错误，请重新进入");
		}
		
	}					

	
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link href="style/webstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="style/swiper-3.4.2.min.css">
<!--<script type="text/javascript" src="js/jquery-1.11.3.js"></script>-->
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="js/zVy3.js"></script> 
<script type="text/javascript" src="js/zVy5.js"></script> 
<?php echo GetHeader();?>
</head>

<body style="max-width:640px;margin:0 auto;">
<!--banner start--> 

<div class="banner">
  <div id="Banner">
		<div class="swiper-container">
		<div class="swiper-wrapper">
		<?php 
		$dosql->Execute("SELECT picurl,linkurl FROM `#@__infoimg` WHERE classid=6 AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC");
		while($row = $dosql->GetArray()){ ?>
		<div class="swiper-slide"><a href="<?php echo $row['linkurl'];?>"><img src="/<?php echo $row['picurl'];?>" alt=""></a></div>
		<?php }?>
				  
		</div>
		<div class="swiper-pagination"></div>
	</div>
   </div>
</div>

<!--banner end-->  

<!--index start--> 
<!--search start--> 
<div style="background:#f1f1f1 ;padding:5% 0 0 0;">
	<div class="search_bor" style="border:none; background:#FFF;">
		<form name="search" id="search" method="get" action="search_list.php">
		<input type="image" src="images/index_06.jpg" class="fl ss_btn" id="search_btn" style=" margin-left:2%;cursor: none;">
		<input type="text" name="keyword" class="fl search_inp ss_bd" placeholder="商品搜索：<?php if(isset($keyword)){echo $keyword;} ?>" value="" style=" background:#FFF;">
		</form> 
		<div class="cl"></div>
	</div>
</div>
<!--search end-->  
<section style="background:#f1f1f1">
	<ul class="index_list tc">
		<li><a href="goods_show.php?cid=1&id=766"><img src="images/index_07.png" alt=""><br>柿饼试吃</a></li>
		<li><a href="goods_list.php?flag=c"><img src="images/index_08.png" alt=""><br>热销榜</a></li>
		<li><a href="member.php?c=default"><img src="images/index_09.png" alt=""><br>查询订单</a></li>
		<li><a href="kefu.html"><img src="images/index_11.png" alt=""><br>联系客服</a></li>
		<div class="cl"></div>
	</ul>
    <div style=" width:100%; background:#fff;">
	<div class="ann_tit"><span class="fl ann_org font_16">公告：</span><span class="fl" style="width:77%;">
    <div id="demo" style="overflow:hidden;width:100%;">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td id="demo1"><table width="500" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<!--循环开始-->
						<td align="center" style="padding-left:10px;">
                       <?php echo GetFragment(7);?>
                        </td>
				<!--循环结束-->

					</tr>
				</table></td>
			<td id="demo2"></td>
		</tr>
	</table>
	</div>
	<script> 
	var speed=30 
	demo2.innerHTML=demo1.innerHTML 
	function Marquee(){ 
	if(demo2.offsetWidth-demo.scrollLeft<=0) 
	demo.scrollLeft-=demo1.offsetWidth 
	else{ 
	demo.scrollLeft++ 
	} 
	} 
	var MyMar=setInterval(Marquee,speed) 
	demo.onmouseover=function() {clearInterval(MyMar)} 
	demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)} 
	</script>
	</span><div class="cl"></div></div>	
	</div>
    <div style="height:5px; width:100%; background:#f1f1f1"></div>
</section>

<section>
	<div class="dsj_tit"><span class="fl dsj_tit_text font_16">剁手价</span><span class="fl" style="color:#4c4a4b; margin-right:2%;">日期</span><span class="fl dsj_tit_date" style="line-height:20px;"><?php echo GetFragment(4);?></span><span class="fl" style="margin:0 1%;"><img src="images/date_line.jpg"></span><span class="fl dsj_tit_date" style="line-height:20px;"><?php echo GetFragment(5);?></span><a href="goods_list.php?cid=65" class="fr" style="color:#000;">查看更多 ></a></div>
	
	<ul class="dsj_list red">
    
    <?php 
$dosql->Execute("SELECT linkurl,classid,id,picurl,title,salesprice,marketprice FROM `#@__goods` WHERE classid=1 AND typeid='65' AND flag like '%a%' AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC limit 0,4");
while($row = $dosql->GetArray())
{       
 		if($row['linkurl'] == '') $gourl = 'goods_show.php?cid='.$row['classid'].'&amp;id='.$row['id'];
        else $gourl = $row['linkurl'];
?>
		<li><a href="<?php echo $gourl;?>" style="color:#000; font-size:10px;"><img src="<?php echo $row['picurl'];?>" alt="" style="width:90%; height:80px;"><br><span style="height:5px; display:block; margin-top:7px; line-height:14px;"><?php echo ReStrLen($row['title'],13,'');?></span><br><span class="fl" style="color:#f95228;">￥<?php echo $row['salesprice'];?></span><!--<s class="fr grey_9">￥<?php echo $row['marketprice'];?></s>--></a></li>
<?php }?>	
		
		
		<div class="cl"></div>
	</ul>
	
	
	
	<div class="dztj_bor">
		<div class="fl dztj_l">
			<a href="goods_list.php?flag=d&cgx=sy"><div class="dztj_tit font_16"><span class="fl dztj_tit_icon"><!--<img src="images/index_21.jpg" alt="">--></span><sapn class="fl">年货大街<br><font class="grey_6 font_12"><?php echo GetFragment(10,0);?></font></sapn><div class="cl"></div></div>
			<div class="dztj_pic"><img src="<?php echo GetFragment(10,2);?>" alt="" style="height:150px;"></div></a>
		</div>
		<div class="fr dztj_r">
			<a href="goods_list.php?flag=h&cgx=sy"><div class="xpss_tit font_16"><span class="fl xpss_tit_icon"><img src="images/index_18.jpg" alt="" style="width:25px; height:19px;"></span><sapn class="fl">新品上市</sapn><div class="cl"></div></div>
			<div class="dztj_pic"><img src="<?php echo GetFragment(11,2);?>" alt="" style="height:58px;"></div></a>
			<a href="goods_list.php?flag=h&cgx=sy"><div class="hsh_tit font_16"><span class="fl xpss_tit_icon"><img src="images/index_33.jpg" alt="" style="width:25px; height:19px;"></span><sapn class="fl">惠生活</sapn><div class="cl"></div></div>
			<div class="dztj_pic" style=" padding:2% 5% 4%"><img src="<?php echo GetFragment(12,2);?>" alt="" style="height:53px;"></div></a>
		</div>
		<div class="cl"></div>
	</div>
	
	<div><a href="<?php echo GetFragment(1,3);?>"><img src="<?php echo GetFragment(1,2);?>" alt=""></a></div>

	
</section>
<!--精品推荐
<section>
	<div class="dsj_tit" style="background:rgb(241,241,241)"><span class="fl dsj_tit_text font_16">精品推荐</span><a href="goods_list.php?flag=p&cgx=sy" class="fr" style="color:#000;">查看更多 ></a><div class="cl"></div></div>
	
	
	<ul class="jptj_list font_12" style="background:rgb(241,241,241);">
<?php 
$dosql->Execute("SELECT linkurl,typeid,id,picurl,title,salesprice,integral FROM `#@__goods` WHERE classid=1 AND flag like '%p%' AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC LIMIT 0,6");
while($row = $dosql->GetArray())
{       
 		if($row['linkurl'] == '') $gourl = 'goods_show.php?cid='.$row['typeid'].'&amp;id='.$row['id'];
        else $gourl = $row['linkurl'];
?>
		<li><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" height="150"><br><div style="padding:0 2%;"><span style="height:20px; display:block;"><?php echo mb_substr($row['title'],0,30,'utf-8');?></span><br><span class="fl">现价：<font class="jptj_red font_14">￥<?php echo $row['salesprice'];?></font></span> <span class="fr jptj_btn">购买</span></div><?php if($row['integral']!='0'){?><span class="jptj_jf tr">积 分</span><?php }?><div class="cl"></div></a></li>
<?php }?>		
		<div class="cl"></div>
	</ul>
	
	
    <div><a href="<?php echo GetFragment(2,3);?>"><img src="<?php echo GetFragment(2,2);?>" alt=""></a></div>
	
</section>
<!--精品推荐END-->
<!--商品分类-->
<!--<section>
	<div class="dsj_tit" style="background:rgb(241,241,241)"><span class="fl dsj_tit_text font_16">商品分类</span><div class="cl"></div></div>
	<ul class="spfl_list font_12" style="background:rgb(241,241,241);">
    <?php 
	$dosql->Execute("SELECT linkurl,id,classname,jieshao,picurl FROM `#@__goodstype` WHERE parentid='0' AND checkinfo=true ORDER BY orderid,id DESC");
	$i=1;
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == '') $gourl = 'goods_list.php?cid='.$row['id'].'&clsid='.$row['id'];
			else $gourl = $row['linkurl'];
	?>
		<li class="spfl_list_bg<?php echo $i;?>"><a href="<?php echo $gourl;?>">
        <span class="fl spfl_list_text">
        <font class="font_14 <?php if($i==5 || $i==6 || $i==7 || $i==9 || $i==10){?>red<?php }?>"><?php echo $row['classname'];?></font><br>		    	<font <?php if($i==5 || $i==6 || $i==7 || $i==9 || $i==10){?> class="grey_9" <?php }?>><?php echo $row['jieshao'];?></font></span>
        <span class="fr spfl_list_pic"><img src="<?php echo $row['picurl'];?>" width="87" height="70" alt=""></span><div class="cl"></div></a>
        </li>
	<?php $i++;}?>	
		<div class="cl"></div>
	</ul>
</section>-->
<!--商品分类END-->
<!--<section>
	<div class="dsj_tit" style="background:rgb(241,241,241)"><span class="fl dsj_tit_text font_16">便捷生活</span><div class="cl"></div></div>
	<ul class="bjsh_list">
    <?php 
	$dosql->Execute("SELECT linkurl,id,classname,jieshao,picurl FROM `#@__goodstype` WHERE parentid='76' ORDER BY orderid,id DESC limit 0,2");
	$i=1;
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == '') $gourl = 'goods_list.php?cid='.$row['id'].'&clsid='.$row['id'];
			else $gourl = $row['linkurl'];
	?>
		<li><a href="goods_list.php?cid=74&clsid=74"><span class="fl bjsh_list_name"><font class="red font_16"><?php echo $row['classname'];?></font><br><?php echo $row['jieshao'];?></span><span class="fr bjsh_list_pic"><img src="<?php echo $row['picurl'];?>" width="87" height="70" alt=""></span><div class="cl"></div></a></li>
    <?php $i++;}?>	    
		
		<div class="cl"></div>
	</ul>
		
</section>-->
<!--
<section>
	<div class="dsj_tit" style="background:rgb(241,241,241)"><span class="fl dsj_tit_text font_16">便捷生活</span><div class="cl"></div></div>
	<ul class="bjsh_list">
    <?php 
	$dosql->Execute("SELECT linkurl,id,classname,jieshao,picurl FROM `#@__goodstype` WHERE parentid='0' AND checkinfo=true ORDER BY orderid,id DESC limit 8");
	$i=1;
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == '') $gourl = 'goods_list.php?cid='.$row['id'].'&clsid='.$row['id'];
			else $gourl = $row['linkurl'];
	?>
		<li style=" border-bottom:5px solid #f1f1f1;"><a href="<?php echo $gourl;?>"><span class="fl bjsh_list_name"><font class="red font_16"><?php echo $row['classname'];?></font><br><?php echo $row['jieshao'];?></span><span class="fr bjsh_list_pic"><img src="<?php echo $row['picurl'];?>" width="87" height="70" alt=""></span><div class="cl"></div></a></li>
    <?php $i++;}?>	    
		
		<div class="cl"></div>
	</ul>
		
</section>
<!--
<section>
	<ul class="index_bot tc">
		<li style="width:40%; color:#c20000;"><?php echo GetFragment(3);?></li>
		<li><a href="index.php">店铺首页</a></li>	
		<li><a href="member.php?c=default">用户中心</a></li>	
		<li><a href="javascript:;" id="demo2a">关注我们</a></li>
		<div class="cl"></div>
	</ul>
</section>-->
<!--index end-->
<style>
.layui-layer-content img { width:200px; height:200px;}
</style>
<link style="" id="layui_layer_skinlayercss" href="style/layer.css" rel="stylesheet">
<script src="js/layer.js"></script> 
<script type="text/javascript">
        $('#demo2a').on('click', function(){
          layer.alert('<img src=<?php echo GetFragment(15,2);?> width=200>')
        });
</script>
<!--footer start-->
<?php require_once('footer.php');?>
<!--footer end-->



<script src="js/swiper-3.4.2.min.js"></script>

<!-- 头部滚动 -->
<script>
var swiper = new Swiper('.swiper-container', {
	pagination: '.swiper-pagination',
	nextButton: '.swiper-button-next',
	prevButton: '.swiper-button-prev',
	paginationClickable: true,
	spaceBetween: 30,
	centeredSlides: true,
	loop:true,
	autoplay: 2500,
	autoplayDisableOnInteraction: false
});
</script>
	
	
</body>
</html>
