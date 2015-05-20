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
	
	$result = mysql_query("SELECT UID FROM users,makers_of_the_vn WHERE IDVN = '".$_POST['UID']."' AND IDusers=UID and username='".$_SESSION["us"]."'");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}else{
		$row = mysql_fetch_array($result);
		if ($row[0]==""){
			echo "ERROR: YOU CAN NOT CHANGE A VN THAT DOES NOT BELONG TO YOU!".$_SESSION["us"]."\n";
		}else{
			$art = explode(";", $_POST['art']);
			$art = array_unique($art);
			$result = mysql_query("DELETE FROM makers_of_the_vn WHERE IDVN= '".$_POST['UID']."'");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				echo "CURRENT ARTISTS:\n\n";
				$result = mysql_query("INSERT INTO makers_of_the_vn (IDusers, IDVN)
				VALUES ('".$row[0]."','".$_POST['UID']."')");
				if (!$result) {
					echo 'Could not run query: ' . mysql_error();
					exit;
				}else{
					echo "You have been added.\n";
				}
				foreach ($art as $user){
					$result = mysql_query('SELECT UID FROM users WHERE "'.$user.'"=username');// VERY IMPORTANT
					if (!$result) {
						echo 'Could not run query: ' . mysql_error();
						exit;
					}else{
						$row = mysql_fetch_array($result);
						if ($row[0] == ""){
							print "\nNo such user: '".$user."' found.";
						}else{
							print "\n".$user." is in the db. ";
							
							$result = mysql_query("INSERT INTO makers_of_the_vn (IDusers, IDVN)
							VALUES ('".$row[0]."','".$_POST['UID']."')");// VERY IMPORTANT
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