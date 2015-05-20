<html>
	<head>
		<title>MANGA LIST</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	
	<body background="Pictures/bg.jpg"
	<?php
		session_start();
		if (isset($_SESSION["warnings_list"]))
		{
			/*echo "style = 
			\"
			background-image: url('https://mocorochi.files.wordpress.com/2012/11/72.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center;
			background-color: darkblue;
			background-position: 0% 0%; 
			background-size:cover
			\"
			";*/
		}
	?>>
		<div id ="MAIN">
		
			<?php
				include "menus/menu.php";
				echo "<br><br><br>";
				if (isset($_SESSION["warnings_list"]))
				{
					echo "<div style = 'color:red; font-size:24px;'>";
					echo $_SESSION["warnings_list"];
					echo "<br><br>You expected success, BUT IT WAS ME DIO<br>";
					echo "</div>";
					unset($_SESSION["warnings_list"]);
				}
			?>
			<br>
			<form action="check.php" method="post">
				<br>
				<pre>First name</pre><input type="text" placeholder="Iosyf" name='fname'><br>
				<pre>Last name</pre><input type="text" placeholder="Saleh" name='lname'><br>
				<pre>User name</pre><input type="text" placeholder="Hideyoshi" name="uname"><br>
				<pre>Password</pre><input type="password" placeholder="**********" name="pname"><br>
				<pre>Confirm Password</pre><input type="password" placeholder="**********" name="p2name"><br>
				<pre>E-Mail</pre><input type="text" placeholder="smt@abv.bg" name='ename'><br>
				<pre>Confirm E-Mail</pre><input type="text" placeholder="smt@abv.bg" name="e2name"><br><br>
				<input type="submit" value="REGISTER"
				<?php
					if (isset($_SESSION["warnings_list"]))
					{
						echo 'style="background-color:red;"';
					}
				?>
				>
			</form>
			<br>
		</div>
	</body>
</html>
