<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$products_num = isset($_POST['products_num'])?$_POST['products_num']:0;//获取新闻个数
$products_page = isset($_POST['products_page'])?$_POST['products_page']:0;//获取新闻第几个分页
$tid = isset($_POST['tid'])?$_POST['tid']:"";//获取新闻所属分类
$paixu = isset($_POST['paixu'])?$_POST['paixu']:"";//获取新闻所属分类
$flag = isset($_POST['flag'])?$_POST['flag']:"";//获取新闻所属分类
$bianxing = isset($_POST['bianxing'])?$_POST['bianxing']:"";//获取新闻所属分类
$cy = isset($_POST['cy'])?$_POST['cy']:"";//获取新闻所属分类
$cgx = isset($_POST['cgx'])?$_POST['cgx']:"";//获取新闻所属分
$pagesize = $products_num;//新闻个数
$page = $products_page;//新闻第几个分页
if($tid=="" || $tid=="0")
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

$sql = "select * from `#@__goods` where checkinfo='true' AND delstate = '' ";
if($tid!="" and $tid!="0")
	{
	$sql.=" AND (typeid=$tid or typepid=$tid) ";
	}
if(!empty($cy)){	
if($cy == '1'){
	if(!empty($flag)){
		$sql = $sql." AND flag like '%".$flag."%' order by salesprice ASC limit {$fromrow},{$pagesize}";
		}else{
		$sql = $sql." order by salesprice ASC limit {$fromrow},{$pagesize}";	
		}
	}else if($cy == '2'){
		if(!empty($flag)){
		$sql = $sql." AND flag like '%".$flag."%' order by salesprice DESC limit {$fromrow},{$pagesize}";
		}else{
		$sql = $sql." order by salesprice DESC limit {$fromrow},{$pagesize}";	
		}
	}	
}else{
if($paixu=='zonghe' and $flag==''){//综合排序
	$sql = $sql." order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($paixu=='xiaoliang' and $flag==''){//按销量排序
	$sql = $sql." order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($paixu=='xinpin' and $flag==''){//按更新时间排序
	$sql = $sql." order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($paixu=='jiage' and $flag==''){//按价格时间排序
	$sql = $sql." order by salesprice desc limit {$fromrow},{$pagesize}";	
	}elseif($paixu=='jiageshang' and $flag==''){//按价格时间排序
	$sql = $sql." order by salesprice asc limit {$fromrow},{$pagesize}";	
	}else if($cgx!='sy'){//默认排序
	$sql = $sql." order by orderid,id desc limit {$fromrow},{$pagesize}";	
	}
	
if($flag=='d' and $paixu==''){
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='d' and $paixu=='zonghe'){//综合排序
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='d' and $paixu=='xiaoliang'){//按销量排序
	$sql = $sql." AND flag like '%".$flag."%' order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='d' and $paixu=='xinpin'){//按更新时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='d' and $paixu=='jiage'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='d' and $paixu=='jiageshang'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice asc limit {$fromrow},{$pagesize}";	
	}

if($flag=='p' and $paixu==''){
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='p' and $paixu=='zonghe'){//综合排序
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='p' and $paixu=='xiaoliang'){//按销量排序
	$sql = $sql." AND flag like '%".$flag."%' order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='p' and $paixu=='xinpin'){//按更新时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='p' and $paixu=='jiage'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='p' and $paixu=='jiageshang'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice asc limit {$fromrow},{$pagesize}";	
	}
	
if($flag=='c' and $paixu==''){
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='c' and $paixu=='zonghe'){//综合排序
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='c' and $paixu=='xiaoliang'){//按销量排序
	$sql = $sql." AND flag like '%".$flag."%' order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='c' and $paixu=='xinpin'){//按更新时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='c' and $paixu=='jiage'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='c' and $paixu=='jiageshang'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice asc limit {$fromrow},{$pagesize}";	
	}	
	
if($flag=='h' and $paixu==''){
	$sql = $sql." order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='h' and $paixu=='zonghe'){//综合排序
	$sql = $sql." order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='h' and $paixu=='xiaoliang'){//按销量排序
	$sql = $sql." order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='h' and $paixu=='xinpin'){//按更新时间排序
	$sql = $sql." order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='h' and $paixu=='jiage'){//按价格时间排序
	$sql = $sql." order by salesprice desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='h' and $paixu=='jiageshang'){//按价格时间排序
	$sql = $sql." order by salesprice asc limit {$fromrow},{$pagesize}";	
	}	
	
if($flag=='z' and $paixu==''){
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='z' and $paixu=='zonghe'){//综合排序
	$sql = $sql." AND flag like '%".$flag."%' order by orderid,id desc limit {$fromrow},{$pagesize}";
	}elseif($flag=='z' and $paixu=='xiaoliang'){//按销量排序
	$sql = $sql." AND flag like '%".$flag."%' order by monthsell desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='z' and $paixu=='xinpin'){//按更新时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by posttime desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='z' and $paixu=='jiage'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice desc limit {$fromrow},{$pagesize}";	
	}elseif($flag=='z' and $paixu=='jiageshang'){//按价格时间排序
	$sql = $sql." AND flag like '%".$flag."%' order by salesprice asc limit {$fromrow},{$pagesize}";	
	}
}
$dosql->Execute($sql,1);
$rs = $dosql->GetTotalRow(1);
if($rs!=0){
	while($rows = $dosql->GetArray(1))
        {
		?>

     <li style="background:#fff;">
			<span class="fl main_wddd_pic"><a href="goods_show.php?id=<?php echo $rows['id'];?>&cid=<?php echo $rows["typeid"]?>"><img src="<?php echo $rows['picurl'];?>" alt="" height="80"></span>
			<span class="fl main_wddd_con grey_9"><?php echo mb_substr($rows['title'],0,30,'utf-8');?></span>
            <?php if($row['integral']!='0'){?><span class="jptj_jf tr" style="width:34px;">积 分</span><?php }?>
            </a>
			<span class="fr main_wddd_more tr"><font class="red">￥<?php echo $rows['salesprice'];?></font><br><br><br><img src="images/a05.jpg" alt="" style="width:24px; height:24px;" onClick="cart_list(<?php echo $rows['id'];?>,<?php echo $rows['typeid'];?>)"></span>
			<div class="cl"></div>
			<div class="gry_bg"></div>
		</li>
     <?php

	}
}
else{
	echo 1;
}



?>