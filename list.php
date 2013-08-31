<? 
include('config.php'); 
if($priv == 'Librarian' or $priv == 'Director' or $priv == 'Viewer'){


//User Logging Info
  	echo "<table id='results' class='table table-striped table-bordered'>"; 
	echo "<thead>"; 
	echo "<td><b>ID</b></td>"; 
	echo "<td><b>Composer</b></td>"; 
	echo "<td><b>Title</b></td>"; 
	echo "<td><b>Publisher</b></td>"; 
	echo "<td><b>Arranger</b></td>"; 
	echo "<td><b>Notes</b></td>"; 
	echo "<td><b>Inventoried</b></td>"; 
	echo "<td><b>Score Location</b></td>"; 
	
	if($priv != 'Viewer'){
		echo "<td><b>Edit</b></td>"; 
		echo "<td><b>Delete</b></td>"; 
	}
	echo "</thead>"; 
	if($_GET["sort"] == "" && $_GET["page"] == "" && !isset($_POST["search"])){
		echo "Sorting by: ID (Chamber Music excluded)";
		$result = mysql_query("SELECT * FROM `Works` WHERE ID <> 'brass' AND ID <> 'ww' AND ID <> 'sax' ORDER BY CAST(ID AS UNSIGNED) LIMIT 100") or trigger_error(mysql_error());
		} 

	if($_GET["sort"] == "" && $_GET["page"] != "" && !isset($_POST["search"])){
		$page = $_GET["page"];
		$page2 = $page * 100;
		echo "Sorting by: ID (Chamber Music excluded)";
		$result = mysql_query("SELECT * FROM `Works` WHERE ID <> 'brass' AND ID <> 'ww' AND ID <> 'sax' ORDER BY CAST(ID AS UNSIGNED) LIMIT $page2, 100") or trigger_error(mysql_error());
		} 


	if($_GET["sort"] == "" && isset($_POST["search"])){
		$search = $_POST['search'];	
		echo "Search Results for: $search";
		$result = mysql_query("SELECT * FROM `Works` WHERE title LIKE '%$search%' or composer LIKE '%$search%' or id = '$search' or publisher LIKE '%$search%' or arranger LIKE '%$search%' ORDER BY CAST(ID AS UNSIGNED)") or trigger_error(mysql_error());
		} 

	
	if($_GET["sort"] == "composer" && $_GET["page"] == ""){
		echo "Sorting by: Composer";
		$result = mysql_query("SELECT * FROM `Works` ORDER BY Composer LIMIT 100") or trigger_error(mysql_error());
		} 

	if($_GET["sort"] == "composer" && $_GET["page"] != ""){
		$page = $_GET["page"];
		$page2 = $page * 100;
		echo "Sorting by: Composer";
		$result = mysql_query("SELECT * FROM `Works` ORDER BY Composer LIMIT $page2, 100") or trigger_error(mysql_error());
		} 

	
	if($_GET["sort"] == "title" && $_GET["page"] == ""){
		echo "Sorting by: Title";
		$result = mysql_query("SELECT * FROM `Works` ORDER BY Title LIMIT 100") or trigger_error(mysql_error());
		} 

	if($_GET["sort"] == "title" && $_GET["page"] != ""){
		$page = $_GET["page"];
		$page2 = $page * 100;
		echo "Sorting by: Title";
		$result = mysql_query("SELECT * FROM `Works` ORDER BY Title LIMIT $page2, 100") or trigger_error(mysql_error());
		} 
	
	if($_GET["sort"] == "chamber"){
		echo "Sorting by: Chamber Music";
		$result = mysql_query("SELECT * FROM `Works` WHERE ID = 'brass' OR ID = 'sax' OR ID = 'ww'") or trigger_error(mysql_error());
		}
	

	echo("<tbody>");
	while($row = mysql_fetch_array($result)){ 
		foreach($row AS $key => $value){ 
			$row[$key] = stripslashes($value); 
		}
	echo "<tr>";
	
	echo "<td>" . nl2br( $row['ID']) . "</td>";  
	echo "<td>" . nl2br( $row['Composer']) . "</td>";  
	echo "<td>" . nl2br( $row['Title']) . "</td>";  
	echo "<td>" . nl2br( $row['Publisher']) . "</td>";  
	echo "<td>" . nl2br( $row['Arranger']) . "</td>";  
	echo "<td>" . nl2br( $row['Notes']) . "</td>";  
	echo "<td>" . nl2br( $row['Inventoried']) . "</td>";  
	echo "<td>" . nl2br( $row['Score_Location']) . "</td>";  
	if($priv != 'Viewer'){
		echo "<td valign='top'><a href=edit.php?uid={$row['uid']}>Edit</a></td>";
		echo"<td valign='top'><div class='popbox'>
				  <a class='open' href='#'>Delete</a>
				    	<div class='collapse'>
					    	<div class='box'>
						    	<div class='arrow'></div>
						    	<div class='arrow-border'></div>
						    		<form action='delete.php?uid={$row['uid']}' method='POST'> 
						    		<input type='hidden' name='aid' value='$aid' />
						    			Are you sure you want to delete this work?
						    			<input type='submit' value='Delete' name='submitdelete'/>
						    		</form>
						    	</div>
						    </div>
						</div>
					</td>";
		echo "</tr>";
	}
} 
echo("</tbody>");
echo "</table>"; 
if($_POST["search"] == "" && !isset($_GET["sort"])){
	if(!isset($page))
		$next = 1;
	else
		$next = $page + 1;
	echo "<a href=list.php?page=$next>Next Page</a>"; 
}
if($_POST["search"] == "" && $_GET["sort"] == "composer"){
	if(!isset($page))
		$next = 1;
	else
		$next = $page + 1;
	echo "<a href=list.php?page=$next&sort=composer>Next Page</a>"; 
}

if($_POST["search"] == "" && $_GET["sort"] == "title"){
	if(!isset($page))
		$next = 1;
	else
		$next = $page + 1;
	echo "<a href=list.php?page=$next&sort=title>Next Page</a>"; 
}

}
else
include('denied.html');
include('footer.html'); 
?>
