<?php
session_start();
include('functions.php'); 
$image = $_FILES['file'];
$target_path = 'images/user_images'.'/'.$image['name'];
$tmp_path = $image['tmp_name'];
move_uploaded_file($tmp_path, $target_path);
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $result = updateUser($_SESSION['id'],$name,$email,$image['name'],$position);
    $_SESSION['profile'] = $image['name'];
    header("location:index.php");
}
?>