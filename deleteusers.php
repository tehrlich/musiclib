<? 
include('config.php'); 
$ID = (int) $_GET['ID']; 
mysql_query("DELETE FROM `Users` WHERE `ID` = '$ID' ") ; 
echo (mysql_affected_rows()) ? "User deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='users.php'>Back To Listing</a>

<?php include('footer.html'); ?>