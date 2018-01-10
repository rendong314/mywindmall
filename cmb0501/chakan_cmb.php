<?php
require(dirname(__FILE__).'/../../include/config.inc.php');

	$dosql->Execute("SELECT * FROM `cmb_redpack_0501`");
	echo '<table border=1>';
	while($row = $dosql->GetArray())
	{
		echo '<tr><td>'.implode('<td>',$row);
		//echo '<li><span class="uname">'.$row['openid'].'</span><p>'.$row['body'].'</p><span class="time">'.GetDateTime($row['time']).'</span></li>';
	}
	echo '</table>';	


?>