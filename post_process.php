<?php
 include('functions.php');
 if(isset($_POST['post'])){
     echo "this";
     $title = $_POST['title'];
     $description = $_POST['description'];
     $id=$_POST['id'];
     date_default_timezone_set('Asia/Yangon');
     $date = date('Y-m-d H:i:s');
     $result = insertPost($id,$title,$description,$date);
     echo $result;
     if(!empty($result)){
         header("location:index.php");
     }
 }
?>