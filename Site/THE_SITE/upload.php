<?php
	session_start();
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
	if (!$_POST["UID"]){
		$result = mysql_query("INSERT INTO VN (name) VALUES ('".$_POST["details_1"]."')");// VERY IMPORTANT
		if (!$result) {
			echo 'Could not run query: 1' . mysql_error();
			exit;
		}
		else{
			
		}
	}
	$result = mysql_query("Select DISTINCT UID From VN WHERE '".$_POST["details_1"]."' = name ORDER BY date_last_modified DESC");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: 1.1' . mysql_error();
		exit;
	}
	else{
		$row = mysql_fetch_array($result);
		$UID=$row['UID'];
		$upl= "./VN/".$row['UID']."/";
		$target=$upl;
		$dir = $target;
		if (mkdir($dir)){
			echo "FILE DID NOT EXIST";
		}else{
			echo "FILE EXIST";
			if (!$files1 = scandir($dir)){
				echo "COULD NOT OPEN FILE";
				exit;
			}
		}
		
		if (strlen($_FILES['upload1']['name'][0]) != 0){
			if (in_array("resources", $files1)) {
				echo "<p>Deleting previous resources<p>";
				$files = glob($target."resources/*"); // get all file names
				foreach($files as $file){ // iterate files
					if(is_file($file)){
						echo "<p> Deleting ".$file."</p>";
						unlink($file); // delete file
					}
				}
				rmdir($target."resources/");
				mkdir($target."resources/", 0700);
				echo "<p>Got resources</p>";
			}else{
				mkdir($target."resources/", 0700);
				echo "<p>added folder \"resources\"</p>";
			}
			$target.="resources/";
			$count=0;
			foreach ($_FILES['upload1']['name'] as $filename) 
			{
				$temp=$target;
				$tmp=$_FILES['upload1']['tmp_name'][$count];
				$count=$count + 1;
				$temp=$temp.basename($filename);
				if (move_uploaded_file($tmp,$temp)){
					echo "<p>Uploaded ".$_FILES['upload1']['name'][$count-1]." to folder ".$temp."</p>";
				}else{
					echo "<p>Failed to upload ".$tmp." to folder ".$temp."</p>";
				}
				$temp='';
				$tmp='';
			}
			$target=$upl;
		}
		
		if (strlen($_FILES['upload2']['name']) != 0){
			if (in_array("script", $files1)) {
				echo "<p>Deleting previous script<p>";
				$files = glob($target."script/*"); // get all file names
				foreach($files as $file){ // iterate files
					if(is_file($file)){
						echo "<p> Deleting ".$file."</p>";
						unlink($file); // delete file
					}
				}
				rmdir($target."script/");
				mkdir($target."script/", 0700);
				echo "<p>Got script</p>";
			}else{
				mkdir($target."script/", 0700);
				echo "<p>added folder \"script\"</p>";
			}
			$target.="script/";
			$temp=$target;
			$tmp=$_FILES['upload2']['tmp_name'];
			$temp=$temp.basename($_FILES['upload2']['name']);
			if (move_uploaded_file($tmp,$temp)){
				echo "<p>Uploaded ".$tmp." to folder ".$temp."</p>";
			}else{
				echo "<p>Failed to upload ".$tmp." to folder ".$temp."</p>";
			}
			$temp='';
			$tmp='';
			$target=$upl;
		}
		
		if (strlen($_FILES['upload3']['name'][0]) != 0){
			if (in_array("style", $files1)) {
				echo "<p>Deleting previous style<p>";
				$files = glob($target."style/*"); // get all file names
				foreach($files as $file){ // iterate files
					if(is_file($file)){
						echo "<p> Deleting ".$file."</p>";
						unlink($file); // delete file
					}
				}
				rmdir($target."style/");
				mkdir($target."style/", 0700);
				echo "<p>Got style</p>";
			}else{
				mkdir($target."style/", 0700);
				echo "<p>added folder \"style\"</p>";
			}
			
			$target.="style/";
			$count=0;
			foreach ($_FILES['upload3']['name'] as $filename) 
			{
				$temp=$target;
				$tmp=$_FILES['upload3']['tmp_name'][$count];
				$count=$count + 1;
				$temp=$temp.basename($filename);
				if (move_uploaded_file($tmp,$temp)){
					echo "<p>Uploaded ".$_FILES['upload3']['name'][$count-1]." to folder ".$temp."</p>";
				}else{
					echo "<p>Failed to upload ".$tmp." to folder ".$temp."</p>";
				}
				$temp='';
				$tmp='';
			}
			$target=$upl;
		}
		
		if (isset ($_POST["art"])){
			$result = mysql_query("SELECT UID FROM users WHERE username= '".$_SESSION["us"]."'");
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				$row = mysql_fetch_array($result);
				$User_id=$row[0];
			}
			$art = explode(";", $_POST['art']);
			$art = array_unique($art);
			$result = mysql_query("DELETE FROM makers_of_the_vn WHERE IDVN= '".$UID."'");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				echo "CURRENT ARTISTS:\n\n";
				$result = mysql_query("INSERT INTO makers_of_the_vn (IDusers, IDVN)
				VALUES ('".$User_id."','".$UID."')");
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
							VALUES ('".$row[0]."','".$UID."')");// VERY IMPORTANT
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
		}else{
			$result = mysql_query("INSERT INTO makers_of_the_vn (IDusers, IDVN)
			VALUES ('".$row[0]."','".$UID."')");
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}else{
				echo "You have been added.\n";
			}
		}
		if (isset($_POST["tag"])){
			$tags = strtolower($_POST['tag']);
			$tags = explode(";", $tags);
			$tags = array_unique($tags);
			$result = mysql_query("DELETE FROM vnxtags WHERE IDVN= '".$UID."'");// VERY IMPORTANT
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
							VALUES ('".$UID."','".$row[0]."')");// VERY IMPORTANT
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
		//include('./edits/price.php');
		
		//echo $_POST["details_1"]."<br>"; title
		//echo $_POST["details_2"]."<br>";
		//echo $_POST["details_3"]."<br>";
		//echo $_POST["details_4"]."<br>";
	}

	/*
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
	$result = mysql_query("
INSERT INTO VN (name,description)
VALUES ('qqqqqqqq132qq','LAZY')
	");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: 1' . mysql_error();
		exit;
	}
	else{
		
	}
	*/
	//header("Location: http://localhost/SITE2/testing2.php");
?>