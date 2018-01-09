<?php	require_once(dirname(__FILE__).'/include/config.inc.php');

/*
**************************
(C)2010-2014 phpMyWind.com
update: 2014-6-17 22:44:56
person: Feng
**************************
*/

//定义入口常量
define('IN_MEMBER', TRUE);

//初始化参数
$c  = isset($c)  ? $c : 'order';

//echo $c;exit;
$a  = isset($a)  ? $a : '';
$d  = isset($d)  ? $d : '';
$id = isset($id) ? intval($id) : 0;

//检测是否启用会员
//允许在不开启会员功能的情况下进行游客评论
if($cfg_member == 'N' && $a != 'savecomment')
{
	ShowMsg('抱歉，本站没有启用会员功能！','-1');
	exit();
}


//一键登录文件
if($cfg_oauth == 'Y')
{
	require_once(PHPMYWIND_DATA.'/api/oauth/system/core.php');
}


//初始登录信息
if(!empty($_COOKIE['username']) &&
   !empty($_COOKIE['lastlogintime']) &&
   !empty($_COOKIE['lastloginip']))
{
	$c_uname     = AuthCode($_COOKIE['username']);
	$c_logintime = AuthCode($_COOKIE['lastlogintime']);
	$c_loginip   = AuthCode($_COOKIE['lastloginip']);
}
else
{
	$c_uname     = '';
	$c_logintime = '';
	$c_loginip   = '';
}


//验证是否登录和用户合法
if($a=='saveedit'    or $a=='getarea'    or $a=='savefavorite' or
   $a=='delfavorite' or $a=='delcomment' or $a=='delmsg' or
   $a=='delorder'    or $a=='avatar'     or $a=='getgoods' or
   $a=='applyreturn' or $a=='perfect'    or $a=='binding' or
   $a=='removeoqq'   or $a=='removeoweibo' or $a=='setdefault' or 
   $a=='addressupdate' or $a=='deleteaddress' or $a=='payover' or 
   $a=='wechat' or $a=='del_trace')
{
// 	if(!empty($c_uname))
// 	{
// 		//guest为一键登录未绑定账号时的临时用户
// 		if($c_uname != 'guest')
// 		{
// 			$r = $dosql->GetOne("SELECT `id`,`expval` FROM `#@__member` WHERE `username`='$c_uname'");
// 			if(!is_array($r))
// 			{
// 				setcookie('username',      '', time()-3600);
// 				setcookie('lastlogintime', '', time()-3600);
// 				setcookie('lastloginip',   '', time()-3600);
// 				ShowMsg('该用户已不存在！','?c=login');
// 				exit();
// 			}
// 			else if($r['expval'] <= 0)
// 			{
// 				ShowMsg('抱歉，您的账号被禁止登录！','?c=login');
// 				exit();
// 			}
// 		}
// 	}
// 	else
// 	{
// 		header('location:?c=login');
// 		exit();
// 	}
}

//默认地址
if($a == 'del_trace')
{
    if($dosql->ExecNoneQuery("DELETE FROM `#@__trace` WHERE id=".$_POST['id'])){
        echo 1;
    } else {
        echo 2;exit();
    }
}


//默认地址
if($a == 'setdefault')
{
    if(isset($id)){
        $dosql->ExecNoneQuery("UPDATE `#@__address` SET `default`=0 WHERE uid=".$uid);
        if($dosql->ExecNoneQuery("UPDATE `#@__address` SET `default`=1 WHERE id=".$id)){
    	    ShowMsg('设为默认地址成功','member.php?c=address');
    		exit();
        }
    }
}

