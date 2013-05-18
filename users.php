<? 
include('config.php'); 
if($priv == 'Director'){
echo "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"50%\">"; 
echo "<tr>"; 
//echo "<td><b>ID</b></td>"; 
echo "<td><b>NetID</b></td>"; 
echo "<td><b>Privilege</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `Users` ORDER BY privs") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
if($i % 2 == 0) {echo "<tr bgcolor='#CCCCCC'>"; }
//echo "<td valign='top'>" . nl2br( $row['ID']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NetID']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['privs']) . "</td>";  
echo "<td valign='top'><a href=deleteusers.php?ID={$row['ID']}>Delete</a></td> "; 
echo "</tr>"; 
$i++;
} 
echo "</table>"; 
echo "<a href=newusers.php>New User</a>"; 
}
else
include('denied.html');
?>
<?php include('footer.html'); ?>