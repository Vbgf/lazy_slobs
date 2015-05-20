<?php
	session_start();
	$_SESSION["comment"] = $_POST["comment"];
?>

<script>
	var x =<?php
		$i = 0;
		$handle = fopen('lists/COMMENTS', "r") or die("Unable to open file!");
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
			window.location.href = "http://localhost/SITE2/erase_comment.php";
		}
		else{
			window.location.href = "http://localhost/SITE2/Blog.php";
		} 
	}
	else 
	{
		window.location.href = "http://localhost/SITE2/maker.php";
	}
</script>
