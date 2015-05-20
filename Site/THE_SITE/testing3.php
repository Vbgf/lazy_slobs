<!DOCTYPE html>
<html>
<body>

<?php
// // Create connection
// $conn = new mysqli($servername, $username, $password);
// // Check connection
// if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// } 

// // Create database
// $sql = "CREATE DATABASE Iosyf";
// if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
// } else {
    // echo "Error creating database: " . $conn->error;
// }

// $result = mysql_query('SELECT * from users');
// if (!$result) {
    // die('Invalid query: ' . mysql_error());
// }else{
	// while ($row = mysql_fetch_assoc($result)) {
		// foreach ($row as $name => $value) {
			// echo "column $name contains $value<br />";
		// }
	// }
// }
//$conn->close();
$servername = "localhost";
$username = "root";
$password = ""; 
$i = 0;


if (!mysql_connect($servername, $username, $password)) {
    echo 'Could not connect to mysql<br>';
    exit;
}else{
	echo 'connected to '.$servername.'<br>';
}

mysql_select_db('iosyf') or die('Could not select database');

$query = "SELECT * FROM users";
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$result = mysql_query('SELECT * from users');
if (!$result) {
    die('Invalid query: ' . mysql_error());
}else{
	while ($row = mysql_fetch_assoc($result)) {
		echo "Table:";
		$row = array_values($row);
		for ($i=0;$i<count($row);++$i){
			echo $row[$i]."\n<br>";
		}
	}
}

$result = mysql_query("SELECT * FROM users WHERE UID ='5'");
echo $result;
while ($row = mysql_fetch_array($result)) 
{
    //$text = $row[''];
	echo "<h1>".$row['UID'].' '.$row['FN'].' '.$row['LN']."</h1>";
}
//echo "<h1>".$text."</h1>";

mysql_free_result($result);
?>
<br>
<br>

</body>
</html>