<?php
include('config.php'); 
if($priv == 'Director' or $priv == 'Librarian'):
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `Works` (`ID` ,  `Composer` ,  `Title` ,  `Publisher` ,  `Arranger` ,  `Notes` ,  `Inventoried` ,  `Score_Location`  ) VALUES(  '{$_POST['ID']}' ,  '{$_POST['Composer']}' ,  '{$_POST['Title']}' ,  '{$_POST['Publisher']}' ,  '{$_POST['Arranger']}' ,  '{$_POST['Notes']}' ,  '{$_POST['Inventoried']}' ,  '{$_POST['Score_Location']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added work.<br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} ?>
<form action='' method='POST'> 
<p><b>ID:</b><br /><input type='text' name='ID'/> 
<p><b>Composer:</b><i><br />Last Name, First Name</i><br /><input type='text' name='Composer'/> 
<p><b>Title:</b><br /><input type='text' name='Title'/> 
<p><b>Publisher:</b><br /><input type='text' name='Publisher'/> 
<p><b>Arranger:</b><br /><input type='text' name='Arranger'/> 
<p><b>Notes:</b><br /><input type='text' name='Notes'/> 
<p><b>Last Inventory Date:</b><br /><i>YYYY-MM-DD</i><br /><input type='text' name='Inventoried'/> 
<p><b>Score Location:</b><br /><input type='text' name='Score_Location'/> 
<p><input type='submit' value='Add Work' /><input type='hidden' value='1' name='submitted' /> 
</form>
<?php endif;
if (!($priv == 'Director' or $priv == 'Librarian')){
include('denied.html');}
include('footer.html');
?>