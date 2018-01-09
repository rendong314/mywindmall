<?php 
	if(!isset($_COOKIE['username'])){
		$url = 'http://xwmtnongye.agamemnon.cn/https/oauth_msg.php';
		echo "<script> alert('暂无订单信息，前往商城下单。'); </script>"; 
		echo "<meta http-equiv='Refresh' content='0;URL=".$url."'>";
	}else{
		header('location:http://https.agamemnon.cn/member.php?c=default');
	}
	
?>