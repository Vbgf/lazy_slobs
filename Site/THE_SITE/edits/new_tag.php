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
			$tags = strtolower($_POST['tag']);
			$tags = explode(";", $tags);
			$tags = array_unique($tags);
			$result = mysql_query("DELETE FROM vnxtags WHERE IDVN= '".$_POST['UID']."'");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				echo "CURRENT TAGS:\n";
				foreach ($tags as $tag){
					$result = mysql_query('SELECT UID FROM tags WHERE "'.$tag.'"=name');// VERY IMPORTANT
					if (!$result) {
						echo 'Could not run query: ' . mysql_error();
						exit;
					}else{
						$row = mysql_fetch_array($result);
						if ($row[0] == ""){
							print "\nNo such tag: '".$tag."' found.";
						}else{
							print "\n".$tag." is in the db. ";
							
							$result = mysql_query("INSERT INTO vnxtags (IDVN, IDtags)
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
					
				//echo "NEW TAG: \n\n".$_POST['title'];
			}
		}
	}
?>