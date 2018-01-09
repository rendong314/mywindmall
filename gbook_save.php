<?php	require_once(dirname(__FILE__).'/include/config.inc.php');
//留言内容处理
if(isset($action) and $action=='add')
{
	
	//检测数据正确性
	/*if(strtolower($validate) != strtolower(GetCkVdValue()))
	{
		ResetVdValue();
		ShowMsg('验证码不正确！','?c=login');
		exit();
	}
	else
	{*/
		$r = $dosql->GetOne("SELECT Max(orderid) AS orderid FROM `#@__message`");
		$orderid  = (empty($r['orderid']) ? 1 : ($r['orderid'] + 1));
		$input_title = htmlspecialchars($input_title);
		$input_username = htmlspecialchars($input_username);
		$nickname = htmlspecialchars($nickname);
		$contact  = htmlspecialchars($contact);
		$content  = htmlspecialchars($content);
		$posttime = GetMkTime(time());
		$ip       = gethostbyname($_SERVER['REMOTE_ADDR']);
	
	
		$sql = "INSERT INTO `#@__message` (siteid, biaoti, nickname, contact, content, orderid, email, posttime, htop, rtop, checkinfo, ip) VALUES (".$uid.", '$lc_title', '$lc_name', '$lc_tel', '$lc_content', '', '$lc_email' ,'$posttime', '', '', 'false', '$ip')";
		//echo $sql;die;
		if($dosql->ExecNoneQuery($sql))
		{
			ShowMsg('留言成功，感谢您的支持！',"member.php?c=default");
			exit();
		}
	}
//}
?>
