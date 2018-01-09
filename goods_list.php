<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 
$cid = empty($cid) ? 0 : intval($cid);
$clsid = empty($clsid) ? $cid : intval($clsid);
if($clsid=='' || $clsid=='0'){
	$clsid = $cid;
	}
$flag= isset($flag) ? $flag : '';
$sort= isset($sort) ? $sort : '';
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
	iTop = document.documentElement.scrollTop || document.body.scrollTop;
	iScrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
	iClientHeight = document.documentElement.clientHeight || document.body.clientHeight;
	if(iTop == iScrollHeight-iClientHeight) {
	var cl = $("#hql").attr("class");
    if(cl=='main_wddd zy'){
		page_ajax1()
		}else{
		page_ajax()
		}
	
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
			var flag='<?php echo $flag?>';
			var cgx='<?php echo $cgx?>';
			var cy = $('#cy').val();
			//alert(page)
				if(nodata!=="no"){
					$.post("goods_page_ajax.php",{tid:tid,paixu:paixu,flag:flag,cgx:cgx,products_num:num,cy:cy,products_page:page},function(data){
						if(data){
							if(data=="2"){
								alert("服务器错误，请稍后重试！");
								}else{
									if(data=="1"){
										$(".main_loading").html('亲，已经滑到底啦~去别的分类看看吧');
										//$("#gengduo_button").attr('nodata','no');
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
	
	function page_ajax1(){
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
			var flag='<?php echo $flag?>';
			var cgx='<?php echo $cgx?>';
			var cy= $('#cy').val();
				if(nodata!=="no"){
					$.post("goods_page_h_ajax.php",{tid:tid,paixu:paixu,flag:flag,cgx:cgx,products_num:num,cy:cy,products_page:page},function(data){
						
						if(data){
							if(data=="2"){
								alert("服务器错误，请稍后重试！");
								}else{
									if(data=="1"){
										$(".main_loading").html('亲，已经滑到底啦~去别的分类看看吧');
										//$("#gengduo_button").attr('nodata','no');
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
	<span class="fl main_top_meau tc" id="tubiao1" style="cursor:none;text-decoration:none;-webkit-tap-highlight-color:transparent;"><img src="images/a01.png" alt="" ><br>搜索</span>
	<span class="fl main_search_bor">
    <form name="search" id="search" method="get" action="search_list.php">
    <input type="image" src="images/index_06.jpg" class="fl search_btn ss_btn" id="search_btn">
    <input type="text" name="keyword" class="fl search_inp ss_bd" placeholder="商品搜索：请输入商品关键字" value="<?php if(isset($keyword)){echo $keyword;} ?>">
    </form> 
    <div class="cl"></div></span>
	<span class="fr main_top_meau tc lqb" style="cursor:none;text-decoration:none;-webkit-tap-highlight-color:transparent;"><img src="images/a02.png" alt="" id="liebiao"><br>列表</span>
    <input type="hidden"  class="syq" value="">
	<div class="cl"></div>   
<script>
$(".lqb").click(function(){
	var liebiao = $("#liebiao").attr("src");
	$("#liebiao").attr("src","images/glist_icon.png");
	$("#hql").attr("class","main_wddd zy");
	$(".kuai").hide();
	$(".heng").show();
	$(".syq").val(1);
	if(liebiao == 'images/glist_icon.png'){
		$("#liebiao").attr("src","images/a02.png");
		$("#hql").attr("class","main_pro_list font_12 zy");
		$(".kuai").show();
		$(".heng").hide();
		$(".syq").val(2);
		}
	})
</script>     
<!-- 导航菜单 --> 
<div id="ceng">
	<div id="close"><img src="images/close.png"/></div>
	<div class="type">
		<ul>
    <?php 
	$dosql->Execute("SELECT * FROM `#@__goodstype` WHERE parentid='$clsid' AND checkinfo=true ORDER BY orderid,id DESC");
	if($dosql->GetTotalRow() > 0){
	$i=1;
	while($row = $dosql->GetArray())
	{       
			if($row['linkurl'] == ''){ 
			$gourl = 'goods_list.php?cid='.$row['id'].'&clsid='.$clsid;
			}else{ 
			$gourl = $row['linkurl'];
			}
	?>
		<li><a href="<?php echo $gourl;?>"><?php echo $row['classname'];?></a></li>
	<?php $i++;}}else{
		$r = $dosql -> GetOne("SELECT * FROM `#@__goodstype` WHERE id='$clsid' ORDER BY orderid,id DESC");
		?>
    	<li><a href="goods_list.php?cid=<?php echo $cid?>"><?php echo $r['classname'];?></a></li>
    <?php }?>			
		</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#tubiao").bind("click",function (){
        $("#ceng").toggle(200);
        var height=$(window).height();
      $("#ceng").css(document.body.scrollHeight);
        })
        $("#close").bind("click",function (){
        $("#ceng").toggle(200);
        
        }) 
    });
$(document).ready(function() {
    var hei =  document.body.scrollHeight;
	//alert(hei);
	$('#ceng').css("min-height",hei);
});	
</script>

<!-- 导航菜单 -->
</section>
<section>
	<ul class="main_pro_type tc">
    <?php
    if($flag == ''){
	?>
		<li><a href="goods_list.php?cid=<?php echo $cid?>&clsid=<?php echo $clsid;?>&sort=zonghe&cgx=<?php echo $cgx;?>" <?php if($sort=='zonghe' || $sort == ''){?> class="red"<?php }?> id="zonghe">综合</a></li>
		<li><a href="goods_list.php?cid=<?php echo $cid?>&clsid=<?php echo $clsid;?>&sort=xiaoliang&cgx=<?php echo $cgx;?>" <?php if($sort=='xiaoliang'){?> class="red"<?php }?> id="xiaoliang">销量</a></li>
		<li><a href="goods_list.php?cid=<?php echo $cid?>&clsid=<?php echo $clsid;?>&sort=xinpin&cgx=<?php echo $cgx;?>" <?php if($sort=='xinpin'){?> class="red"<?php }?> id="xinpin">新品</a></li>
		<li id="xyz"><a href="javascript:;" onClick="pai(1)">价格<span class="main_pro_list_price01"><img src="images/a03.png" alt=""  class="shang"></span><span class="main_pro_list_price02"><img src="images/a04.png" alt="" class="xia"></span></a></li>
     <?php
	}else{
	 ?>   
        <li><a href="goods_list.php?sort=zonghe&clsid=<?php echo $clsid;?>&flag=<?php echo $flag?>&cgx=<?php echo $cgx;?>"  <?php if($sort=='zonghe' || $sort == ''){?> class="red"<?php }?> id="zonghe">综合</a></li>
		<li><a href="goods_list.php?sort=xiaoliang&clsid=<?php echo $clsid;?>&flag=<?php echo $flag?>&cgx=<?php echo $cgx;?>"  <?php if($sort=='xiaoliang'){?> class="red"<?php }?> id="xiaoliang">销量</a></li>
		<li><a href="goods_list.php?sort=xinpin&clsid=<?php echo $clsid;?>&flag=<?php echo $flag?>&cgx=<?php echo $cgx;?>"  <?php if($sort=='xinpin'){?> class="red"<?php }?> id="xinpin">新品</a></li>
	<!--	<li id="xyz"><a href="javascript:;" onClick="pai(1)">价格<span class="main_pro_list_price01"><img src="images/a03.png" alt="" class="shang"></span><span class="main_pro_list_price02"><img src="images/a04.png" alt="" class="xia"></span></a></li>-->
     <?php }?>
		<div class="cl"></div>
	</ul>
</section>
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
		$.post("Ajax_paixu.php",{id:id,cid:<?php echo $cid ?>,fangshi:fangshi,flag:'<?php echo $flag;?>'},function(data){
			$("#hql").html(data)
			});
	}else if(id==2){
		$("#cy").val(1);
		var fangshi = $(".syq").val();
		$("#xyz").html('<a href="javascript:;" onClick="pai(1)" class="red">价格<span class="main_pro_list_price01"><img src="images/a03.png" alt=""  class="shang"></span><span class="main_pro_list_price02"><img src="images/a04.png" alt="" class="xia"></span></a>')
		var page=$("#gengduo_button").attr('page','2');//第几个分页
		$(".shang").attr("src","images/a03.png");
		$(".xia").attr("src","images/a044.png");
		$.post("Ajax_paixu.php",{id:id,cid:<?php echo $cid ?>,fangshi:fangshi,flag:'<?php echo $flag;?>'},function(data){
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
<input type="hidden" name="cy" id="cy" value="">
<section style="background:#f1f1f1;">
<!--<ul class="main_wddd">-->
	<ul id="hql" class="main_pro_list font_12 zy">
<?php 
if($sort=='zonghe' and $sort==''){//综合排序
	$wheresql=" WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC limit 6";
	}elseif($sort=='xiaoliang'){//按销量排序
	$wheresql=" WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY monthsell DESC limit 6";
	}elseif($sort=='xinpin'){//按更新时间排序
	$wheresql=" WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY posttime DESC limit 6";
	}elseif($sort=='jiage'){//按价格时间排序
	$wheresql=" WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY salesprice DESC limit 6";
	}elseif($sort=='jiageshang'){//按价格时间排序
	$wheresql=" WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY salesprice ASC limit 6";
	}else{//默认排序
	$wheresql=" WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY orderid,id DESC limit 6";
	}
	
if($flag=='d' and $sort==''){//综合排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='d' and $sort=='zonghe'){//综合排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='d' and $sort=='xiaoliang'){//按销量排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY monthsell DESC limit 6";	
	}elseif($flag=='d' and $sort=='xinpin'){//按更新时间排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY posttime DESC limit 6";	
	}elseif($flag=='d' and $sort=='jiage'){//按价格时间排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY salesprice DESC limit 6";	
	}elseif($flag=='d' and $sort=='jiageshang'){//按价格时间排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY salesprice ASC limit 6";	
	}

if($flag=='p' and $sort==''){//综合排序精品推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='p' and $sort=='zonghe'){//综合排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='p' and $sort=='xiaoliang'){//按销量排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY monthsell DESC limit 6";	
	}elseif($flag=='p' and $sort=='xinpin'){//按更新时间排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY posttime DESC limit 6";	
	}elseif($flag=='p' and $sort=='jiage'){//按价格时间排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY salesprice DESC limit 6";	
	}elseif($flag=='p' and $sort=='jiageshang'){//按价格时间排序店长推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY salesprice ASC limit 6";	
	}
	
if($flag=='c' and $sort==''){
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='c' and $sort=='zonghe'){//综合排序热卖推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='c' and $sort=='xiaoliang'){//按销量排序热卖推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY monthsell DESC limit 6";	
	}elseif($flag=='c' and $sort=='xinpin'){//按更新时间排序热卖推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY posttime DESC limit 6";	
	}elseif($flag=='c' and $sort=='jiage'){//按价格时间排序热卖推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY salesprice DESC limit 6";	
	}elseif($flag=='c' and $sort=='jiageshang'){//按价格时间排序热卖推荐
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '%".$flag."%' ORDER BY salesprice ASC limit 6";	
	}
	
if($flag=='h' and $sort==''){
	$wheresql=" WHERE delstate='' AND checkinfo=true ORDER BY posttime DESC limit 6";
	}elseif($flag=='h' and $sort=='zonghe'){//综合排序新品上市
	$wheresql=" WHERE delstate='' AND checkinfo=true ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='h' and $sort=='xiaoliang'){//按销量排序新品上市
	$wheresql=" WHERE delstate='' AND checkinfo=true ORDER BY monthsell DESC limit 6";	
	}elseif($flag=='h' and $sort=='xinpin'){//按更新时间排序新品上市
	$wheresql=" WHERE delstate='' AND checkinfo=true ORDER BY posttime DESC limit 6";	
	}elseif($flag=='h' and $sort=='jiage'){//按价格时间排序新品上市
	$wheresql=" WHERE delstate='' AND checkinfo=true ORDER BY salesprice DESC limit 6";	
	}elseif($flag=='h' and $sort=='jiageshang'){//按价格时间排序新品上市
	$wheresql=" WHERE delstate='' AND checkinfo=true ORDER BY salesprice ASC limit 6";	
	}
	
if($flag=='z' and $sort==''){
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='z' and $sort=='zonghe'){//综合排序最新优惠
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY orderid,id DESC limit 6";
	}elseif($flag=='z' and $sort=='xiaoliang'){//按销量排序最新优惠
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY monthsell DESC limit 6";	
	}elseif($flag=='z' and $sort=='xinpin'){//按更新时间排序最新优惠
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY posttime DESC limit 6";	
	}elseif($flag=='z' and $sort=='jiage'){//按价格时间排序最新优惠
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY salesprice DESC limit 6";	
	}elseif($flag=='z' and $sort=='jiageshang'){//按价格时间排序最新优惠
	$wheresql=" WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY salesprice ASC limit 6";	
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
		<div style="height:40px;"><?php echo mb_substr($row['title'],0,30,'utf-8');?></div></a>
        <span class="fl"><font class="jptj_red font_14">￥<?php echo $row['salesprice'];?></font></span> <span class="fr main_pro_list_icon"><img src="images/a05.jpg" alt="" onClick="cart_list(<?php echo $row['id'];?>,<?php echo $row['typeid'];?>)"></span><!--<?php if($row['integral']!='0'){?><span class="jptj_jf tr">积 分</span><?php }?>--><div class="cl"></div></li>
        
		<li class="heng" style="display:none; background:#fff;">
			<span class="fl main_wddd_pic"><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" height="80"></span>
			<span class="fl main_wddd_con grey_9"><?php echo mb_substr($row['title'],0,30,'utf-8');?></span>
            <!-- <?php if($row['integral']!='0'){?><span class="jptj_jf tr" style="width:34px;">积 分</span><?php }?>-->
            </a>
			<span class="fr main_wddd_more tr"><font class="red">￥<?php echo $row['salesprice'];?></font><br><br><br><img src="images/a05.jpg" alt="" onClick="cart_list(<?php echo $row['id'];?>,<?php echo $row['typeid'];?>)" style="width:24px;"></span>
			<div class="cl"></div>
			<div class="gry_bg"></div>
		</li>

     
<?php $i++;}?>			
		<div class="cl"></div>
	</ul>
    <div class="cl"></div>
    <style>
	
	@-webkit-keyframes widget_gif{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}@-webkit-keyframes gif{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}
	.loading {
  	position:absolute;
    left:22%;
    top:0;
    z-index: 10;
    width: 24px;
    height: 24px;
    border-radius: 24px;
    -webkit-animation: widget_gif 1s infinite linear;
    background: url(images/loading.png) no-repeat;
    -webkit-background-size: 100%;
}
	</style>
    <?php if($paixu >= 4){?>
	<div class="main_loading pos"><!--<img src="images/a06.gif" style="width:20px; height:20px;">-->
    <span class="loading"></span>正在加载,请稍后</div>
    <?php }else if($paixu < 4){?>
    
    <?php }?>
    <input name="更多" type="button" id="gengduo_button" page="2" value="显示更多" style="display:none; ">
    <input name="更多" type="hidden" id="gengduo_button1" page="2" value="显示更多" style="display:none; ">
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
