<?php include ('header.html');	?>
<div id="container">
<div id="content">
<?php
	
	//SIMPLESAMLPHP/SHIB Stuff
	require_once('/var/simplesamlphp/lib/_autoload.php');
	$as = new SimpleSAML_Auth_Simple('default-sp');
	$as->requireAuth();
	$attributes = $as->getAttributes();
	$simplesaml_NetID = $attributes['urn:oid:0.9.2342.19200300.100.1.1'][0];
	$simplesaml_RN = $attributes['urn:oid:2.5.4.3'][0];


	// connect to db
	include('dbconnect.php');

	//CUWEBAUTH STUFF	
	//$netid = $_SERVER['REMOTE_USER']; 
	//$name = $_SERVER['CUWA_FULL_USER'];
	//$netid = 'cpj6'; 
	$netid = $simplesaml_NetID;
	$name = $simplesaml_RN;
	$priv = mysql_query("SELECT privs FROM `Users` WHERE NetID='$netid'") or trigger_error(mysql_error());
	$privs = mysql_fetch_array($priv); 
	$priv = $privs[0];
	if($priv == "")
		$priv = none;
	
	//Let's pull the NetID from LDAP (and other attributed in the future, if desired.)
/*	$ds=ldap_connect("directory.cornell.edu"); 
	if ($ds) {  
        $r=ldap_bind($ds);  
        $sr=ldap_search($ds,"ou=People,o=Cornell University,c=US","uid=$netid"); 
        $info = ldap_get_entries($ds, $sr); 
        $entry = ldap_first_entry($ds, $sr); 
        if ($attrs = ldap_get_attributes($ds, $entry)) { 
        		$name = $info[0]["cn"][0]; */
   /*           echo $attrs["count"]." attributes held for this entry.<br>"; 
                echo "Uid: ".$info[0]["uid"][0]."<br>"; 
                echo "CN: ".$info[0]["cn"][0]."<br>"; 
                echo "Display Name: ".$info[0]["displayname"][0]."<br>"; 
                echo "Given Name: ".$info[0]["givenname"][0]."<br>"; 
                echo "SN: ".$info[0]["sn"][0]."<br>"; 
                echo "Principal name: ".$info[0]["edupersonprincipalname"][0]."<br>"; 
                echo "Netid: ".$info[0]["cornelledunetid"][0]."<br>"; 
                echo "Create timestamp: ".$info[0]["createtimestamp"][0]."<br>"; 
                echo "Mail routing: ".$info[0]["mailroutingaddress"][0]."<br>"; 
                echo "Mail: ".$info[0]["mail"][0]."<br>"; 
                echo "Middle name: ".$info[0]["cornelledumiddlename"][0]."<br>"; 
                echo "FAX: ".$info[0]["facsimiletelephonenumber"][0]."<br>"; 
                echo "Campus address: ".$info[0]["cornelleducampusaddress"][0]."<br>"; 
                echo "Campus phone: ".$info[0]["cornelleducampusphone"][0]."<br>"; 
                echo "Department name 1: ".$info[0]["cornelledudeptname1"][0]."<br>"; 
                echo "Department name 2: ".$info[0]["cornelledudeptname2"][0]."<br>"; 
                echo "University title 1:".$info[0]["cornelleduunivtitle1"][0]."<br>"; 
                echo "University title 2: ".$info[0]["cornelleduunivtitle2"][0]."<br>"; 
                echo "Home phone: ".$info[0]["homephone"][0]."<br>"; 
                echo "Home postal address: ".$info[0]["homepostaladdress"][0]."<br>"; 
                echo "Type: ".$info[0]["cornelledutype"][0]."<br>"; 
                echo "Primary affiliation: ".$info[0]["edupersonprimaryaffiliation"][0]."<br>"; 
                echo "Regular/Temp 1: ".$info[0]["cornelleduregtemp1"][0]."<br>"; 
                echo "Regular/Temp 2: ".$info[0]["cornelleduregtemp2"][0]."<br>"; 
                echo "Modify timestamp: ".$info[0]["modifytimestamp"][0]."<br>"; 
                echo "Nickname: ".$info[0]["edupersonnickname"][0]."<br>"; 
                echo "Labeled URI: ".$info[0]["labeleduri"][0]."<br>"; 
                echo "Description (project): ".$info[0]["description"][0]."<br>"; 
                */
     //   } 
//s} 
	
?>
