<?php
	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$i = 0;
	if (preg_match('/[^a-z\d]/i', $_POST["a"]))
	{
		echo "<p>*The username should contains only english letters & digits</p>";
		exit;
	}
	if (preg_match('/[^a-z\d]/i', $_POST["b"]))
	{
		echo "\n <p>*The password should contains only english letters & digits</p>";
		exit;
	}
	if (!mysql_connect($servername, $username, $password)) {
		//echo 'Could not connect to mysql<br>';
		exit;
	}else{
		//echo 'connected to '.$servername.'<br>';
	}

	mysql_select_db('iosyf') or die('Could not select database');
//Uploader
//Ranking
//Raiting
	$result = mysql_query("SELECT * FROM users WHERE username = '".$_POST["a"]."'");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}
	$row = mysql_fetch_row($result);
	if ($row[0]==""){
		$_SESSION["retry"] = 1;
		echo 'Invalid username or password';
		header('Location: Blog.php');
	}else{
		if (isset($_SESSION["retry"]))
			unset($_SESSION["retry"]);
		if (password_verify($_POST["b"], $row[4])) {
			$_SESSION["us"]= $_POST["a"];
			$_SESSION["pass"]= $_POST["b"];
			header('Location: index.php');
		} else {
			$_SESSION["retry"] = 1;
			echo 'Invalid username or password';
			header('Location: Blog.php');
		}
	}
	//$result = mysql_query('SELECT * from users');
//	if (!$result) {
		//die('Invalid query: ' . mysql_error());
	//}else{
//		while ($row = mysql_fetch_assoc($result)) {
			//echo "Table:";
		//	$row = array_values($row);
			//for ($i=0;$i<count($row);++$i){
				//echo $row[$i]."\n<br>";
		//	}
		//}
	//}

	//$result = mysql_query("SELECT * FROM users WHERE UID ='5'");
	//echo $result;
	//while ($row = mysql_fetch_array($result)) 
	//{
		//$text = $row[''];
		//echo "<h1>".$row['UID'].' '.$row['FN'].' '.$row['LN']."</h1>";
	//}
	//echo "<h1>".$text."</h1>";

	mysql_free_result($result);
?>