<?php
$target_dir = $_GET['argument1'].'/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//Make the necessary directory
if(!file_exists($target_dir)){
    mkdir($target_dir);
}
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check file size ()max 1mb)
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
} 
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
rename($target_file,$target_dir.'thumbnail.png');
if($target_dir[0] == "V"){
    echo "<script>window.location = 'Edit.php'</script>";
}else{
    echo "<script>window.location = 'index.php'</script>";
}
?> 