//地址
else if($a == 'address_save')
{

   // if($sname == '' or $mobile == '' or $code == '' or $province == '' or $city == '' or $county == '' or $address == ''){
	    if($sname == '' or $mobile == '' or $code == '' or $address == ''){
        header('location:?c=address_add');
        exit();
    }
    if(mb_strlen($sname) < 1 || mb_strlen($sname) > 15){
		ShowMsg('姓名在一至五个字之间','-1');
        //header('location:?c=address_add');
        exit();
    }
    if(!preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/", $mobile)){
		ShowMsg('请填写正确的联系电话','-1');
		;exit();
        header('location:?c=address_add');
        exit();
    }
    /*if(strlen($code) != 6){

        header('location:?c=address_add');
        exit();
    }*/
    if(isset($action) && $action == 'add'){
		
		if($firstaddress==1)
		{
			$first='1';
			$sqlz="update `#@__address` set defaults='0' where uid = '$uid'";
			$dosql->ExecNoneQuery($sqlz);
		}else
		{
			$first=0;
		}
		
    	//$sql = "INSERT INTO `#@__address` (uid,sname,mobile,province,city,country,address,code,defaults) VALUES ('$uid','$sname','$mobile','$province','$city','$county','$address','$code','$first')";	
		$sql = "INSERT INTO `#@__address` (uid,sname,mobile,address,code,defaults) VALUES ('$uid','$sname','$mobile','$address','$code','$first')";	
		if($dosql->ExecNoneQuery($sql))
    	{	
    	    if(isset($url)){
    	        echo 1;
				exit();
    	    }else{
				ShowMsg('添加成功','member.php?c=address');
				exit();
    	    }
    	}
    }else{
		
		if($firstaddress==1)
		{
			$first=",defaults='1'";
			$sqls="update `#@__address` set defaults='0' where id!=$id and uid = '$uid'";
			$dosql->ExecNoneQuery($sqls);
		}else
		{
			$first="";
		}
		
        //$sql = "UPDATE `#@__address` SET sname='$sname', mobile='$mobile', province='$province', city='$city',country='$county',address='$address',code='$code' $first WHERE id=$id and uid='$uid'";
		$sql = "UPDATE `#@__address` SET sname='$sname', mobile='$mobile',address='$address',code='$code' $first WHERE id=$id and uid='$uid'";
        if($dosql->ExecNoneQuery($sql))
        {
            ShowMsg('修改成功','member.php?c=address');
            exit();
        }
    }
}

//默认地址
if($a == 'deleteaddress')
{
    if($dosql->ExecNoneQuery("DELETE FROM `#@__address` WHERE id=".$id)){
		//ShowMsg('删除成功','member.php?c=address');
		header('location:member.php?c=address');
		exit();
    } else {
		ShowMsg('删除失败','member.php?c=address');
		exit();
    }
}

//支付成功
else if($a == 'payover') {   
if(isset($_GET['action']) && $_GET['action']=='ok'){
		$a = $dosql->getone("select attrstr,username,ordernum,amount from `#@__goodsorder` where `id`='$id'");
		$name = $a['username'];
		$ordernum = $a['ordernum'];
		$amount = $a['amount'];
		
		$member = $dosql->GetOne("SELECT * FROM `#@__member` WHERE id='$name'");

		foreach(unserialize($a['attrstr']) as $value ){
				    //获取数据库中商品信息
				    $r = $dosql->GetOne("SELECT * FROM `#@__goods` WHERE `id`=".$value[0]." AND delstate=''");	    	
				    $cid = $r['typeid'];
				}
				
		require 'Wechat/Wechat.class.php';
		$options = array (
            'token' => 'yonghuchaoshi', // 填写你设定的key
            'encodingaeskey' => 'l8Wen1xSkJ2WHHKu8zMYan4HNZsI4JTMBc48l2mUkwy', // 填写加密用的EncodingAESKey
            'appid' => 'wxb824db10cc85ebb0', // 填写高级调用功能的app id
            'appsecret' => 'a042dfd07987472a53b742c03d7d55a4' // 填写高级调用功能的密钥
		    //         'partnerid' => '', // 财付通商户身份标识
		    //         'partnerkey' => '', // 财付通商户权限密钥Key
		    //         'paysignkey' => ''  // 商户签名密钥Key
		);
		$weObj = new Wechat ( $options );
		$wxinfo = json_decode($member['wx_info'],true);
		$nickname = $wxinfo['nickname'];
		
		
		//成为族长
	if($member['member'] == 0) {
		$sql = "UPDATE `#@__member` SET member=1 WHERE id='$name'";
		if($dosql->ExecNoneQuery($sql)){
		header('location:?c=default');
			exit();
		} else {
			ShowMsg('执行错误！','?c=order');
			exit();
		}
		
		
		//if($dosql->ExecNoneQuery($sql)){
//			
//			
//			$ticket = $weObj->getQRCode($name,1);
//			$httpurl = $weObj->getQRUrl($ticket['ticket']);//http网址 打开是图片
//			
//			//存头像       
//			
//			$logoname = "./imgpublic/logo_".$name.".jpg";
//			$headimgurl = $wxinfo['headimgurl'];
//			$local_logo_file = fopen($logoname, 'w');
//			fwrite($local_logo_file, file_get_contents($headimgurl));
//			fclose($local_logo_file);
//			imagecropper($logoname,114,104,$name,'logo');    
//			
//			//存二维码图片
//			$filename = "./imgpublic/ticket_".$name.".jpg";
//			$local_file = fopen($filename, 'w');
//			fwrite($local_file, file_get_contents($httpurl));
//			fclose($local_file);
//			imagecropper($filename,250,250,$name,'ticket'); 
//			/***/
//			
//			$imgs    = array();	
//			
//			$imgs[0] = $logoname;
//			$imgs[1] = $filename;
//			
//			$target  = 'imgpublic/card.jpg'; //背景图片
//			
//			$target_img = Imagecreatefromjpeg($target);
//			
//			$source = array();
//			
//			foreach ($imgs as $k => $v) {
//			
//				$source[$k]['source'] = Imagecreatefromjpeg($v);
//			
//				$source[$k]['size'] = getimagesize($v);
//			
//			}
//			imagecopy ($target_img,$source[0]['source'],15,11,0,0,114,104);
//			imagecopy ($target_img,$source[1]['source'],190,550,0,0,250,250);
//			
//			Imagejpeg($target_img, 'imgpublic/user_'.$name.'.jpg');
//			
//			/***/
//			//原来返利在这
//			
//			
//			//返利
//
//			
//			
//			/***/
//			
//			ShowMsg('恭喜您已成为代理商','?c=default');
//			exit();
//		} else {
//			ShowMsg('执行错误！','?c=order');
//			exit();
//		}
	} else {
		//
		header('location:?c=default');
	}   
		
    } else {
        ShowMsg('非法操作！','index.php');
    }
 
}

