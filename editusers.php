<? 
include('config.php'); 
	if($priv == 'Director'):
	if (isset($_GET['ID']) ) { 
		$ID = (int) $_GET['ID']; 
		if (isset($_POST['submitted'])) { 
			foreach($_POST AS $key => $value) { 
				$_POST[$key] = mysql_real_escape_string($value); 
			} 
			$sql = "UPDATE `Users` SET  `NetID` =  '{$_POST['NetID']}' ,  `privs` =  '{$_POST['privs']}'   WHERE `ID` = '$ID' "; 
			mysql_query($sql) or die(mysql_error()); 
			echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
			echo "<a href='users.php'>Back To Listing</a>"; 
		} 
	$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Users` WHERE `ID` = '$ID' ")); 
	}
?>

<form action='' method='POST'> 
	<p><b>NetID:</b><br /><input type='text' name='NetID' value='<?= stripslashes($row['NetID']) ?>' /> 
	<p><b>Privilege:</b><br /><input type='text' name='privs' value='<?= stripslashes($row['privs']) ?>' /> 
	<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 

<?php 
endif;
if ($priv != 'Director'){
	include('denied.html');
}
include('footer.html'); 
?>
