<?php
    $con=mysql_connect("127.0.0.1","webuser","7svRm1dyaqQvnlES");
    if(!$con){
    die("Can't connect the database ".mysql_error());
    }
    mysql_select_db("webuser",$con);
?>