//更新资料
else if($a == 'saveedit')
{
	
	//检测数据完整性
	if($password!=$repassword)
	{
		header('location:?c=edit');
		exit();
	}


	//HTML转义变量
// 	$answer    = htmlspecialchars($answer);
// 	$cnname    = htmlspecialchars($cnname);
	$enname    = htmlspecialchars($enname);
	$cardnum   = htmlspecialchars($cardnum);
	$intro     = htmlspecialchars($intro);
	$email     = htmlspecialchars($email);
	$qqnum     = htmlspecialchars($qqnum);
	$mobile    = htmlspecialchars($mobile);
	$telephone = htmlspecialchars($telephone);
	$address   = htmlspecialchars($address);
	$zipcode   = htmlspecialchars($zipcode);


// 	//检测旧密码是否正确
// 	if($password != '')
// 	{
// 		$oldpassword = md5(md5($oldpassword));
// 		$r = $dosql->GetOne("SELECT `password` FROM `#@__member` WHERE `username`='$c_uname'");
// 		if($r['password'] != $oldpassword)
// 		{
// 			ShowMsg('抱歉，旧密码错误！','-1');
// 			exit();
// 		}
// 	}

	$sql = "UPDATE `#@__member` SET ";
// 	if($password != '')
// 	{
// 		$password = md5(md5($password));
// 		$sql .= "password='$password', ";
// 	} answer='$answer',
	@$sql .= "question='$question', cnname='$cnname', enname='$enname', sex='$sex', birthtype='$birthtype', birth_year='$birth_year', birth_month='$birth_month', birth_day='$birth_day', astro='$astro', bloodtype='$bloodtype', trade='$trade', live_prov='$live_prov', live_city='$live_city', live_country='$live_country', home_prov='$home_prov', home_city='$home_city', home_country='$home_country', cardtype='$cardtype', cardnum='$cardnum', intro='$intro', email='$email', qqnum='$qqnum', mobile='$mobile', telephone='$telephone', address_prov='$address_prov', address_city='$address_city', address_country='$address_country', address='$address', zipcode='$zipcode' WHERE id='$id' AND `username`='$c_uname'";
	if($dosql->ExecNoneQuery($sql))
	{
		ShowMsg('资料更新成功！','?c=edit');
		exit();
	}
}


