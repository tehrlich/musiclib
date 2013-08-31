<? 
include('config.php'); 
if($priv == 'Director'){
	echo "<table id='results' class='table table-striped table-bordered'>"; 
	echo "<thead>"; 
	echo "<td><b>NetID</b></td>"; 
	echo "<td><b>Privilege</b></td>"; 
	echo "<td><b>Delete User</b></td>"; 
	echo "</thead>"; 
	$result = mysql_query("SELECT * FROM `Users` ORDER BY privs") or trigger_error(mysql_error()); 
	while($row = mysql_fetch_array($result)){ 
		foreach($row AS $key => $value) { 
			$row[$key] = stripslashes($value); 
		} 
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row['NetID']) . "</td>";  
		echo "<td valign='top'>" . nl2br( $row['privs']) . "</td>";  
		echo "<td valign='top'><a href=deleteusers.php?ID={$row['ID']}>Delete</a></td> "; 
		echo "</tr>"; 
	} 
	echo "</table>"; 
	echo "<a href=newusers.php>New User</a>"; 
}
else
	include('denied.html');
?>
<?php include('footer.html'); ?>