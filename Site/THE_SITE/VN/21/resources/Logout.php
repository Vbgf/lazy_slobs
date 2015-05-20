<?php
	session_start();
	unset ($_SESSION["us"]);
	unset ($_SESSION["pass"]);
	header('Location: http://localhost/SITE/Blog.php');
?>
