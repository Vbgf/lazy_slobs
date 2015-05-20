</html>
<head>

</head>
<body>
<?php
	echo '<p></p>';
	session_start();
	$php = $_SESSION["file"];
	$php = str_replace("C:\\xampp\\htdocs\\","http://localhost/",$php);
	$php = str_replace("\\","/",$php);
	$file = str_replace('COMS','COMS2',$_SESSION["file"]);
	$file = str_replace(".php",".txt",$file);
	$date = date('m/d/Y h:i:s a', time());
	$file_data = $_SESSION["us"]."\t".$date."\t".$_POST["comment"]."\n";
	$file_data .= file_get_contents($file);
	file_put_contents($file, $file_data);
	$_SESSION["site"]=$php;
	echo $php;
	header('Location:'.$php);
?>
<body>
</html>