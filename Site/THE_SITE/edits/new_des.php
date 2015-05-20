<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	if (!mysql_connect($servername, $username, $password)) {
		exit;
	}else{
	}
	mysql_select_db('iosyf') or die('Could not select database');
	
	$result = mysql_query("SELECT username FROM users,makers_of_the_vn WHERE IDVN = '".$_POST['UID']."' AND IDusers=UID");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}else{
		$row = mysql_fetch_array($result);
		if (!$row[0]==$_SESSION["us"]){
			echo "ERROR: YOU CAN NOT CHANGE A VN THAT DOES NOT BELONG TO YOU!";
		}else{ 
			$result = mysql_query("UPDATE VN SET description = '".$_POST['des']."' WHERE UID = '".$_POST['UID']."'");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				echo "NEW DESCRIPTION: \n\n".$_POST['des'];
			}
		}
	}
	//mysql_free_result($result);
	//echo $_POST['des'];
?>