<?php
	session_start();
	if ((isset($_SESSION["us"]))){
	}
	else
	{
		header('Location: Blog.php');
	}
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
	$result = mysql_query("SELECT UID FROM users WHERE username = '".$_SESSION["us"]."'");
	if (!$result){
		echo "An error has occurred";
	}else{
		$row = mysql_fetch_row($result);
		if ($row[0]==""){
			exit;
		}else
			$result = mysql_query("INSERT INTO faq (IDusers, topic) VALUES ('".$row[0]."','".$_POST['comment']."')");
	}
	header('Location: ./Blog.php');
?>