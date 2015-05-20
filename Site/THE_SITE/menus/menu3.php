<div id ='menu_'>
<?php
if ((isset($_SESSION["us"])) && (isset($_SESSION["pass"]))){
	$_SESSION["page"]=1;
	$user=1;
}else
	$user=0;
$back="../../Blog.php";
echo 	"<ul>";
echo 	'<a href="../../"><li id = "menu_links" class = "menu_left">Home</li></a>';
echo 	'<a href="';
if ($user == 1){
	echo 	'../../VNs.php';
}else{
	echo $back;
}
echo 	'"><li id = "menu_links">VNs</li></a>';
echo 	'<a href="';
if ($user == 1){
	echo 	'../../Blog/Blog.php';
}else{
	echo $back;
}
echo 	'"><li id = "menu_links">FaQ</li></a>';
echo 	'<a href="../../Contact.php"><li id = "menu_links" class = "menu_right">Contact us</li></a>';
echo 	'</ul><br>';
		?>
</script>
</div>