<? 
include('config.php'); 

if($priv == 'Librarian' or $priv == 'Director' or $priv == 'Viewer'){
//User Logging Info
echo "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"105%\">"; 
echo "<tr>"; 
echo "<td><b>ID</b></td>"; 
echo "<td><b>Composer</b></td>"; 
echo "<td><b>Title</b></td>"; 
echo "<td><b>Publisher</b></td>"; 
echo "<td><b>Arranger</b></td>"; 
echo "<td><b>Notes</b></td>"; 
echo "<td><b>Inventoried</b></td>"; 
echo "<td><b>Score Location</b></td>"; 
echo "</tr>"; 
$i = 0;  //row color counter
if($_GET["sort"] == ""){
	echo "Sorting by: ID (Chamber Music excluded)";
	$result = mysql_query("SELECT * FROM `Works` WHERE ID <> 'brass' AND ID <> 'ww' AND ID <> 'sax' ORDER BY CAST(ID AS UNSIGNED)") or trigger_error(mysql_error());
	} 

if($_GET["sort"] == "composer"){
	echo "Sorting by: Composer";
	$result = mysql_query("SELECT * FROM `Works` ORDER BY Composer") or trigger_error(mysql_error());
	} 

if($_GET["sort"] == "title"){
	echo "Sorting by: Title";
	$result = mysql_query("SELECT * FROM `Works` ORDER BY Title") or trigger_error(mysql_error());
	} 

if($_GET["sort"] == "chamber"){
	echo "Sorting by: Chamber Music";
	$result = mysql_query("SELECT * FROM `Works` WHERE ID = 'brass' OR ID = 'sax' OR ID = 'ww'") or trigger_error(mysql_error());
	}
	
echo("<br><br>To search, use your browser's find function.");
while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) 
		{ $row[$key] = stripslashes($value); }
echo "<tr>";
if($i % 2 == 0) {echo "<tr bgcolor='#CCCCCC'>"; }
echo "<td valign='top'>" . nl2br( $row['ID']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Composer']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Title']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Publisher']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Arranger']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Notes']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Inventoried']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Score_Location']) . "</td>";  
if($priv != 'Viewer'){
echo "<td valign='top'><a href=edit.php?uid={$row['uid']}>Edit</a></td>";
echo "<td valign='top'><a href=delete.php?uid={$row['uid']} id='delete'>Delete</a></td>";
echo "</tr>";
}
$i++;
} 
echo "</table>"; 
}
else
include('denied.html');
include('footer.html'); 
?>
