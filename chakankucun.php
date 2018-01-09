<?php
/* echo strpos("You love php, I love php too!","php");
print_r($_COOKIE);
exit; */


require_once(dirname(__FILE__).'/include/config.inc.php');

header("Content-type: text/html; charset=utf-8"); 

/* $str = AuthCode('13227755681', '', 'abc899999999999999999', 0);
echo $str;
exit; */

	
	
/* 		$dosql->Execute("SELECT  * FROM boc_info_list");
 	//$row = $dosql->GetArray();
	//print_r($row); 
 	echo '<table border=1>';
	//$infolist=array();
	while($row = $dosql->GetArray())
	{
		//$infolist[]=$row;
		echo '<tr><td>'.implode('<td>',$row);
		//echo '<li><span class="uname">'.$row['openid'].'</span><p>'.$row['body'].'</p><span class="time">'.GetDateTime($row['time']).'</span></li>';
	}
	echo '</table>';	
	// $infolist=json_encode($infolist);	
	// print_r($infolist);
	exit; */
	
	
//echo  dirname(dirname(__FILE__));

/* 	if(!isset($_COOKIE['openid']) || empty($_COOKIE['openid'])){
        //认证获取openid
        $_COOKIE['openid'] = GetOpenID($_GET, WEIXIN_BASE . $_SERVER['REQUEST_URI']);
    }   */
	//$openid='oe7Itt32idmMRjMFy_Ko8Ic6NiaE';//$_COOKIE['openid'];//



//非项目关联文件，用于查看数据
	//$dosql->Execute("insert into im_sr_chatlog(from_id,to_id,from_name,from_avatar,content,posttime,need_send) values('liudongwei','oe7Itt32idmMRjMFy_Ko8Ic6NiaE','刘东伟','http://shp.qpic.cn/bizmp/W5lwnHc4Yja6Ugr9TJQGbWcZ02riaUcyaGwA9ibUlZicOLoONzrKglaOA/','562363',".time().",1)");
		//$rv=$rnpdo->RnPtmTstQuery("INSERT into `boc_sharebox`(urlid,soonopenid,posttime,is_share,share_type) values(:aid,:openid,:posttime,:is_share,:share_type)",array('aid'=>'12','openid'=>'oe7Itt32idmMRjMFy_Ko8Ic6NiaE','posttime'=>time(),'is_share'=>'1','share_type'=>'0'));
 	//$dosql->Execute("alter table boc_wd_items_status add column nodedesc varchar(255) DEFAULT ''");
	//$dosql->Execute("delete from  boc_wd_msg_box where id <435");
	//$dosql->Execute("update boc_wd_items_status set status=2 where itemid=62 and orderid<3");
	$dosql->Execute("SELECT  id,title,housenum  FROM  fenxiao1000_goods where checkinfo='true'");
/* 	$row = $dosql->GetArray();
	print_r($row); */
 	echo '<table border=1>';
	//$infolist=array();
	while($row = $dosql->GetArray())
	{
		//$infolist[]=$row;
		echo '<tr><td>'.implode('<td>',$row);
		//echo '<li><span class="uname">'.$row['openid'].'</span><p>'.$row['body'].'</p><span class="time">'.GetDateTime($row['posttime']).'</span></li>';
	}
	echo '</table>';	
/* $infolist=json_encode($infolist);	
	print_r($infolist); */
?>