<?php
	$file_data = "\n";
	$file_data .= file_get_contents('COMMENTS');
	file_put_contents('COMMENTS', $file_data);
	
	session_start();
	$file_data = file_get_contents("COMMENTS");
	$file_data = str_replace("\n".$_SESSION["comment"]."\n","\n",$file_data);
	$fp = fopen('COMMENTS', 'w');
	fwrite($fp,$file_data);
	header('Location: http://localhost/SITE/maker.php');
	fclose ($fp);
	
?>
