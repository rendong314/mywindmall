<?php
require_once(dirname(__FILE__).'/include/config.inc.php'); 
$id = empty($id) ? 0 : intval($id);
$r = $dosql -> GetOne("select * from `#@__goods` where id=".$id."");
if($r){
	
	
?>
<div class="cart_fixed_bg1">
<div class="cart_fixed1">
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
	 $dosql->Execute("select * from `#@__goodsattr` where goodsid=".$r['typeid']."",1);
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
      
    </li><input type="hidden" id="count<?php echo $ii; ?>" value="">
    
    <?php
			$ii++;}
				
	 ?>
<script type="text/javascript">
    function kj(typeid,goodsid)
    {
        var count='';
        <?php
        $dosql->Execute("select id,attrname from `#@__goodsattr` where goodsid=".$r['typeid']."");
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
					if(attrid =='')
					{
						window.location.href='orderinfobuy.php?count='+count+'&goodsid='+goodsid+'&my=my'
					}else
					{
						window.location.href='orderinfobuy.php?count='+count+'&attrid='+attrid+'&goodsid='+goodsid+'&my=my'
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
				alert(data);
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
			if(data == 1){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
			else if(data == 2){
				$(".xianshi").text("请先登录！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}	
			else if(data == 3){
				$(".xianshi").text("请选择商品属性！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
			else if(data == 4){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}
			else if(data == 5){
				$(".xianshi").text("库存不足！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}	
			else if(data == 6){
				$(".xianshi").text("成功加入购物车！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				ShoppingCar2(attrid,goodsid,count);
				return false;
				}
			else if(data == 7){
				$(".xianshi").text("加入失败！").show(300);
			 	setTimeout(function () {
				$(".xianshi").hide(300);
				}, 2000);
				return false;
				}	
			else
				{
					alert(data);
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
<?php
}else{
	echo "2";
	}
?>
<script type="text/javascript">
function cart_close()
{
	$(".cart_fixed_bg1").hide();
	$("#shuliang").text($("#qty_item_1").val());
	return false;
}
</script>