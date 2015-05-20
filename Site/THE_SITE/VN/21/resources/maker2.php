<?php
	session_start();
	$php = $_SESSION["file"];
	$php = str_replace("/opt/lampp/htdocs/","",$php);
	$file = str_replace('COMS','COMS2',$_SESSION["file"]);
	$file = str_replace(".php",".txt",$file);
	date_default_timezone_set('Europe/Bulgaria');
	$date = date('m/d/Y h:i:s a', time());
	$file_data = $_SESSION["us"]."\t".$date."\t".$_POST["comment"]."\n";
	$file_data .= file_get_contents($file);
	file_put_contents($file, $file_data);
	header('Location: '.'../../'.$php);
?>
