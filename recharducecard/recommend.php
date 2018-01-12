
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?92eff9fd8ab6b7e7e49e8c3c19c9737b";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
</script>

<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">

var imgUrl = "http://boccdn.superwx.cn/nx20180103_commend/img/share.png";
var lineLink = "http://www.nx-boc.cn/NingXiaBoc/wxpage/nx20180103_commend/index.php";
var descContent = "玩转手机银行，轻松赢得推荐大礼，推荐有你，好礼我相送！";
var shareTitle = "@所有人，奖品已备好！还不点进来看看？";

//微信分享
wx.config({
    appId: 'wxd9c8e6f70ac199ac',
    timestamp: 1515638208,
    nonceStr: 'Rkq2hhYaxztGnD6n',
    signature: 'b7f1bc0698c6e5aae5530845fdd2cf1b550e94f8',
    debug: false,
    jsApiList: ["onMenuShareTimeline","onMenuShareAppMessage","onMenuShareQQ","onMenuShareWeibo","chooseImage","uploadImage","hideMenuItems","closeWindow"] // 所有要调用的 API 都要加到这个列表中
});

wx.ready(function() {

    // 在这里调用 API
    wx.hideMenuItems({
        menuList: ['menuItem:copyUrl', 'menuItem:favorite', 'menuItem:originPage', 'menuItem:openWithQQBrowser', 'menuItem:openWithSafari', 'menuItem:share:email', 'menuItem:share:qq', 'menuItem:share:weiboApp', 'menuItem:share:QZone', 'menuItem:share:timeline'] //  要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3,'menuItem:share:appMessage'
    });

    wx.onMenuShareTimeline({ //分享到朋友圈
        title: shareTitle, // 分享标题
        link: lineLink, // 分享链接
        imgUrl: imgUrl, // 分享图标
        success: function() {

        },
        cancel: function() {

        }
    });

    wx.onMenuShareAppMessage({ //分享给朋友
        title: shareTitle, // 分享标题
        desc: descContent, // 分享描述
        link: lineLink, // 分享链接
        imgUrl: imgUrl, // 分享图标
        type: "", // 分享类型,music、video或link，不填默认为link
        dataUrl: "", // 如果type是music或video，则要提供数据链接，默认为空
        success: function() {

        },
        cancel: function() {

        }
    });

});
</script>
<!DOCTYPE html5>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <!-- 浏览器中页面将以原始大小显示，并不允许缩放 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- 网站开启对web app程序的支持 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>推荐好友开通手机银行</title>
    <link rel="stylesheet" href="http://rncdn.superwx.cn/nx20180103_commend/css/public.css">
    <link rel="stylesheet" href="http://rncdn.superwx.cn/nx20180103_commend/css/style.css?v=20180103">
    <style>
    .weui_dialog button:first-of-type {
        margin-top: -1rem;
    }

    .weui_dialog button:last-of-type {
        margin-top: -0.2rem;
    }

    .w_img {
        position: absolute;
        width: 100%;
    }

    .footer1 {

        width: 100%;
        margin-top: 1rem;
        text-align: center;
        position: relative;
        z-index: 999;
    }

    .footer1 p {
        margin: -0.8rem 0 0.2rem 0;
        width: 50%;
        text-align: center;
        margin-left: 25%;
        color: #ff90a1;
        font-size: 0.75rem;
    }

    .clear {
        clear: both;
    }

    .col-5 input {
        font-size: 1rem;
    }
    .weui_dialog  button {position: relative;z-index: 999;}

    </style>
</head>