//获取级联
else if($a == 'getarea')
{
	//初始化参数
	$datagroup = isset($datagroup) ? $datagroup     : '';
	$level     = isset($level)     ? intval($level) : '';
	$v         = isset($areaval)   ? $areaval       : '0';

	if($datagroup == '' or $level == '' or $v == '')
	{
		header('location:?c=default');
		exit();
	}

	$str = '<option value="-1">--</option>';
	$sql = "SELECT * FROM `#@__cascadedata` WHERE `level`=$level And ";

	if($v == 0)
		$sql .= "datagroup='$datagroup'";
	else if($v % 500 == 0)
		$sql .= "`datagroup`='$datagroup' AND `datavalue`>'$v' AND `datavalue`<'".($v + 30)."'";
	else
		$sql .= "`datavalue` LIKE '$v.%%%' AND `datagroup`='$datagroup'";
	
	$sql .= " ORDER BY orderid ASC, datavalue ASC";

	$dosql->Execute($sql);
	while($row = $dosql->GetArray())
	{
		$str .= '<option value="'.$row['datavalue'].'">'.$row['dataname'].'</option>';
	}
	
	if($str == '') $str .= '<option value="-1">--</option>'; 
	echo $str;
	exit();
}


//保存评论
else if($a == 'savecomment')
{
	//是否开去文章评论功能
	if($cfg_comment == 'N') exit();

	//初始化参数
	$uid   = isset($uid)   ? intval($uid)   : '';
	$aid   = isset($aid)   ? intval($aid)   : '';
	$molds = isset($molds) ? intval($molds) : '';
	$body  = isset($body)  ? htmlspecialchars($body) : '';
	$link  = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER'],ENT_QUOTES) : '';

	if($aid == '' or $molds == '' or $body == '')
	{
		header('location:?c=default');
		exit();
	}

	$reply = '';
	
// 	if(empty($c_uname))
// 	{
// 		$uid   = '-1';
// 		$uname = '游客';
// 	}
// 	else
// 	{
// 		$r = $dosql->GetOne("SELECT `id`,`expval`,`integral` FROM `#@__member` WHERE `username`='$c_uname'");
// 		$uid   = $r['id'];
// 		$uname = $c_uname;
// 	}
    $r = $dosql->GetOne("SELECT * FROM `#@__member` WHERE `id`='$uid'");
    $info = json_decode($r['wx_info'],true);
    $uname = $info['nickname'];
    
	$time  = time();
	$ip    = GetIP();

	$dosql->ExecNoneQuery("INSERT INTO `#@__usercomment` (aid,molds,uid,uname,body,reply,link,time,ip,isshow) VALUES ('$aid','$molds','$uid','$uname','$body','$reply','$link','$time','$ip','1')");


	$r = $dosql->GetOne("SELECT `id` FROM `#@__usercomment` WHERE `aid`='$aid' AND `molds`='$molds' AND `uid`='$uid'");
	if(empty($r['id']) && !empty($c_uname) && $uid != '-1')
	{
		//评论一条增加1经验值2积分
		$dosql->ExecNoneQuery("UPDATE `#@__member` SET expval='".($r['expval'] + 1)."', integral='".($r['integral'] + 2)."' WHERE `username`='$c_uname'");
	}

	echo json_encode(array('1',$uname,$body,GetDateTime($time)));
	exit();
}


//删除评论
else if($a == 'delcomment')
{
	//是否开去文章评论功能
	if($cfg_comment == 'N') exit();

	if(is_array($checkid))
	{
		foreach($checkid as $v)
		{
			//参数过滤
			$v = intval($v);
			$dosql->ExecNoneQuery("DELETE FROM `#@__usercomment` WHERE `id`=$v AND `uname`='$c_uname'");
		}
	}

	header('location:?c=comment');
	exit();
}


//保存收藏
else if($a == 'savefavorite')
{

	$aid   = isset($aid)   ? intval($aid)   : '';
	$molds = isset($molds) ? intval($molds) : '';
	$link  = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER'],ENT_QUOTES) : '';

	if($aid == '' or $molds == '' or $link == '')
	{
		header('location:?c=default');
		exit();
	}
    $c_uname = AuthCode($_COOKIE['username']);
	$r = $dosql->GetOne("SELECT * FROM `#@__member` WHERE `id`='$c_uname'");
	$info = json_decode($r['wx_info'],true);
	$uid   = $r['id'];
	$uname = $info['nickname'];//id
	$time  = time();
	$ip    = GetIP();

	$r2 = $dosql->GetOne("SELECT `aid`,`molds` FROM `#@__userfavorite` WHERE `aid`=$aid and `molds`=$molds and `uid`='$uid'" );
	if(!is_array($r2))
	{
		$dosql->ExecNoneQuery("INSERT INTO `#@__userfavorite` (aid,molds,uid,uname,link,time,ip,isshow) VALUES ('$aid','$molds','$uid','$uname','$link','$time','$ip','1')");

		echo '1';
		exit();
	}
	else
	{
		echo '2';
		exit();
	}
}


