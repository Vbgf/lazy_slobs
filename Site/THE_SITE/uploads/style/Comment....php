
	<!DOCTYPE html>
	<html>
		<head>
			<title>Comment...</title>
			<link rel="stylesheet" type="text/css" href="../mystyle.css">
		</head>
		<body bgcolor="black">
			<?php
			session_start();
			if (isset($_SESSION["us"])) {
			}
			else
			{
				header('Location: http://localhost/SITE/Blog.php');
			}
			?>
			<marquee><font color="red" font face="Comic Sans MS" size="10">WELCOME TO IOSYF"S PLACE DOT COM!!!!!!!!!!!!</font></marquee>
			<br>
			<ul>
				<li><a href="../Iosyf's_website.html">Home</a></li>
				<li>Lists
					<ul>
						<li> <a href="../Anime_list.php">Anime</a></li>
						<li> <a href="../Manga_list.php">Manga</a></li>
						<li> <a href="../Searching.php">Searching for ... </a></li>
					</ul>
				</li>
				<li>Products
					<ul>
						<li> <a href="../Anime_list.php">Code</a></li>
						<li> <a href="../Anime_list.php">Not Code</a></li>
					</ul>
				</li>
				<li> <a href="../Blog.php">Blog</a></li>
			</ul>
			<div id="MAIN4">
			<br>
			<form method="get" action="../Blog/Logout.php">
				<button style="align:center;width: 200px;background-color:black;color:blue" type="submit">Logout</button>
			</form>
			<br>
			<?php
			$_SESSION["file"]=__FILE__;
			?>
			<form action="../Blog/maker2.php" method="post">
				<input id = "box2" type="text" value="Comment..." name="comment">
				<input style="align:right;" id="box" value="Comment" type="submit">
			</form>
			<br>
			<table border="0" cellpadding="0" cellspacing="0" width="920">
				<tbody>
					<tr style ="font-size:26px; width:100%">
						<td>
							The Title For THIS Discussion IS ("Comment...")
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<?php
				$handle = fopen('../COMS2/Comment....txt', "r") or die("Unable to open file!");
				if ($handle)
				{
					$linecount = 0;
					while (($line = fgets($handle)) !== false) {
						$linecount++;
					}
				}
				fclose($handle);
				if ($linecount > 0)
				{
				$handle = fopen('../COMS2/Comment....txt', "r") or die("Unable to open file!");
				if ($handle) {
						$q=0;
						$i=0;
						$e=0;
						echo '<table border="0" cellpadding="0" cellspacing="0" width="auto">';
						echo '<tr>';
						echo '<td>';
						echo '<p>';
						while (($ch = fgetc($handle)) !== false) {
							if ($linecount == 0)
							{
								break;
							}
							if ($ch=="\t")
							{
								$e=0;
								$i=$i+1;
								if ($i == 1)
								{
									echo '</p></td><td><p>';
								}
								if($i == 2)
								{
									echo'</p></td></tr><tr><td colspan="2" id = "special"><p>';
								}
							}
							if ($ch=="\n")
							{
								echo '</p></td></tr></table>';
								$q =1;
								$i=0;
								$e=0;
								$linecount--;
							}
							else if ($q == 1)
							{
								echo '<table border="0" cellpadding="0" cellspacing="0" width="auto"><tr><td><p>';
								$q = 0;
							}
							$e+=1;
							if ($e == 55)
							{
									echo '</p><p>';
									$e=0;
							}
							echo $ch;
						}
						echo '</td></tr></table>';
						echo '<br>';
					}
					fclose($handle);
				}
			?>
			</div>
			<br>
		</body>
	</html>