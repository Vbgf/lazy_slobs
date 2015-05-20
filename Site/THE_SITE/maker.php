<?php
	session_start();
	$myfile = $_SESSION["comment"]."\n";
	$myfile .= file_get_contents('lists/COMMENTS');
	file_put_contents('lists/COMMENTS', $myfile);
	$new = fopen("COMS2/".$_SESSION["comment"].'.txt', "w") or die("Unable to open file!");
	$handle = fopen("COMS/".$_SESSION["comment"].'.php', "w") or die("Unable to open file!");
	date_default_timezone_set('Europe/Sofia');
	$date = date('m/d/Y h:i:s a', time());
	$code= '
	<!DOCTYPE html>
	<html>
		<head>
			<title>'.$_SESSION["comment"].'</title>
			<link rel="stylesheet" type="text/css" href="../mystyle.css">
			<link rel="stylesheet" type="text/css" href="../blackbg.css">
		</head>
		<body bgcolor="black">
			<?php
			session_start();
			if (isset($_SESSION["us"])) {
			}
			else
			{
				header(\'Location: http://localhost/SITE2/Blog.php\');
			}
			//<marquee><font color="red" font face="Comic Sans MS" size="10">WELCOME TO IOSYF"S PLACE DOT COM!!!!!!!!!!!!</font></marquee>
			?>
			
			<div id = "black_bar">
				<span>
					'.$_SESSION["comment"].'
				</span>
				<img src = "../welcome.jpeg" class = "right_maid">
				<img src = "../tsundere.png" class = "left_maid">
			</div>
			
			<?php
				include "../menus/menu.php";
				//<script src="menus/menu.php"></script>
			?>

			<div id="MAIN4">
			<form method="get" action="../Blog/Logout.php">
				<button style="position:relative;margin-left:872px;margin-top:1px;border-color:red;height:30px; width: 200px;background-color:black;color:red" type="submit" type="submit">Logout</button>
			</form>
			<br>
			<?php
			$_SESSION["file"]=__FILE__;
			?>
			<form action="../Blog/maker2.php" method="post">
				<input id = "box2" type="text" placeholder="Comment..." name="comment">
				<input style="margin-top:2px;width:100px" id="box" value="Comment" type="submit">
			</form>
			<br>
			<table border="0" cellpadding="0" cellspacing="0" width="920" id = "Discussion_title">
				<tbody>
					<tr style ="font-size:26px; width:100%">
						<td>
							<span>The Title For THIS Discussion IS ("'.$_SESSION["comment"].'")</span>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<?php
				$handle = fopen(\'../COMS2/'.$_SESSION["comment"].'.txt\', "r") or die("Unable to open file!");
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
				$handle = fopen(\'../COMS2/'.$_SESSION["comment"].'.txt\', "r") or die("Unable to open file!");
				if ($handle) {
						$q=0;
						$i=0;
						echo \'<table border="0" cellpadding="0" cellspacing="0" width="auto" id = "Main-er_Comment">\';
						echo \'<tr>\';
						echo \'<td>\';
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
									echo \'</td><td>\';
								}
								if($i == 2)
								{
									echo\'</td></tr><tr><td colspan="2" id = "special"><div id="scroler">\';
								}
							}
							if ($ch=="\n")
							{
								echo \'</div></td></tr></table>\';
								$q =1;
								$i=0;
								$e=0;
								$linecount--;
							}
							else if ($q == 1)
							{
								echo \'<table border="0" cellpadding="0" cellspacing="0" width="auto" id = "Main-er_Comment"><tr><td>\';
								$q = 0;
							}
							echo $ch;
						}
						echo \'</td></tr></table>\';
						echo \'<br>\';
					}
					fclose($handle);
				}
			?>
			</div>
			<br>
		</body>
	</html>';
	fwrite ($handle, $code);
	fclose ($handle);
	header('Location: http://localhost/SITE2/Blog.php');
?>