//删除收藏
else if($a == 'delfavorite')
{
    $c_uname = AuthCode($_COOKIE['username']);
	/*if(is_array($checkid))
	{
		foreach($checkid as $v)
		{
			//参数过滤
			$v = intval($v);*/
			$dosql->ExecNoneQuery("DELETE FROM `#@__userfavorite` WHERE `id`=$id AND `uid`='$c_uname'");
		//}
	//}

	header('location:?c=favorite');
	exit();
}


//删除留言
else if($a == 'delmsg')
{
	if(is_array($checkid))
	{
		foreach($checkid as $v)
		{
			//参数过滤
			$v = intval($v);
			$dosql->ExecNoneQuery("DELETE FROM `#@__message` WHERE `id`=$v AND `nickname`='$c_uname'");
		}
	}

	header('location:?c=msg');
	exit();
}


//删除订单
else if($a == 'delorder')
{

   $c_uname     = AuthCode($_COOKIE['username']);

	if(is_array($checkid))
	{
	
		foreach($checkid as $v)
		{
			//参数过滤
			$v = intval($v);

			$r = $dosql->GetOne("SELECT `checkinfo` FROM `#@__goodsorder` WHERE `id`=$v");
			$checkinfo = explode(',', $r['checkinfo']);
			//print_r($checkinfo);exit();
			//if(in_array('overorder',  $checkinfo))

				$dosql->ExecNoneQuery("DELETE FROM `#@__goodsorder` WHERE `id`=$v AND `username`='$c_uname'");
		}
	}

	header('location:?c=order');
	exit();
}


//确认收货
else if($a == 'getgoods')
{
	$c_uname     = AuthCode($_COOKIE['username']);

	$r = $dosql->GetOne("SELECT `checkinfo` FROM `#@__goodsorder` WHERE `username`='$c_uname' AND `id`=$id");
	
	$checkinfo = explode(',',$r['checkinfo']);

	if(!in_array('getgoods', $checkinfo))
	{
		$checkinfo = $r['checkinfo'].',getgoods';
	}

	$dosql->ExecNoneQuery("UPDATE `#@__goodsorder` SET checkinfo='$checkinfo' WHERE `username`='$c_uname' AND `id`=$id");
	header('location:?c=ordershow&id='.$id);
	exit();
}


//申请退款
else if($a == 'applyreturn')
{
	$r = $dosql->GetOne("SELECT `checkinfo` FROM `#@__goodsorder` WHERE `username`='$c_uname' AND `id`=$id");
	$checkinfo = explode(',',$r['checkinfo']);

	if(!in_array('applyreturn', $checkinfo))
	{
		$checkinfo = $r['checkinfo'].',applyreturn';
	}

	$dosql->ExecNoneQuery("UPDATE `#@__goodsorder` SET checkinfo='$checkinfo' WHERE `username`='$c_uname' AND `id`=$id");
	header('location:?c=ordershow&id='.$id);
	exit();
}


//支付余额
else if($a == 'pay')
{
	//
	header('location:orderpay.php');
	exit();
}


if($c=='default'  or $c=='edit'   or $c=='comment' or
   $c=='favorite' or $c=='order'  or $c=='ordershow' or 
   $c=='msg'      or $c=='avatar' or $c=='perfect' or
   $c=='binding'  or $c=='address'or $c=='address_add' or 
   $c=='address_update' or $c=='trace' )
{
// 	if(!empty($c_uname))
// 	{
// 		//guest为同步登录未绑定账号时的临时用户
// 		if($c_uname != 'guest')
// 		{
// 			$r = $dosql->GetOne("SELECT `id`,`expval` FROM `#@__member` WHERE `username`='$c_uname'");
// 			if(!is_array($r))
// 			{
// 				setcookie('username',      '', time()-3600);
// 				setcookie('lastlogintime', '', time()-3600);
// 				setcookie('lastloginip',   '', time()-3600);
// 				ShowMsg('该用户已不存在！','?c=login');
// 				exit();
// 			}
// 			else if($r['expval'] <= 0)
// 			{
// 				ShowMsg('抱歉，您的账号被禁止登录！','?c=login');
// 				exit();
// 			}
// 		}
// 	}
// 	else
// 	{
// 		header('location:?c=login');
// 		exit();
// 	}
}

