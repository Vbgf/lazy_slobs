<?php

/*$hash = password_hash(, PASSWORD_BCRYPT);
echo $hash."<br>";

if (password_verify("123456", $hash)) {
    echo 'Password is 123456!';
} else {
    echo 'Invalid password';
}*/
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

$Name="1";
$Len="1";
$Des="a long vn";

//$result = mysql_query("INSERT INTO vnxlanguages (IDVN,IDlanguages)
//VALUES ('1','1')");
//$result =  mysql_query("DELETE FROM vnxlanguages WHERE IDVN = 1");
		$result = mysql_query("INSERT INTO VN (name,description)
VALUES ('qqqqqqqq132qq','LAZY')");
		if ($result) {
			//header('Location: Blog.php');
			echo "success";
		} else {
			echo 'Could not run query: 3' . mysql_error();
			exit;
		}
//mysql_free_result($result);
?>