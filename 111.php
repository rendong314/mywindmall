<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

						$dosql->Execute("SELECT * FROM `#@__goodsprice`",3);
							while($row3 = $dosql->GetArray(3)){

							$sql = "update `#@__goods` set guige_zt='1' where id = '$row3[goodsid]'";	
							$dosql->ExecNoneQuery($sql);
							
						}

?>