<?php
include('config.php'); 
if($priv == 'Director' or $priv == 'Librarian'):
?>
<h2>Database Backup</h2>

<!-- <i>Save the file that loads to your local  using your browser's save function.  If a restoration is needed, forward the attached file to the webmaster.</i>	-->

<p><FORM>
<INPUT TYPE="BUTTON" VALUE="Download" ONCLICK="window.location.href='backup.php'"> 
</FORM></p>
<h2>Last 50 Executed Queries</h2>
<?php
echo "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"105%\">"; 
echo "<tr>"; 
echo "<td><b>Event Time</b></td>"; 
echo "<td><b>Argument</b></td>"; 
echo "</tr>"; 
$i = 0;  //row color counter
mysql_select_db('mysql');
$result = mysql_query("SELECT * FROM `general_log` WHERE `user_host` LIKE '%cuwinds%' AND `command_type` LIKE 'Query' ORDER BY `general_log`.`event_time` DESC LIMIT 0, 50"); ?>
<i><p> If no recent queries are shown, ask your server administrator to restart the MySQL general log by issuing: SET GLOBAL log_output = 'TABLE'; and SET GLOBAL general_log = 'ON'; </i></p>
<?php while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) 
		{ $row[$key] = stripslashes($value); }
echo "<tr>";
if($i % 2 == 0) {echo "<tr bgcolor='#CCCCCC'>"; }
echo "<td valign='top'>" . nl2br( $row['event_time']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['argument']) . "</td>";  
echo "</tr>";
$i++;
} 
echo "</table>"; 
mysql_select_db('cuwinds');
?>
<h2>View All Tables</h2>
<?php
/****************
* File: displaytables.php
* Date: 1.13.2009
* Author: design1online.com, LLC
* Purpose: display all table structure for a specific database
****************/

//loop to show all the tables and fields
$loop = mysql_query("SHOW tables FROM cuwinds")
or die ('cannot select tables');

while($table = mysql_fetch_array($loop))
{

    echo "
        <table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"75%\">
            <tr bgcolor=\"#666666\">
                <td colspan=\"5\" align=\"center\"><b><font color=\"#FFFFFF\">" . $table[0] . "</font></td>
            </tr>
            <tr>
                <td>Field</td>
                <td>Type</td>
                <td>Key</td>
                <td>Default</td>
                <td>Extra</td>
            </tr>";

    $i = 0; //row counter
    $row = mysql_query("SHOW columns FROM " . $table[0])
    or die ('cannot select table fields');

    while ($col = mysql_fetch_array($row))
    {
        echo "<tr";

        if ($i % 2 == 0)
            echo " bgcolor=\"#CCCCCC\"";

        echo ">
            <td>" . $col[0] . "</td>
            <td>" . $col[1] . "</td>
            <td>" . $col[2] . "</td>
            <td>" . $col[3] . "</td>
            <td>" . $col[4] . "</td>
        </tr>";

        $i++;
    } //end row loop

    echo "</table><br/><br/>";
} //end table loop
?>
<h2>Bugs</h2>
	<ul>Import data</ul>
<h2>View PHP Info</h2>
<INPUT TYPE="BUTTON" VALUE="Info" ONCLICK="window.location.href='phpinfo.php'"> 
<?php endif;
if (!($priv == 'Director' or $priv == 'Librarian')){
include('denied.html');}
include('footer.html'); 
 ?>
