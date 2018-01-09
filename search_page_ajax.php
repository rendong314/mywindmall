<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$products_num = isset($_POST['products_num'])?$_POST['products_num']:0;//获取新闻个数
$products_page = isset($_POST['products_page'])?$_POST['products_page']:0;//获取新闻第几个分页
$tid = isset($_POST['tid'])?$_POST['tid']:"";//获取新闻所属分类
$paixu = isset($_POST['paixu'])?$_POST['paixu']:"";//获取新闻所属分类
$keyword = isset($_POST['keyword'])?$_POST['keyword']:"";//获取新闻所属分类
$pagesize = $products_num;//新闻个数
$page = $products_page;//新闻第几个分页
if($tid=="0"){
		$tid='';
		}
if($tid=="")
	{
        $sql_num = "select * from `#@__goods` where checkinfo='true' AND delstate = '' ";
	}else{
		$sql_num = "select * from `#@__goods` where checkinfo='true' AND (typeid=$tid or typepid=$tid) AND delstate = '' ";	
	}
$dosql->Execute($sql_num);
$total_num = $dosql->GetTotalRow();
$total_page = ceil($total_num/$pagesize);
$page = ($page<1)?1:$page;
if($page>$total_page){
	echo 1;
	exit;
}
$page = ($page>$total_page)?$total_page:$page;
$fromrow = ($page-1)*$pagesize;

$sql = "select * from `#@__goods` where checkinfo='true' AND delstate='' AND title LIKE '%$keyword%' ";
if($tid!="")
	{
	$sql.=" AND (typeid=$tid or typepid=$tid) ";
	}
if($paixu=='zonghe'){//综合排序
	$sql = $sql." order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($paixu=='xiaoliang'){//按销量排序
	$sql = $sql." order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($paixu=='xinpin'){//按更新时间排序
	$sql = $sql." order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($paixu=='jiage'){//按价格时间排序
	$sql = $sql." order by salesprice desc limit {$fromrow},{$pagesize}";	
	}else{//默认排序
	$sql = $sql." order by orderid,id desc limit {$fromrow},{$pagesize}";	
	}
	
$dosql->Execute($sql,1);
$rs = $dosql->GetTotalRow(1);

	while($rows = $dosql->GetArray(1))
        {
		?>
     <?php
     if($bianxing == '1'){
	 ?>  
     <li>
			<span class="fl main_wddd_pic"><a href="goods_show.php?id=<?php echo $rows['id'];?>&cid=<?php echo $rows["typeid"]?>"><img src="<?php echo $rows['picurl'];?>" alt="" height="80"></span>
			<span class="fl main_wddd_con grey_9"><?php echo mb_substr($rows['title'],0,30,'utf-8');?></span>
            <?php if($row['integral']!='0'){?><span class="jptj_jf tr" style="width:34px;">积 分</span><?php }?>
            </a>
			<span class="fr main_wddd_more tr"><font class="red">￥<?php echo $rows['salesprice'];?></font><br><img src="images/a05.png" alt="" style="width:25px; height:25px;" onClick="cart_list(<?php echo $rows['id'];?>,<?php echo $rows['typeid'];?>)"></span>
			<div class="cl"></div>
			<div class="gry_bg"></div>
		</li>
     <?php
	 }else{
	 ?>
    <li><a href="goods_show.php?id=<?php echo $rows['id'];?>&cid=<?php echo $rows["typeid"]?>"><img src="<?php echo $rows['picurl'];?>" alt="" height="150">
		<div style="height:40px;"><?php echo mb_substr($rows['title'],0,30,'utf-8');?></div>
        <span class="fl"><font class="jptj_red font_14">￥<?php echo $rows['salesprice'];?></font></span> <span class="fr main_pro_list_icon"><img src="images/a05.png" alt=""></span><?php if($row['integral']!='0'){?><span class="jptj_jf tr">积 分</span><?php }?><div class="cl"></div></a></li>
		<?php
	  }
	}



?>