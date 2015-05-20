<?php
	session_start();
	$_SESSION["comment"] = $_POST["comment"];
?>

<script>
	var x =<?php
		$i = 0;
		$handle = fopen('COMMENTS', "r") or die("Unable to open file!");
		if ($handle) {
			while (($ch = fgets($handle)) !== false) {
				if ($_POST["comment"]."\n" == $ch)
				{
					$i=1;
					echo "1";
					break;
				}
			}
			if ($i != 1)
				echo "0";
		}
		fclose ($handle);
	?>;
	if (x == 1)
	{
		var r = confirm("The comment has already been used!!! Replace?");
		if (r == true){
			window.location.href = "http://localhost/SITE/erase_comment.php";
		}
		else{
			window.location.href = "http://localhost/SITE/Blog.php";
		} 
	}
	else 
	{
		window.location.href = "http://localhost/SITE/maker.php";
	}
</script>
