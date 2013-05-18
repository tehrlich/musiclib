<?php
include('config.php'); 
$uid = (int) $_GET['uid']; 
//mysql_query("DELETE FROM `Works` WHERE `ID` = '$ID' ") ; 
mysql_query("DELETE FROM `Works` WHERE CONCAT(`Works`.`uid`) = '$uid' LIMIT 1");
echo (mysql_affected_rows()) ? "Work deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='list.php'>Back To Works</a>

<?php include('footer.html'); ?>