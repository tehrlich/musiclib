<? 
include('config.php'); 
if (isset($_GET['uid']) ) { 
$uid = (int) $_GET['uid']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Works` SET `ID` = '{$_POST['ID']}' , `Composer` =  '{$_POST['Composer']}' ,  `Score_Location` =  '{$_POST['Score_Location']}' ,   `Title` =  '{$_POST['Title']}' ,  `Publisher` =  '{$_POST['Publisher']}' ,  `Arranger` =  '{$_POST['Arranger']}' ,  `Notes` =  '{$_POST['Notes']}' ,  `Inventoried` =  '{$_POST['Inventoried']}'  WHERE `uid` = '$uid' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited work.<br />" : "Nothing changed. <br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Works` WHERE `uid` = '$uid' ")); 
?>

<form action='' method='POST'> 
<p><b>ID:</b><br /><input type='text' name='ID' value='<?= stripslashes($row['ID']) ?>' /> 
<p><b>Composer:</b><br /><i>Last Name, First Name</i><br /><input type='text' name='Composer' value='<?= stripslashes($row['Composer']) ?>' /> 
<p><b>Title:</b><br /><input type='text' name='Title' value='<?= stripslashes($row['Title']) ?>' /> 
<p><b>Publisher:</b><br /><input type='text' name='Publisher' value='<?= stripslashes($row['Publisher']) ?>' /> 
<p><b>Arranger:</b><br /><input type='text' name='Arranger' value='<?= stripslashes($row['Arranger']) ?>' /> 
<p><b>Notes:</b><br /><input type='text' name='Notes' value='<?= stripslashes($row['Notes']) ?>' /> 
<p><b>Inventoried:</b><i><br /><i>YYYY-MM-DD</i><br /><input type='text' name='Inventoried' value='<?= stripslashes($row['Inventoried']) ?>' /> 
<p><b>Score Location:</b><br /><input type='text' name='Score_Location' value='<?= stripslashes($row['Score_Location']) ?>' /> 
<p><input type='submit' value='Edit Work' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } include('footer.html');  ?>