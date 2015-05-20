<?php
	session_start();
	unset ($_SESSION["us"]);
	unset ($_SESSION["pass"]);
	header('Location: ../Blog.php');
?>
