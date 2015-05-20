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
			$languages = strtolower($_POST['lang']);
			$languages = explode(";", $languages);
			$languages = array_unique($languages);
			$result = mysql_query("DELETE FROM vnxlanguages WHERE IDVN= '".$_POST['UID']."'");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				echo "CURRENT LANGUAGES:\n";
				foreach ($languages as $lang){
					$lang = strtolower($lang);
					$result = mysql_query('SELECT UID FROM languages WHERE "'.$lang.'"=name');// VERY IMPORTANT
					if (!$result) {
						echo 'Could not run query: ' . mysql_error();
						exit;
					}else{
						$row = mysql_fetch_array($result);
						if ($row[0] == ""){
							print "\nNo such language: '".$lang."' found.";
						}else{
							print "\n".$lang." is in the db. ";
							
							$result = mysql_query("INSERT INTO vnxlanguages (IDVN, IDlanguages)
							VALUES ('".$_POST['UID']."','".$row[0]."')");// VERY IMPORTANT
							if (!$result) {
								echo 'But can\'t be added.\n';
								exit;
							}else{
								echo "And has been added.\n";
							}
						}
					}
				}
			}
		}
	}
?>