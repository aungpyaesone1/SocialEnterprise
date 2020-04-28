<?php
  if(isset($_POST['like'])){
      $post_id = $_POST['id'];
      $result = increaseLike($post_id);
  }
?>