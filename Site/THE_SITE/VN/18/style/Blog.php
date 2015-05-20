<html>
	<head>
		<title>BLOG</title>
		<link rel="stylesheet" type="text/css" href="../mystyle.css">
	</head>
	<body>
		<?php
		session_start();
		if (isset($_SESSION["us"])) {
		}
		else
		{
			header('Location: http://localhost/SITE/Blog.php');
		}
		?>
		<p id="demo"></p>
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
		<br>
		<div id="MAIN">
		<br>
		<?php
			echo '
			<form method="get" action="Logout.php">
				<button style="align:center;width: 200px;background-color:black;color:blue" type="submit">Logout</button>
			</form>
			';
			if (($_SESSION["us"] == "iluvanime") && ($_SESSION["pass"]=="maidsama"))
			echo '<form action="../filter.php" method="post"><input id = "box2" type="text" value="Comment..." name="comment"><input style="align:right;" id="box" value="Comment" type="submit"></form><br>';
			$handle = fopen("../COMMENTS", "r") or die("Unable to open file!");
			if ($handle)
			{
				while (($buffer = fgets($handle)) !== false) {
					echo '<p> <a href = "http://localhost/SITE/COMS/'.$buffer.'.php">'.$buffer.'</a></p>';
				}
			}
			fclose($handle);
		?>
		<br>
		</div>
		<div id="MAIN2"></div>
	</body>
</html>
