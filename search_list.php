<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$cid = empty($cid) ? 0 : intval($cid);
$flag= isset($flag) ? $flag : '';
$sort= isset($sort) ? $sort : '';
$keyword = isset($keyword) ? $keyword : '';
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
<script type="text/javascript" src="js/item_show.js"></script>
<?php echo GetHeader();?>
</head>
<script>
window.onscroll=function(){
	var iTop = document.documentElement.scrollTop || document.body.scrollTop;
	var iScrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
	var iClientHeight = document.documentElement.clientHeight || document.body.clientHeight;
	if(iTop == iScrollHeight-iClientHeight) {
	page_ajax()
	}
}
function page_ajax(){
			var num=6;//显示个数
			var page=$("#gengduo_button").attr('page');//第几个分页
			var nodata=$("#gengduo_button").attr('nodata');//判断是否有数据
			if(page){
				page=parseInt(page);
				}else{
					page=1;
					}
			var tid='<?php echo $cid?>';//新闻所属分类
			var paixu='<?php echo $sort?>';	
			var keyword='<?php echo $keyword?>';
				if(nodata!=="no"){
					$.post("search_page_ajax.php",{tid:tid,paixu:paixu,keyword:keyword,products_num:num,products_page:page},function(data){
						if(data){
							if(data=="2"){
								$(".xianshi").text("服务器错误，请稍后重试！").show(300);
								setTimeout(function () {
								$(".xianshi").hide(300);
								}, 2000);
								//alert("服务器错误，请稍后重试！");
								}else{
									if(data=="1"){
										$(".main_loading").html('亲，已经滑到底啦~去别的分类看看吧');
										$("#gengduo_button").attr('nodata','no');
										}else{
											$(".zy").append(data);
											page=page+1;
											$("#gengduo_button").attr('page',page);
											}
									}
							}else{
								$(".main_loading").html('亲，已经滑到底啦~去别的分类看看吧');
								}
						})
						}else{
							$(".main_loading").html('亲，已经滑到底啦~去别的分类看看吧');
							}
				
	}	
</script>
<body style="max-width:640px;margin:0 auto;">
<!--main start--> 
<section class="main_top">
	<span class="fl main_top_meau tc" id="tubiao" style="-webkit-tap-highlight-color:transparent;"><img src="images/a01.png" alt="" ><br>分类</span>
	<span class="fl main_search_bor">
    <form name="search" id="search" method="get" action="search_list.php">
<input type="image" src="images/index_06.jpg" class="fl search_btn ss_btn" id="search_btn">
<input type="text" name="keyword" class="fl search_inp ss_bd" placeholder="商品搜索：请输入商品关键字" value="<?php if(isset($keyword)){echo $keyword;} ?>">
</form>  
    
    <div class="cl"></div></span>
	<span class="fr main_top_meau tc lqb" style="-webkit-tap-highlight-color:transparent;"><img src="images/a02.png" alt="" id="liebiao"><br>列表</span>
    <input type="hidden"  class="syq" value="">
	<div class="cl"></div>   
<script>
$(".lqb").click(function(){
	var liebiao = $("#liebiao").attr("src");
	$("#liebiao").attr("src","images/glist_icon.png");
	$("#hql").attr("class","main_wddd zy");
	$(".kuai").hide();
	$(".heng").show()
	if(liebiao == 'images/glist_icon.png'){
		$("#liebiao").attr("src","images/a02.png");
		$("#hql").attr("class","main_pro_list font_12 zy");
		$(".kuai").show();
		$(".heng").hide()
		}
	})
