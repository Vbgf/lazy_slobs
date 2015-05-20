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
	$warnings_list="";
	$check=0;
	#$input_name = $_POST["fname"];
	#$input_name = mysql_real_escape_string($input_name);
	if (preg_match('/[^A-Za-z0-9]/', $_POST["fname"]))
	{
		$warnings_list=$warnings_list."<p>*The first name should contains only english letters & digits</p>";
		$check=1;
	}
	if (preg_match('/[^A-Za-z0-9]/', $_POST["lname"]))
	{
		$warnings_list=$warnings_list."<p>*The last name should contains only english letters & digits</p>";
		$check=1;
	}
	if ((strlen($_POST["uname"]) > 12) || (strlen($_POST["uname"]) < 5))
	{
		$warnings_list=$warnings_list."<p>*Username is too long/short(max 12 letters/digits and min 5)</p>";
		$check=1;
	}
	if (preg_match('/[^A-Za-z0-9]/', $_POST["uname"]))
	{
		$warnings_list=$warnings_list."<p>*The username should contains only english letters & digits</p>";
		$check=1;
	}
	if ($_POST["pname"] != $_POST["p2name"])
	{
		$warnings_list=$warnings_list."<p>*Passwords do not match</p>";
		$check=1;
	}
	if ((strlen($_POST["pname"]) > 24) || (strlen($_POST["pname"]) < 5))
	{
		$warnings_list=$warnings_list."<p>*Password is too long/short(max 24 letters/digits and min 5)</p>";
		$check=1;
	}
	$result = mysql_query("SELECT * FROM users WHERE username = '".$_POST["uname"]."'");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: 1' . mysql_error();
		exit;
	}
	$row = mysql_fetch_row($result);
	if ($row[0]!=""){
		$warnings_list=$warnings_list."<p>*Username already used</p>";
		$check=1;
	}
	if (!filter_var($_POST["ename"], FILTER_VALIDATE_EMAIL)) {
		$warnings_list=$warnings_list."<p>*Invalid e-mail</p>";
		$check=1;
	}
	if ($_POST["ename"] != $_POST["e2name"])
	{
		$warnings_list=$warnings_list."<p>*Emails do not match</p>";
		$check=1;
	}
	$result = mysql_query("SELECT * FROM users WHERE email = '".$_POST["ename"]."'");// VERY IMPORTANT
	if (!$result) {
		echo 'Could not run query: 2' . mysql_error();
		exit;
	}
	$row = mysql_fetch_row($result);
	if ($row[0]!=""){
		$warnings_list=$warnings_list."<p>*e-mail already used</p>";
		$check=1;
	}
	if ($check<>1)
	{
		session_start();
		if(isset($_SESSION["warnings_list"]))
			unset($_SESSION["warnings_list"]);
		$First=$_POST["fname"];
		$Last=$_POST["lname"];
		$User=$_POST["uname"];
		$Pass=password_hash($_POST["pname"], PASSWORD_BCRYPT);
		$Email=$_POST["ename"];
		
		$result = mysql_query("INSERT INTO users (FN, LN, username, password, email)
		VALUES ('$First', '$Last', '$User', '$Pass', '$Email')");
		if ($result) {
			mysql_free_result($result);
			header('Location: Blog.php');
		} else {
			echo 'Could not run query: 3' . mysql_error();
			exit;
		}
	}
	else
	{
		mysql_free_result($result);
		session_start();
		$_SESSION["warnings_list"]=$warnings_list;
		header('Location: Register.php');
	}
?>