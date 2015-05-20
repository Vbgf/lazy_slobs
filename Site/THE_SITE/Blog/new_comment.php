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
		$result2 = mysql_query('SELECT UID FROM faqcomments WHERE comment ="'.$_POST['comment'].'"');
		if(!$result2){
			echo 'Could not run query: ' . mysql_error();
			exit;
		}else{
			$row2 = mysql_fetch_row($result2);
			if($row2[0]==""){
				$result = mysql_query("INSERT INTO faqcomments (comment) VALUES ('".$_POST['comment']."')");
				if(!$result){
					echo 'Could not run query: ' . mysql_error();
					exit;
				}else{
					$Comment_ID = mysql_insert_id();
					$result = mysql_query("INSERT INTO faqxcomments (IDfaq, IDuser, IDcomment) VALUES ('".$_POST['FAQ_ID']."','".$row[0]."','".$Comment_ID."')");
					if (!$result){
						echo 'Could not run query: ' . mysql_error();
						exit;
					}else{
						header('Location: ./Blog.php'); 
					}
				}
			}else{
				$result = mysql_query("INSERT INTO faqxcomments (IDfaq, IDuser, IDcomment) VALUES ('".$_POST['FAQ_ID']."','".$row[0]."','".$row2[0]."')");
				if (!$result){
					echo 'Could not run query: ' . mysql_error();
					exit;
				}else{
					header('Location: ./Blog.php'); 
				}
			}
		}
	}
?>