</script>     
<!-- 导航菜单 --> 
<div id="ceng">
	<div id="close"><img src="images/close.png"/></div>
	<div class="type">
		<ul>
    <?php 
	$dosql->Execute("SELECT * FROM `#@__goodstype` WHERE parentid='$cid' AND checkinfo=true ORDER BY orderid,id DESC");
	if($dosql->GetTotalRow() > 0){
	$i=1;
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == '') $gourl = 'goods_list.php?cid='.$row['id'];
			else $gourl = $row['linkurl'];
	?>
		<li><a href="<?php echo $gourl;?>"><?php echo $row['classname'];?></a></li>
	<?php $i++;}}else{
		$r = $dosql -> GetOne("SELECT * FROM `#@__goodstype` WHERE id='$cid' AND checkinfo=true ORDER BY orderid,id DESC");
		?>
    	<li><a href="goods_list.php?cid=<?php echo $cid?>"><?php echo $r['classname'];?></a></li>
    <?php }?>			
		</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
$("#tubiao").bind("click",function (){
$("#ceng").toggle(500);
var height=$(window).height();
$("#ceng").css(document.body.scrollHeight);
})
$("#close").bind("click",function (){
$("#ceng").toggle(500);

})

});
</script>

<!-- 导航菜单 -->
</section>
<section>
	<ul class="main_pro_type tc">
   
        <li><a href="search_list.php?sort=zonghe&keyword=<?php echo $keyword?>" <?php if($sort=='zonghe' || $sort == ''){?> class="red"<?php }?>>综合</a></li>
		<li><a href="search_list.php?sort=xiaoliang&keyword=<?php echo $keyword?>" <?php if($sort=='xiaoliang'){?> class="red"<?php }?>>销量</a></li>
		<li><a href="search_list.php?sort=xinpin&keyword=<?php echo $keyword?>" <?php if($sort=='xinpin'){?> class="red"<?php }?>>新品</a></li>
		<li id="xyz"><a href="javascript:;" onClick="pai(1)">价格<span class="main_pro_list_price01"><img src="images/a03.png" alt="" class="shang"></span><span class="main_pro_list_price02"><img src="images/a04.png" alt="" class="xia"></span></a></li>
		<div class="cl"></div>
	</ul>
<script>
function pai(id){
	if(id==1){
		$("#cy").val(2);
		var fangshi = $(".syq").val();
		$("#zonghe").css("color","#000");
		$("#xiaoliang").css("color","#000");
		$("#xinpin").css("color","#000");
		$("#xyz").html('<a href="javascript:;" onClick="pai(2)" class="red">价格<span class="main_pro_list_price01"><img src="images/a03.png" alt=""  class="shang"></span><span class="main_pro_list_price02"><img src="images/a04.png" alt="" class="xia"></span></a>')
		var page=$("#gengduo_button").attr('page','2');//第几个分页	
		$(".shang").attr("src","images/a033.png");
		$(".xia").attr("src","images/a04.png");
		$.post("Ajax_paixu.php",{id:id,cid:<?php echo $cid ?>,fangshi:fangshi,keyword:'<?php echo $keyword?>'},function(data){
			$("#hql").html(data)
			});
	}else if(id==2){
		$("#cy").val(1);
		var fangshi = $(".syq").val();
		$("#xyz").html('<a href="javascript:;" onClick="pai(1)" class="red">价格<span class="main_pro_list_price01"><img src="images/a03.png" alt=""  class="shang"></span><span class="main_pro_list_price02"><img src="images/a04.png" alt="" class="xia"></span></a>')
		var page=$("#gengduo_button").attr('page','2');//第几个分页
		$(".shang").attr("src","images/a03.png");
		$(".xia").attr("src","images/a044.png");
		$.post("Ajax_paixu.php",{id:id,cid:<?php echo $cid ?>,fangshi:fangshi,keyword:'<?php echo $keyword?>'},function(data){
			$("#hql").html(data)
			});
		}
} 
/*$(".jiage").click(function(){
	var jiage = $(".jiage").attr("href");
	var shang = $(".shang").attr("src");
	//alert(shang)
	if(jiage == 'goods_list.php?cid=<?php echo $cid?>&sort=jiage'){
		$(".jiage").attr("href","goods_list.php?cid=<?php echo $cid?>&sort=jiageshang")
		}else{
		$(".jiage").attr("href","goods_list.php?cid=<?php echo $cid?>&sort=jiage")
		}
	})
*/</script>

