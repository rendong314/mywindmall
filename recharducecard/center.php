
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
    timestamp: 1515637923,
    nonceStr: 'YHqoCjvMSz2lkYRl',
    signature: '5e0fb9dede307737737a1f369e0efcf3b4235d4f',
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

.news button:first-of-type {
    margin: -1.5rem -5rem;
}

.news button:last-of-type{margin-top: 1em;}
</style>
</head>

<body>
    <div class="content">
        <div class="head"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/logo.png" alt="中国银行宁夏回族自治区分行"></div>
        <div class="banner">
            <div class="w_img"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/banner3.png" alt="" class="banner1"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/22.png" alt="" class="banner2"></div>
            <div class="zs"><img src="http://rncdn.superwx.cn/nx20180103_commend/img/gg.png" alt="">
                <img src="http://rncdn.superwx.cn/nx20180103_commend/img/ll.png" alt="">
                <img src="http://rncdn.superwx.cn/nx20180103_commend/img/hh.png" alt="" class="hh">
            </div>
            <div class="num">
                <div class="number">25</div>
                <div class="peoper_num ">
                    <p>系统累计推荐人数
                        <br/> 35人</p>
                </div>
            </div>
        </div>
        <div class="news">
            <button style="z-index: 9999;position: absolute;"><a href="recommend.php?openid=otv2dt_SJ6JL8_CwqVMT0qVMcsYc&time=1515637923&token=244c01b88701158f6e3aedff517adb0f" style="display: block;">我要推荐</a></button><br/>
            <button><a href="commend_list.php?openid=otv2dt_SJ6JL8_CwqVMT0qVMcsYc&time=1515637923&token=244c01b88701158f6e3aedff517adb0f" style="display: block;">我的推荐记录</a></button>
        </div>
        <div class="form">
            <div class="left">
                <p>已推荐人数
                    <br/> 0人</p>
                <p><a href="rule.php" style="display: block;">活动规则</a></p>
            </div>
            <div class="right">
                <p>成功推荐人数
                    <br/> 0人</p>
                <p><a href="prize_list.php?openid=otv2dt_SJ6JL8_CwqVMT0qVMcsYc&time=1515637923&token=244c01b88701158f6e3aedff517adb0f" style="display: block;">奖励明细</a></p>
            </div>
        </div>
    </div>
</body>

</html>