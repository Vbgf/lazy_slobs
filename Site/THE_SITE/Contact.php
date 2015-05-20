<!DOCTYPE html>
<html>
	<head>
		<title>HOME</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<link rel="stylesheet" type="text/css" href="VN/VN.css">
	</head>
	
	<body background="Pictures/bg.jpg">
		<div id = "MAIN5" style="padding-bottom:1px;height:719px;border:black;border-radius:13px;">
			<?php
				//java -jar Javatopia3-0.1.1-SNAPSHOT.jar
				session_start();
				include "menus/menu.php";
				echo '
				<br>
				<br>
				<br>
				<h1>MAKERS OF THE SITE:</h1>
				<h2>Thank those guys, for without them, this site wouldn\'t exist!</h2>
				<h3>Iosyf Saleh - Hideyoshi1</h3>
				<h5>iluvanime@abv.bg</h5>
				<br>
				<h3>Dimitar Andreev - Piecesout</h3>
				<h5>dimitarninjalolggwp@gmail.com</h5>
				<br>
				<h3>Vasil Kolev - Vbgf</h3>
				<h5>somerandommail@somewhere.com</h5>
				';
			//$img1 = 'Pictures/left.jpg';
			//$img2 = 'Pictures/right.img';
			//if(file_exists($img1) && file_exists($img2)){
			//	echo "WHAT THE FUCK!";
			//	echo'<img src="Pictures/left.jpg" alt="BLAH" id="img_left">';
			//	echo'<img src="Pictures/right.jpg" alt="BLAH" id="img_left">';		
			//}
		?>
			<img src="Pictures/left.jpg" id="img_left">
			<img src="Pictures/right.jpg" id="img_right">
		</div>
	<body>
</html>