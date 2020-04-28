<?php
include('config/conf.php');
include('functions.php'); 
session_start();
$year = $_GET['id'];
$_SESSION['major']=$year;
$projects="";

if($year[0] == 'a'){
    $major = substr($year,1);
    $projects =  selectProjects($major);
}else{
    $year1 = $year[0];
    $major = substr($year,1);
    $projects =  selectProjectsWithYear($major,$year1);
    /* var_dump($projects);*/
}

foreach($projects as $project):
$poster = explode(",", $project['photo']);?>
<div id="myStyle">
    <img src="thumbs/<?php echo $poster[0];?>" width="300" height="200">
    <h2><?php echo $project['title'];?></h2>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>
    <a href="project_detail.php?id=<?php echo $project['id'];?>">Detail</a>
</div><hr>
<?php endforeach ?>
