<?php require_once(dirname(__FILE__).'/include/config.inc.php'); 

$id = empty($id) ? 41 : intval($id);

?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link href="style/webstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="js/zVy3.js"></script> 
<script type="text/javascript" src="js/zVy5.js"></script> 
<title>售后说明</title>

</head>

<body style="max-width:640px;margin:0 auto;">
<!-- main start -->
<br>
<div style=" width:95%; margin:0 auto;">
<?php echo Info($id)?>
</div>
<!-- main start -->
<div style="height:80px;"></div>
<?php require_once("footer.php")?>
</body>
</html>
