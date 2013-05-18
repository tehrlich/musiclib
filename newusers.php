<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO Users ( NetID ,  privs  ) VALUES(  '{$_POST['NetID']}' ,  '{$_POST['privs']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added user.<br />"; 
echo "<a href='users.php'>Back To User List</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>NetID:</b><br /><input type='text' name='NetID'/> 
<p><b>Privilege:</b><br /><select name='privs'>
            <option value='Viewer'>Viewer</option>
            <option value='Librarian'>Librarian</option>
            <option value='Director'>Director</option>
<p><input type='submit' value='Add User' /><input type='hidden' value='1' name='submitted' /> 
</form> 

<?php include('footer.html'); ?>