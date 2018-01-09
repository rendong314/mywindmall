<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
$id = isset($id) ? $id : '';
$cid = isset($cid) ? $cid : '';
$fangshi = isset($fangshi) ? $fangshi : '';
$flag = isset($flag) ? $flag : '';
$keyword = isset($keyword) ? $keyword : '';
if($id == '1'){
	if(!empty($keyword)){
		$dosql->Execute("SELECT * FROM `#@__goods`  WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY salesprice DESC limit 6");
		}else if(empty($cid)){
			$dosql->Execute("SELECT * FROM `#@__goods`  WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY salesprice DESC limit 6");
			}else{
		$dosql->Execute("SELECT * FROM `#@__goods`  WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY salesprice DESC limit 6");	
		}
	}else if($id == '2'){
			if(!empty($keyword)){
			$dosql->Execute("SELECT * FROM `#@__goods`  WHERE title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY salesprice ASC limit 6");	
			}else if(empty($cid)){
			$dosql->Execute("SELECT * FROM `#@__goods`  WHERE delstate='' AND checkinfo=true AND flag like '".$flag."' ORDER BY salesprice ASC limit 6");
			}else{
			$dosql->Execute("SELECT * FROM `#@__goods`  WHERE (typeid=$cid or typepid=$cid) AND delstate='' AND checkinfo=true ORDER BY salesprice ASC limit 6");
			}
		}
$i=1;
while($row = $dosql->GetArray())
{       
 		if($row['linkurl'] == '') $gourl = 'goods_show.php?cid='.$row['typeid'].'&amp;id='.$row['id'];
        else $gourl = $row['linkurl'];
?>
<?php
        if($fangshi=='1'){
		?>

<li class="heng" style="background:#fff;"> <span class="fl main_wddd_pic"><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" height="80"></span> <span class="fl main_wddd_con grey_9"><?php echo mb_substr($row['title'],0,30,'utf-8');?></span><?php if($row['integral']!='0'){?><span class="jptj_jf tr" style="width:34px;">积 分</span><?php }?></a> <span class="fr main_wddd_more tr"><font class="red">￥<?php echo $row['salesprice'];?></font><br>
  <br>
  <br>
  <img src="images/a05.jpg" alt="" style="width:25px; height:25px;" onClick="cart_list(<?php echo $row['id'];?>,<?php echo $row['typeid'];?>)"></span>
  <div class="cl"></div>
  <div class="gry_bg"></div>
</li>
<?php
		}else{
		?>
<li class="kuai"><a href="<?php echo $gourl;?>"><img src="<?php echo $row['picurl'];?>" alt="" height="150">
  <div style="height:40px;"><?php echo mb_substr($row['title'],0,30,'utf-8');?></div>
  </a> <span class="fl"><font class="jptj_red font_14">￥<?php echo $row['salesprice'];?></font></span> <span class="fr main_pro_list_icon"><img src="images/a05.jpg" alt="" style="width:25px; height:25px;" onClick="cart_list(<?php echo $row['id'];?>,<?php echo $row['typeid'];?>)"></span>
  <?php if($row['integral']!='0'){?><span class="jptj_jf tr">积 分</span><?php }?><div class="cl"></div>
</li>
<?php }$i++;}?>
