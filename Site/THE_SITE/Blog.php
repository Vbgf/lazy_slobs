<html>
	<head>
		<title>BLOG</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	
	<body background="Pictures/bg.jpg">
		<div id = "MAIN">
			<?php
				session_start();
				if ((isset($_SESSION["us"])) && (isset($_SESSION["pass"])))
					header('Location: http://localhost/SITE2/Blog/Blog.php');
				include "menus/menu.php";
			?>
			<br>
			<br>
			<br>
			<form method="post">
				<pre>User name</pre><input type="text" placeholder="User name here" name="a"><br>
				<pre>Password</pre><input type="password" placeholder="Password here" name="b"><br><br>
				<input type="submit" value="Login" onclick=action="Login.php" id ="Left_Button"
				<?php
					if (isset($_SESSION["retry"]))
					{
						echo ' style="background-color:red;"';
					}
				?>>
				<input  type="submit"  value = "Register" onclick=action="Register.php" id ="Right_Button">
			</form>
			<br>
		</div>
	</body>
</html>
