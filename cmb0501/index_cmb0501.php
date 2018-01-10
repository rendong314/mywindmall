<?php 
require_once(dirname(__FILE__).'/../../include/config.inc.php');
$openid =$_GET['openid'];
$checkstr=$_GET['checkstr'];
if($checkstr!=substr(md5(md5($openid."314")),-21))
{
	echo "<script>alert('网络链接错误');</script>"; 
	exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-UA-Compatible" content="IE=edge" chrome="1">
    <!-- 如果支持Google Chrome Frame：GCF，则使用GCF渲染；如果系统安装ie8或以上版本，则使用最高版本ie渲染；-->
    <title>招商银行红包</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
	<script>
	//禁止分享
        function onBridgeReady() {
            WeixinJSBridge.call('hideOptionMenu');
        }
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
            }
        } else {
            onBridgeReady();
        }
    </script>
</head>

<body>
    <div class="content">
        <div class="head"><img src="img/zlogo.png"></div>
        <div class="main">
            <img src="img/p.png" class="p" style="margin-bottom:1rem">
           
            <div class="g">
                <p>活动时间：4月28日-5月31日 </p>
                <p>活动规则：凡在活动期间，开通长安通记名卡自动充值功能的客户即可领取微信红包1个。具体领奖密钥请咨询网点工作人员。 </p>
                <p>领取地点：招商银行西安分行各营业网点 </p>
                </p>
            </div>
            <form>
                <input text="text" value="" placeholder="请输入活动密令" maxlength="6" id="pp">
                <div class="btn" onclick="Checkinfo()">确&nbsp;&nbsp;定</div>
            </form>
        </div>
        <!--弹层-->
        <div class="dialog" id="myModal">
            <div class="weui_dialog_confirm" id="dialog1" style="display: none;">
                <div class="weui_mask"></div>
                <div class="weui_dialog">
                    <div class="weui_dialog_hd"><strong class="weui_dialog_title" id="bb">温馨提示</strong></div>
                    <div class="weui_dialog_bd " id="err">haha</div>
                    <div class="weui_dialog_ft" id="qur">
                        <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
                    </div>
                </div>
            </div>
        </div>
		
    </div>
    <script>
	
    $(document).ready(function() {

        $("#qur").click(function() {
            $("#dialog1").hide()
        });
		setTimeout("document.body.removeChild(dialog1)",2000)
    })

    function Checkinfo() {
		
        var mobile = $("#pp").val();
        if (mobile == "") {
            $('#err').html('请输入活动密令');
            $('#dialog1').show()
            return false;
        } else if (!mobile.match(/^\d{6}$/)) {
            $('#err').html('请输入正确的活动密令');
            $('#dialog1').show()
            return false;
        } else {
			$('#err').html('红包正在发送...请勿重复点击');
			$('#dialog1').show();
			$.ajax({
				url : "checksecret_cmb0501.php?secretsign="+mobile,
				type:'post',
				dataType:'json',
				data:{openid:"<?php echo $openid;?>",checkstr:"<?php echo $checkstr;?>"},
				async: true,
				success:function(data){
					if(data==1){ 
						$('#err').html('红包发送成功');
						$('#dialog1').show()
						return false;
					}else if(data==2){
						$('#err').html('红包发送失败');
						$('#dialog1').show()
						return false;
					}else if(data==4){
						$('#err').html('红包密钥错误');
						$('#dialog1').show()
						return false;
					}else if(data==3){
						$('#err').html('每个微信号只能领取一次');
						$('#dialog1').show()
						return false;
					}else if(data==5){
						$('#err').html('网络错误');
						$('#dialog1').show()
						return false;
					}
					}
				});

		
        }
    }
    </script>
</body>

</html>
