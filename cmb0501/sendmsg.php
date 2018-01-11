<?php
require_once(dirname(__FILE__).'/../include/config.inc.php');
require_once(dirname(__FILE__).'/../include/rnpdo.class.php');
require_once(dirname(__FILE__).'/../include/weixin.func.php');
require_once(dirname(__FILE__).'/../wxpage/func.op.php');
	
	echo date("Y-m-d H:i:s").' Send message to <br>';//日志记录
//24小时通知消息
	$pro_arr = $rnpdo->RnFetchAll('SELECT id FROM `boc_wd_items` where finished=:finished',array('finished'=>0));

	$pro_arr=$pro_arr['errmsg'];
	
	$idlist = '';
	
	foreach($pro_arr as $k=>$v){
		$idlist.=$v['id'].',';
	}
	
	$idlist = rtrim($idlist,',');

	$st_arr = $rnpdo->RnFetchAll("SELECT * FROM `boc_wd_items_status` where itemid in (".$idlist.") and status=0 and msg_flag<3 and (msg_time<:msg_time or msg_time=0) order by itemid asc,orderid asc",array('msg_time'=>time()-3600*24));

	$st_arr=$st_arr['errmsg'];
	
	
		$item_arr=array();
		foreach($st_arr as $ke=>$va){
			
			if(!in_array($va['itemid'], $item_arr)){
				if($va['h24']==1){
					if($va['setdepart']==1){//给筹建行发消息
						
						if($va['msg_flag']==0){//发给组员
							
							$post_user=Getuserid_cj($va['itemid'],6);
						
							
						}
						elseif($va['msg_flag']==1){//发给组长
						
							$post_user=Getuserid_cj($va['itemid'],7);
						
						}else{//发给行长
						
							$post_user=Getuserid_cj($va['itemid'],8);
							
						}
						

						
						
						
					}
					else//给渠道部发消息
					{
						if($va['msg_flag']==0){//发给组员

							$post_user=Getuserid_qd(Getpflag($va['itemid'])==0?0:1);
						
							
						}
						elseif($va['msg_flag']==1){//发给组长
						
							$post_user=Getuserid_qd(Getpflag($va['itemid'])==0?2:3);
						
						}else{//发给渠道部主管
						
							$post_user=Getuserid_qd(4);
							
						}
						
					}
					
					//echo $va['itemid'].'<br>';
					//print_r($post_user);
					
					
	 				//发送消息
					foreach($post_user as $key => $val){
							
						$userid = $val['userid'];

						$url_ = WEIXIN_BASE . '/wxpage/process_index.php';

						$sendmsg = "流程点未及时操作,请及时关注处理###".$userid;

						WeiXinNews($userid, '流程点未及时操作,请及时关注处理', $sendmsg, $url_);

						$msg_time=time();
						
						$update_status=$rnpdo->RnPtmTstQuery("UPDATE `boc_wd_items_status` SET msg_flag=msg_flag+1, msg_time=:msg_time where id=:id ",array('id'=>$va['id'],'msg_time'=>$msg_time));

						$insert_msg=$rnpdo->RnPtmTstQuery("insert into `boc_wd_msg_box`(userid,itemid,nodeid,content,posttime) values(:userid,:itemid,:nodeid,:content,:posttime)", array('userid'=>$userid,'itemid'=>$va['itemid'],'nodeid'=>$va['orderid'],'content'=>$sendmsg,'posttime'=>$msg_time));
						
						echo date("Y-m-d H:i:s").' Send message to '.$userid.'<br>';//日志记录
						
					}
					
					
					
					
					
					
				}
				$item_arr[] = $va['itemid'];
			}
		}
		

	
//项目开始通知消息

	$pro_start = $rnpdo->RnFetchAll('SELECT id,userid,itemname FROM `boc_wd_items` where finished=:finished and postdate=:postdate',array('finished'=>0,'postdate'=>date('Y-m-d').' 00:00:00'));

	$pro_start=$pro_start['errmsg'];
	//print_r($pro_start);
	
	$idlist = array();
	
	foreach($pro_start as $k=>$v){
		$idlist[]=$v['id'];
	}
	
	$idlstr = implode(',',$idlist);

	$st_arr = $rnpdo->RnFetchAll("SELECT itemid FROM `boc_wd_msg_box` where itemid in (".$idlstr.") and msgfrom=3 order by itemid asc");

	$st_arr=$st_arr['errmsg'];
	
	//print_r($st_arr);
	$id_ = array();
	
	$id_msg= array();
	
	if(!empty($st_arr)){
		
		foreach($st_arr as $k=>$v){
			$id_[]=$v['itemid'];
		}

	}
		$id_msg = array_diff($idlist, $id_);
	
		//print_r($id_msg);
	
		foreach($id_msg as $k=>$v){
			foreach($pro_start as $key=>$val){
				if($v==$val['id']){
					
					$proname=$val['itemname'];				
					$userid=$val['userid'];
				}
				
			}
		
				
			$url_ = WEIXIN_BASE . '/wxpage/process_index.php';

			$sendmsg = $proname."新项目即将上线，请及时关注。".$userid;

			WeiXinNews($userid, '新项目即将上线，请及时关注。', $sendmsg, $url_);
			
			$msg_time=time();
			
			$insert_msg=$rnpdo->RnPtmTstQuery("insert into `boc_wd_msg_box`(userid,itemid,msgfrom,content,posttime) values(:userid,:itemid,3,:content,:posttime)", array('userid'=>$userid,'itemid'=>$v,'content'=>$sendmsg,'posttime'=>$msg_time));
						
			echo date("Y-m-d H:i:s").' Send message to '.$userid.'<br>';//日志记录
			
		
		}
		
		

?>