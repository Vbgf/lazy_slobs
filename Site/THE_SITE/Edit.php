<html>
	<head>
		<title>BLOG</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<link rel="stylesheet" type="js" href="jquery-1.11.2.js">
		<script src="ajax.js">
		</script>
	</head>
	<body>
		<div id ="MAIN">
		<?php
			session_start();
			if ((isset($_SESSION["us"]))){
			}
			else
			{
				header('Location: Blog.php');
			}
			function next_page() {
				$_SESSION["page"]=intval($_GET['page_num']);
			}
			if (isset($_GET['page_num'])) {
				next_page();
			}else
				$_SESSION["page"]=1;
			include "menus/menu.php";
			echo "<br>\n";
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
			$page = ($_SESSION["page"]);
			$result = mysql_query("SELECT VN.UID,users.UID,name,username,description FROM users,makers_of_the_vn,VN WHERE '".$_SESSION["us"]."'=username AND users.UID=IDusers AND IDVN=VN.UID ORDER BY VN.UID DESC LIMIT ".(($page-1)*10).",10");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: 1' . mysql_error();
				exit;
			}
			else{
				echo"<br>\n";
				echo"<br>\n";
/*I am looking for web designers and programmers for doing our project. Our project is all in Japanese and it will have English translation. I need someone who can do Renpy, good UI Designs and also Adobe After Effects to give special effect towards our introduction, and also Remix Audio as well. Our visual novel will be released in Kick Starter Around or Before Auguest. If you can build a website, program Renpy, Adobe After Effect, UI Design, or Remix Audio; Please add me friend request and text me, I will discuss about the questions that you want to get to be answered and start from there!*/
				while($row = mysql_fetch_array($result)){
					echo "<br>\n";
					echo "<div id = 'box'>";
					echo "<div id = 'box2'>";
					echo '<a id="hover_t" onclick="new_title('.$row['0'].')">
						<img src = "Pictures/green_plus.ico" style="position:absolute; height:28px; width:28px; width:28px;right: 330px; top: 0px;">
					</a>';
					echo "<input type='text' id='title".$row['0']."' value='".$row['name']."' style='width:120px;height:28px;'></input>";
					echo "</div>";
					echo "<a href='VN/".$row[0]."'>".
						"<img id='game' src = 'VN/".$row[0]."/resources/thumbnail.png'>".
					"</a>";
					echo "<div id = 'box3' style ='overflow:hidden;margin-top:-196px;'>";
					$id=$row['0'];
					$result2 = mysql_query("SELECT name
					FROM vnxtags,tags
					WHERE IDVN='$id' AND UID=IDtags");// VERY IMPORTANT
					if (!$result2) {
						echo 'Could not run query: 2' . mysql_error();
						exit;
					}
					else{
						echo "     TAGS:";
						while($row2 = mysql_fetch_array($result2)){
							#print_r($row2);
							echo " <a href>".$row2['name']."</a>";
						}
						echo '<a id="hover_t" onclick="new_tag('.$row['0'].')"><div id="plus1">
							<img src = "Pictures/green_plus.ico" id="green">
						</div></a>';
						echo "<input type='text' id='tag".$row['0']."' class='input_edit1'></input>";
						echo"\n\n";
					}
					
					echo "     ARTISTS: ";
					$result2 = mysql_query("SELECT username 
					FROM users,makers_of_the_vn
					WHERE IDVN='$id' AND users.UID=IDusers");// VERY IMPORTANT
					if (!$result2) {
						echo 'Could not run query: 3' . mysql_error();
						exit;
					}
					else{
						while($row2 = mysql_fetch_array($result2)){
							echo " <a href>".$row2['username']."</a>";
						}
						echo '<a id="hover_t" onclick="new_art('.$row['0'].')"><div id="plus2">
							<img src = "Pictures/green_plus.ico" id="green">
						</div></a>';
						echo "<input type='text' id='art".$row['0']."' class='input_edit2'></input>";
						echo"\n\n";
					}
					
					echo "     LANGUAGES: ";
					$result2 = mysql_query("SELECT name 
					FROM languages,vnxlanguages
					WHERE IDVN='$id' AND languages.UID=IDlanguages");// VERY IMPORTANT
					if (!$result2) {
						echo 'Could not run query: 4' . mysql_error();
						exit;
					}
					else{
						while($row2 = mysql_fetch_array($result2)){
							echo " <a href>".$row2['name']."</a>";
						}
						echo '<a id="hover_t" onclick="new_lang('.$row['0'].')"><div id="plus3">
							<img src = "Pictures/green_plus.ico" id="green">
						</div></a>';
						echo "<input type='text' class='input_edit3' id='lang".$row['0']."'></input>";
						echo"\n\n";
					}
					
					echo "     DESCRIPTION: \n";
						echo '<a id="hover_t" onclick="new_des('.$row['0'].')"><div id="plus4">
							<img src = "Pictures/green_plus.ico" id="green">
						</div></a>';
						echo "<p id='textstuff_p'><textarea type='text' id='des".$row['0']."' class='text_stuff'>".$row['description']."</textarea></p>";
					echo "</div>";			
					echo "</div>";                    
					echo '
                    <form action="upload.php" method="post" enctype="multipart/form-data" id="edit_more_options">
						<div id="upl_12">
							Select images, videos and music to upload (videos-mp3):
							<input type="file"  name="upload1[]" id="fileToUpload" webkitdirectory mozdirectory msdirectory odirectory directory multiple>﻿
						</div>
						<div id="upl_22">
							Select style to upload (.css):
							<input type="file"  name="upload2" id="fileToUpload">﻿
						</div>
						<div id="upl_32">
							Select script to upload:
							<input type="file"  name="upload3[]" id="fileToUpload" multiple>﻿
						</div>
						<input type="hidden"  name="UID"  value='.$row['0'].'>﻿</input>
						<input id="hover_t" class="submit_button" type="submit" value="Upload" name="submit" style="margin-top: 20px;">
					</form>';
				}
			}	
			if (!mysql_free_result($result2))
				// MAKE IT SO THAT IT CHECKS IF HE HAS MADE ANY!
				//header('Location: Edit.php?page_num=1');
			echo "<div id='pages'>";
			$result2 = mysql_query("SELECT COUNT(*) FROM VN;");
			if (!$result2) {
				echo 'Could not run query: 5' . mysql_error();
				exit;
			}
			else{
				echo "<br>";
				echo "<div id='all_buttons'>";
				$row = mysql_fetch_array($result2);
				$row[0] = intval((int)$row[0])/10; 
				if ($page<5){
					$page=1;
				}else{
					$page-=3;
				}
				for ($counter=1;;$counter+=1, $page++){
					if ($page==$_SESSION["page"]){
						echo "<a href='Edit.php?page_num=".$page."' style='color:orange; text-decoration:none;'><div id='page_button'>".$page."</div></a>";
					}else{
						echo "<a href='Edit.php?page_num=".$page."' style='color:red; text-decoration:none;'><div id='page_button'>".$page."</div></a>";
					}
					if (($counter>=7) || ($page>=$row[0])){
						break;
					}
				}
				echo "</div>";
			}
			echo "</div>";
			mysql_free_result($result);
		?>
		</div>
	</body>
	<script>
		function new_des(UID){
			$.ajax({
				url: 'edits/new_des.php',
				type: 'post',
				data: { "des": document.getElementById("des"+UID).value,"UID":UID},
				success: function(result) {alert(result);}
			});
		}
		function new_title(UID){
			$.ajax({
				url: 'edits/new_title.php',
				type: 'post',
				data: { "title": document.getElementById("title"+UID).value,"UID":UID},
				success: function(result) {alert(result);}
			});
		}
		function new_tag(UID){
			$.ajax({
				url: 'edits/new_tag.php',
				type: 'post',
				data: { "tag": document.getElementById("tag"+UID).value,"UID":UID},
				success: function(result) {alert(result);}
			});
		}
		function new_art(UID){
			$.ajax({
				url: 'edits/new_art.php',
				type: 'post',
				data: { "art": document.getElementById("art"+UID).value,"UID":UID},
				success: function(result) {alert(result);}
			});
		}
		function new_lang(UID){
			$.ajax({
				url: 'edits/new_lang.php',
				type: 'post',
				data: { "lang": document.getElementById("lang"+UID).value,"UID":UID},
				success: function(result) {alert(result);}
			});
		}
		function change_pic(UID){
			$.ajax({
				url: 'edits/new_pic.php',
				type: 'post',
				data: { "pic": document.getElementById("pic"+UID).value,"UID":UID},
				success: function(result) {alert(result);}
			});
		}
	</script>
</html>
