<html>
	<head>
		<title>HOME</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<link rel="stylesheet" type="text/css" href="VN/VN.css">
	</head>
	
	<body>
		<div id = "MAIN">
			<?php
				//java -jar Javatopia3-0.1.1-SNAPSHOT.jar
				session_start();
				include "menus/menu.php";
			if (isset($_SESSION["us"])){
				echo '
					<h1 style="position:absolute; margin-left:400px; margin-top:100px">Welcome User</h1>
					<div id="user_all">
				';
			echo '<a href="'.$_SESSION["us"].'">';
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
			$result = mysql_query("SELECT UID FROM users WHERE username='".$_SESSION["us"]."'");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: 1' . mysql_error();
				exit;
			}else{
                echo"<br>";
				while($row = mysql_fetch_array($result)){
                    if(file_exists('users/'.$row["UID"].'/thumbnail.png')){
                        echo('<img id="index_user_image" src="users/'.$row["UID"].'/thumbnail.png"></img></a>');
                    }else{
                        echo('<img id="index_user_image" src="door.jpg"></img></a>');
                    }
                    echo '
                    <div id="user_control_panel">
                        <form action="upload_user_pic.php?argument1=users/'.$row["UID"].'" method="post" enctype="multipart/form-data" style="margin:0px;padding:0px;">
                            <input type="file" name="fileToUpload" id="index_user_pic_browse">
                            <input type="submit" value="Upload Image" name="submit" id="index_user_pic_submit">
                        </form>
                        <form method="get"action="Blog/Logout.php" id="index_user_logout">
                            <button type="submit" id="index_user_logout_button">Logout</button>
                        </form>
                    </div>
                    ';
				}
			}
echo '
<br>
<br>
<br>
<br>
<div id="edit_vns">
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<div id="upl_1">
			Select images, videos and music to upload (videos-mp3):
			<input type="file"  name="upload1[]" id="fileToUpload" webkitdirectory mozdirectory msdirectory odirectory directory multiple>﻿
		</div>
		<div id="upl_2">
			Select style to upload (.css):
			<input type="file"  name="upload2" id="fileToUpload">﻿
		</div>
		<div id="upl_3">
			Select script to upload:
			<input type="file"  name="upload3[]" id="fileToUpload" multiple>﻿
		</div>
		
		<div id="white-board">
		</div>
		<div id="divuru">
			<table>
			<tr>
				<td>
				<div id = "details_1">
				name:
				<input id="inputuru1" name="details_1"></input>
				</div>
				</td>
				<td>
				<div id = "details_2">
				artists:
				<input id="inputuru1" name="details_2"></input>
				</div>
				<td>
			</tr>
			</table>

			<table>
			<tr>
				<td>
				<div id = "details_3">
				tags:
				<input id="inputuru1" name="details_3"></input>
				</div>
				</td>
				<td>
				<div id = "details_4">
				paid:
				<input id="inputuru1" name="details_4"></input>
				</div>
				</td>
			</tr>
			</table>
            <br><br>
			<div id="upl_b">
				<input id="hover_t" class="submit_button" type="submit" value="Upload" name="submit" style="margin-top: 20px;">
				<br>
				<a href="Edit.php" style="color:#4C4C54;text-decoration: none;">
					<div id="editing">
						Edit Old VN
					</div>
				</a>
			</div>
		</div>
	</form>
</div>
<br>
</div>';
			}else
				
echo '
    <br>
    <br>
    <br>
    <br>
    <h1>WELCOME TO THE FIRST SITE FOR ONLINE VISUAL NOVELS</h1>
    <br>
    <br>
    You can play visual novels as well as make, play and test your OWN on a <br><br>NEW<br> Easy to use<br> Programmer-Friendly Language.<br><br><br>Play nice and have fun
';
		?>
		<br>
		<br>
		</div>
	<body>
</html>