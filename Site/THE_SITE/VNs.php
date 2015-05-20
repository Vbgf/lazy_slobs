<html>
	<head>
		<title>BLOG</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
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
			echo 	"<br>";
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
			$result = mysql_query("SELECT UID,name,description FROM VN ORDER BY UID DESC LIMIT ".(($page-1)*10).",10");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: 1' . mysql_error();
				exit;
			}
			else{
				echo"<br>";
				echo"<br>";
				while($row = mysql_fetch_array($result)){
					echo "<br>";
					echo "<div id = 'box'>";
					echo "<div id = 'box2'>";
					echo $row['name'];
					echo "</div>";
					echo "<a href='VN/".$row['UID']."'><img src = 'VN/".$row['UID']."/resources/thumbnail.png'></a>";
					echo "<div id = box3>";
					$id=$row['UID'];
					$result2 = mysql_query("SELECT name,IDVN
					FROM vnxtags,tags
					WHERE IDVN='$id' AND UID=IDtags");// VERY IMPORTANT
					if (!$result2) {
						echo 'Could not run query: 2' . mysql_error();
						exit;
					}
					else{
						echo "TAGS:";
						while($row2 = mysql_fetch_array($result2)){
							echo " <a href>".$row2['name']."</a>";
						}
						echo"\n\n";
					}
					
					echo "ARTISTS: ";
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
						echo"\n\n";
					}
					
					echo "LANGUAGE: ";
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
						echo"\n\n";
					}
					
					echo "DESCRIPTION: ".$row['description'];
					echo "</div>";
					echo "</div>";
				}
			}	
			if (!mysql_free_result($result2))
				 header('Location: VNs.php?page_num=1');
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
						echo "<a href='VNs.php?page_num=".$page."' style='color:orange; text-decoration:none;'><div id='page_button'>".$page."</div></a>";
					}else{
						echo "<a href='VNs.php?page_num=".$page."' style='color:red; text-decoration:none;'><div id='page_button'>".$page."</div></a>";
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
		<br>
		</div>
	</body>
</html>