<body>
    <div class="content">
        <div class="head"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/logo.png" alt="中国银行宁夏回族自治区分行"></div>
        <div class="banner" style="position: absolute;">
            <div class="w_img"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/banner3.png" alt="" class="banner1"></div>
            <div class="zs"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/gg.png" alt="">
                <img src="http://rncdn.superwx.cn/nx20180103_commend/img/ll.png" alt="">
                <img src="http://rncdn.superwx.cn/nx20180103_commend/img/hh.png" alt="" class="hh">
            </div>
        </div>
        <div class="jilu" style=" margin-top: 30%;">
            <img src="http://rncdn.superwx.cn/nx20180103_commend/img/news.png" alt="填写被推荐人信息" style="width: 12rem;">
        </div>
        <div class="middle" style="margin-left: 5%;width: 90%;position: relative;z-index: 999;">
            <div class="col-5">
                <input type="tel" placeholder="请输入手机号码" maxlength="11" class="mobile" id="mobile1">
            </div>
            <div class="col-5">
                <input type="tel" placeholder="请输入手机号码" maxlength="11" class="mobile" id="mobile2">
            </div>
            <div class="col-5">
                <input type="tel" placeholder="请输入手机号码" maxlength="11" class="mobile" id="mobile3">
            </div>
            <div class="col-5">
                <input type="tel" placeholder="请输入手机号码" maxlength="11" class="mobile" id="mobile4">
            </div>
            <div class="col-5">
                <input type="tel" placeholder="请输入手机号码" maxlength="11" class="mobile" id="mobile5">
            </div>
            <div class="col-5">
                <input type="tel" placeholder="请输入手机号码" maxlength="11" class="mobile" id="mobile6">
            </div>
            <div class="clear"></div>
        </div>
        <div class=" footer1">
            <button id="subut">确认提交</button>
            <p>注：被推荐人成功开通手机银行 后，推荐人即可获得奖励。
            </p>
        </div>
        <div class="gule"><a href="rule.php"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/gule.png" alt="活动规则"></a></div>
    </div>
    <div class="dialog" id="myModal">
        <div class="weui_dialog_confirm" id="dialog1"  style="display: none;">
            <div class="weui_mask"></div>
            <div class="weui_dialog" id="qur" style="padding: 0 0 0 0;">
                <div class="zs"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/gg.png" alt="">
                    <img src="http://rncdn.superwx.cn/nx20180103_commend/img/ll.png" alt="">
                    <img src="http://rncdn.superwx.cn/nx20180103_commend/img/hh.png" alt="" class="hh">
                </div>
                <div class="weui_dialog_bd " id="err">
                    <div class="weui-title">
                        <!-- <p>很抱歉！</p> <p>您填写的手机号：*********** </p><p>已被他人推荐，</p> <p>请您重新提交！</p> -->
                        <p>推荐成功！</p>
                        <p>系统正在审核您的推荐信息，</p>
                        <p>您可在推荐记录中查</p>
                        <p>看被推荐人的状态！</p>
                    </div>
                </div>
                <button id="continue">继续推荐</button>
                <br/>
                <button id="share">分享好友</button>
            </div>
        </div>
    </div>
    <div class="dialog" id="myModal">
        <div class="weui_dialog_confirm" id="dialog2"  style="display: none;">
            <div class="weui_mask"></div>
            <div class="weui_dialog" id="qur" style="padding: 0 0 0 0;">
                <div class="zs"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/gg.png" alt="">
                    <img src="http://rncdn.superwx.cn/nx20180103_commend/img/ll.png" alt="">
                    <img src="http://rncdn.superwx.cn/nx20180103_commend/img/hh.png" alt="" class="hh">
                </div>
                <div class="weui_dialog_bd " id="err">
                    <div class="weui-title">
                        
                    </div>
                </div>
                <button id="ok">确定</button>
            </div>
        </div>
    </div>
    <div class="dialog" id="myModal" >
        <div class="weui_dialog_confirm" id="dialog3" style="display:none;">
            <div class="weui_mask"></div>
            <div class="weui_dialog" id="qur" style="padding: 0 0 0 0;top: 38%;">
                <div class="weui_dialog_bd " style="background: none;">
                    <img src="http://rncdn.superwx.cn/nx20180103_commend/img/tip_share.png" alt=""  style="width: 100%;">
                </div>
                <button id="ok_share">确定</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script>
    // document.querySelector('body').addEventListener('touchmove', function(e) {
    //     if (!document.querySelector('.table').contains(e.target)) {
    //         e.preventDefault();
    //     }
    // })

    $("#ok").click(function() {
        $('#dialog2').hide();
    });
    $("#ok_share").click(function() {
        $('#dialog3').hide();
        $('.mobile').val('');
    });
    $("#share").click(function() {
        $('#dialog1').hide();
        $('#dialog2').hide();
        $('#dialog3').show();
    });

    var stype = 0;
    $('#subut').click(function(){
        if ( stype != 0 ) {
            return false;
        }
        var mobiles = [];
        for (var i = 1; i <= 6; i++) {
            if($('#mobile'+i).val() != ''){

                if ( checkMobile($('#mobile'+i).val())  ) {
                    mobiles.push($('#mobile'+i).val());
                }else{
                    $('.weui-title').html('手机号'+$('#mobile'+i).val()+'格式错误');
                    $('#dialog2').show();
                    return false;
                }
            }
        }

        if (  mobiles.length < 1 ) {
            $('.weui-title').html('至少输入一个推荐用户');
            $('#dialog2').show();
            return false;
        }
        
        stype = 1;
        $.post('commend_user_do.php',{
            mobiles : mobiles,
            openid : 'otv2dt_SJ6JL8_CwqVMT0qVMcsYc' ,
            time : '1515638134' ,
            token : '4e2485f3f058d1a137da1a598dbd90c9'
        },function( data ){
            if ( data.ret == 0 ) {
                $('.weui-title').html( data.msg );
                $('#dialog1').show();
                $("#continue").click(function() {
                    // wx.closeWindow();
                    // window.location.reload();
                    $('.mobile').val('');
                    $('#dialog1').hide();
                })
            }
            else {
                $('.weui-title').html( data.msg );
                $('#dialog2').show();

            }
            stype = 0;
        },'json')
    });

    function checkMobile( mobile ) {
        return mobile.match(/^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])[0-9]{8}$/);
    }
    </script>
</body>

</html>