</section>
<input type="hidden" name="cy" id="cy" value="">
<section style="background:#f1f1f1;">
<!--<ul class="main_wddd">-->
	<ul id="hql" class="main_pro_list font_12 zy">
<?php 
$keyword = htmlspecialchars($keyword);


if($sort=='zonghe'){//综合排序
	$wheresql=" WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC limit 6";
	}elseif($sort=='xiaoliang'){//按销量排序
	$wheresql=" WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY monthsell DESC limit 6";
	}elseif($sort=='xinpin'){//按更新时间排序
	$wheresql=" WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY posttime DESC limit 6";
	}elseif($sort=='jiage'){//按价格时间排序
	$wheresql=" WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY salesprice DESC limit 6";
	}else{//默认排序
	$wheresql=" WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC limit 6";
	}
					
				
				
$dosql->Execute("SELECT * FROM `#@__goods` ".$wheresql);
$i=1;
while($row = $dosql->GetArray())
{      
	    $paixu += $i;
 		if($row['linkurl'] == '') $gourl = 'goods_show.php?cid='.$row['typeid'].'&amp;id='.$row['id'];
        else $gourl = $row['linkurl'];
?>
		<li class="kuai"><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" height="150">
		<div style="height:40px;"><?php echo mb_substr($row['title'],0,30,'utf-8');?></div>
        <span class="fl"><font class="jptj_red font_14">￥<?php echo $row['salesprice'];?></font></span> <span class="fr main_pro_list_icon"><img src="images/a05.png" alt="" style="width:25px; height:25px;"></span><?php if($row['integral']!='0'){?><span class="jptj_jf tr">积 分</span><?php }?><div class="cl"></div></a></li>
        
		<li class="heng" style="display:none">
			<span class="fl main_wddd_pic"><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" height="80"></span>
			<span class="fl main_wddd_con grey_9"><?php echo mb_substr($row['title'],0,30,'utf-8');?></span>
            <?php if($row['integral']!='0'){?><span class="jptj_jf tr" style="width:34px;">积 分</span><?php }?>
            </a>
			<span class="fr main_wddd_more tr"><font class="red">￥<?php echo $row['salesprice'];?></font><br><img src="images/a05.png" alt="" style="width:25px; height:25px;" onClick="cart_list(<?php echo $row['id'];?>,<?php echo $row['typeid'];?>)"></span>
			<div class="cl"></div>
			<div class="gry_bg"></div>
		</li>

     
<?php $i++;}?>			
		<div class="cl"></div>
	</ul>
    <div class="cl"></div>
	<?php if($paixu >= 4){?>
	<div class="main_loading pos"><!--<img src="images/a06.gif" style="width:20px; height:20px;">-->
    <span class="loading"></span>正在加载,请稍后</div>
    <?php }else if($paixu < 4){?>
    
    <?php }?>
    <input name="更多" type="button" id="gengduo_button" page="2" value="显示更多" style="display:none; ">
<div style="height:10px;"></div>  
</section>
<!--main end--> 
<div class="xyz"></div>
<!--footer start-->
<?php require_once('footer.php');?>
<!--footer end-->
<!--加入购车弹出 start-->

<script type="text/javascript">
function cart_list(id,typeid)
{
	$.post("goodslist_car.php",{id:id,typeid:typeid},function(data){
		if(data==2){
			$(".xianshi").text("添加购物车失败！").show(300);
							setTimeout(function () {
							$(".xianshi").hide(300);
							}, 2000);
			return false;				
			}else{
			$(".xyz").html(data);
			}
		});
}
</script> 

<!--加入购车弹出 start-->

 
<div class="xianshi" style="position:fixed; top:50%; left:25%; background:rgba(0,0,0,.5); width:50%; padding:0.5% 2%; height:30px;line-height:30px;margin-top:-15px;border-radius:3px;color:#fff;z-index:9999;text-align:center; display:none"></div>
</body>
</html>
