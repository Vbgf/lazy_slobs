<?php/*
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
		
	}*/
	const $upl="./VN/";
    $target=$upl;
	$dir    = $target;
	$files1 = scandir($dir);
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
	}/*
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
	header("Location: http://localhost/SITE2/testing2.php");
?>