//物流查询
else if($c == 'logistics')
{
    require_once(PHPMYWIND_TEMP.'/default/member/logistics.php');
    exit();
}

//取消收藏
else if($c == 'favorite_del')
{
    require_once(PHPMYWIND_TEMP.'/default/member/favorite_del.php');
    exit();
}
//会员中心
if($c == 'default')
{
// 	if($c_uname != 'guest')
		require_once(PHPMYWIND_TEMP.'/default/member/default.php');
// 	else
// 		require_once(PHPMYWIND_TEMP.'/default/member/defaultguest.php');
	
	exit();
}

//上传头像
else if($c == 'avatar')
{		
	require_once(PHPMYWIND_TEMP.'/default/member/avatar.php');
	exit();
}

//我的足迹
else if($c == 'trace')
{
    require_once(PHPMYWIND_TEMP.'/default/member/trace.php');
    exit();
}

//地址列表
else if($c == 'address')
{
    require_once(PHPMYWIND_TEMP.'/default/member/address.php');
    exit();
}

//上传头像
else if($c == 'address_update')
{
    require_once(PHPMYWIND_TEMP.'/default/member/address_update.php');
    exit();
}

//新增地址
else if($c == 'address_add')
{
    require_once(PHPMYWIND_TEMP.'/default/member/address_add.php');
    exit();
}

//编辑资料
else if($c == 'edit')
{		
	require_once(PHPMYWIND_TEMP.'/default/member/edit.php');
	exit();
}

//评论列表
else if($c == 'comment')
{	
	require_once(PHPMYWIND_TEMP.'/default/member/comment.php');
	exit();
}


//收藏列表
else if($c == 'favorite')
{
	require_once(PHPMYWIND_TEMP.'/default/member/favorite.php');
	exit();
}


//订单列表
else if($c == 'order')
{
	require_once(PHPMYWIND_TEMP.'/default/member/order.php');
	exit();
}

//订单列表
else if($c == 'notpay')
{
    require_once(PHPMYWIND_TEMP.'/default/member/notpay.php');
    exit();
}

//订单列表
else if($c == 'notqueren')
{
    require_once(PHPMYWIND_TEMP.'/default/member/notqueren.php');
    exit();
}
//订单列表
else if($c == 'notpost')
{
    require_once(PHPMYWIND_TEMP.'/default/member/notpost.php');
    exit();
}

//订单列表
else if($c == 'notreceive')
{
    require_once(PHPMYWIND_TEMP.'/default/member/notreceive.php');
    exit();
}

//订单列表
else if($c == 'overorder')
{
    require_once(PHPMYWIND_TEMP.'/default/member/overorder.php');
    exit();
}

//订单详情
else if($c == 'ordershow')
{
	require_once(PHPMYWIND_TEMP.'/default/member/ordershow.php');
	exit();
}

//留言列表
else if($c == 'msg')
{
	require_once(PHPMYWIND_TEMP.'/default/member/msg.php');
	exit();
}

//在线反馈
else if($c == 'fankui')
{
	require_once(PHPMYWIND_TEMP.'/default/member/fankui.php');
	exit();
}

//我的积分
else if($c == 'jifen')
{
	require_once(PHPMYWIND_TEMP.'/default/member/jifen.php');
	exit();
}
//积分列表
else if($c == 'youhuiquan')
{
	require_once(PHPMYWIND_TEMP.'/default/member/youhuiquan.php');
	exit();
}
else
{

}



//验证码获取函数
function GetCkVdValue()
{
	if(!isset($_SESSION)) session_start();
	return isset($_SESSION['ckstr']) ? $_SESSION['ckstr'] : '';
}


//验证码重置函数
function ResetVdValue()
{
	if(!isset($_SESSION)) session_start();
	$_SESSION['ckstr'] = '';
}
