<?php
$servername = "localhost";
			$username = "root";
			$password = "";
			$i = 0;
			if (!mysql_connect($servername, $username, $password)) {
				//echo 'Could not connect to mysql<br>';
				exit;
			}else{
				//echo 'connected to '.$servername.'<br>';
			}
			mysql_select_db('iosyf') or die('Could not select database');
			$page = ($_SESSION["page"]);
			$result = mysql_query("INSERT INTO makers_of_the_vn (IDusers, IDVN)
				VALUES ('15','1')");// VERY IMPORTANT
				if (!$result) {
					echo ' can\'t be added.\n';
					exit;
				}else{
					echo " has been added.\n";
				}
?>