<?php

include('dbconnect.php');

//Code based off of:
//| mysqldump.php
//+----------------------------------------------------+
//| Copyright 2006 Huang Kai
//| http://atutility.com/

header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="'.$mysql_database."_librarydatabase".date('YmdHis').'.sql"');

_mysqldump($mysql_database);

function _mysqldump($mysql_database)
{
	$sql="show tables;";
	$result= mysql_query($sql);
	if( $result)
	{
		while($row= mysql_fetch_row($result))
		{
			_mysqldump_table_structure($row[0]);
			_mysqldump_table_data($row[0]);
		}
	}
	else
	{
		echo "/* no tables in $mysql_database */\n";
	}
	mysql_free_result($result);
}

function _mysqldump_table_structure($table)
{
	echo "/* Table structure for table `$table` */\n";
	echo "DROP TABLE IF EXISTS `$table`;\n\n";
	$sql="show create table `$table`; ";
	$result=mysql_query($sql);
	if( $result)
	{
		if($row= mysql_fetch_assoc($result))
		{
			echo $row['Create Table'].";\n\n";
		}
		mysql_free_result($result);
	}
}

function _mysqldump_table_data($table)
{

	$sql="select * from `$table`;";
	$result=mysql_query($sql);
	if( $result)
	{
		$num_rows= mysql_num_rows($result);
		$num_fields= mysql_num_fields($result);

		if( $num_rows > 0)
		{
			echo "/* dumping data for table `$table` */\n";

			$field_type=array();
			$i=0;
			while( $i < $num_fields)
			{
				$meta= mysql_fetch_field($result, $i);
				array_push($field_type, $meta->type);
				$i++;
			}

			echo "insert into `$table` values\n";
			$index=0;
			while( $row= mysql_fetch_row($result))
			{
				echo "(";
				for( $i=0; $i < $num_fields; $i++)
				{
					if( is_null( $row[$i]))
						echo "null";
					else
					{
						switch( $field_type[$i])
						{
						case 'int':
							echo $row[$i];
							break;
						case 'string':
						case 'blob' :
						default:
							echo "'".mysql_real_escape_string($row[$i])."'";

						}
					}
					if( $i < $num_fields-1)
						echo ",";
				}
				echo ")";

				if( $index < $num_rows-1)
					echo ",";
				else
					echo ";";
				echo "\n";

				$index++;
			}
		}
	}
	mysql_free_result($result);
	echo "\n";
}


?>