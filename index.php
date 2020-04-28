<?php
if(isset($_POST['logout'])){
    session_destroy();
    header("location:login.php");
}
?>
<?php
include('functions.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['userpass'])){
    $users = selectUsers();
    $posts = selectPosts();
    /*echo "<pre>";
    var_dump($posts);*/

?>
<html>
    <head>
        <title>Yammo Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <link rel="stylesheet" href="css/custom.css">
    </head>

    <body>
        <div class="view_container row">
            <div class="header">
                <h2><b><i>YammobotEnterprise</i></b></h2> 
            </div>
            <div class="btn-class">
                &nbsp;&nbsp;&nbsp;<button class="btn btn-md" data-toggle="modal" data-target="#myModal">Post</button>&nbsp;&nbsp;
                <a href="login.php?destory=d" style="color:black;" class="btn btn-md">Logout</a>
                <!--<form method="post" action="index.php"> 
                <button class="btn btn-md" name="logout">Logout</button>
                </form>-->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:cadetblue;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Post</h4>
                        </div>
                        <form method="post" action="post_process.php">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image">Upload Photo:</label>
                                    <input type="file" name="file">
                                </div>
                                <div class="form-group">
                                    <label for="Title">Title:</label>
                                    <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="Title">Description:</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="post" class="btn btn-md" value="Post">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="edit_profile_modal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:cadetblue;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Profile</h4>
                        </div>
                        <form method="post" action="profile_update.php" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image">Upload Photo:</label>
                                    <input type="file" name="file">
                                </div>
                                <div class="form-group">
                                    <label for="Title">Name:</label>
                                    <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="Title">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                <label for="sel1">Select Position:</label>
                                <?php
                                    $positions = selectPositions();
                                    
                                    ?>
                                <select class="form-control" id="sel1" name="position">
                                   <?php
                                       foreach ($positions as $position){?>
                                    <option value='<?php echo $position['id'];?>'><?php echo $position['position_name']; ?></option>
                                           
                                    
                                           
                                    <?php   }
                                    ?>
                                    
                                </select>


                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="update" class="btn btn-md" value="Update">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--endModal-->
        </div>
        <div class="profile_card">
            <div class="up">
                <img class="img_align profile" src="images/user_images/<?php echo $_SESSION['profile'];?>"  user_id="<?php echo $_SESSION['id'];?>">

            </div>
            <div class="down">
                <h5><b><?php echo $_SESSION['username'];?></b></h5>
                <img src="images/icons8-facebook-100.png" style="width:32;height:32;margin-right:5px;">
                <img src="images/icons8-twitter-circled-64%20(1).png" style="width:27;height:27;margin-right:5px;">
                <img src="images/icons8-facebook-messenger-100%20(1).png" style="width:32;height:32;">
            </div>

        </div>
        <div class="post_container" id="post_div">
            
            <?php
    foreach($posts as $post){?>
            <div class="posts">
                <img class="member-profile" src="images/companies-banner-image.png">
                <span class="name"><?php echo $post['name'];?></span><span style="float:right;margin-top:10px;font-weight:bold;"><?php echo $post['created_at'];?></span>

                <div class="description">
                    <?php echo $post['description'];echo "#demo".$post['id'];?>
                    <a href="#" class="" >Read more...</a>
                </div>
                <?php
                             $condition=false;
                             $like = selectLikes($post['id']); 
                             $res =checkLike($like['post_id']);
                             
                             foreach($res as $row){
                                 if($row['staff_id']==$_SESSION['id']){
                                     $condition=true;
                                 }
                            
                             }
                             if($condition){
                ?>
                
                    <img src="images/icons8-facebook-like-24%20(1).png" class="like unlike" 
                         data-toggle="tooltip" data-placement="bottom" title="Liked" staff_id="<?php echo $_SESSION['id'];?>" id="<?php echo $post['id'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="count">
                        <?php echo $like["count(*)"];?>
                    </span>
                    <?php } 
                             else{?>
                <img src="images/icons8-facebook-like-24.png" class="like" staff_id="<?php echo $_SESSION['id'];?>" id="<?php echo $post['id'];?>">
                   
                    <?php echo $like["count(*)"];?>
                    <?php }
                    ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="25" height="25" data-toggle="collapse" data-target="#demo_<?php echo $post['id'];?>" 
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g transform="translate(2.408,2.408) scale(0.972,0.972)"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="none" stroke-linecap="butt" stroke-linejoin="none" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g fill="#3b745c" stroke="#4f8359" stroke-width="5" stroke-linejoin="round"><path d="M135.70195,43.49719c12.78526,9.90847 20.81805,23.73903 20.81805,39.06281c0,15.32378 -8.03279,29.15434 -20.81805,39.06281c-12.78526,9.90847 -30.34349,15.97719 -49.70195,15.97719c-6.82548,0 -13.39876,-0.8126 -19.64562,-2.22391c-9.35517,12.50117 -23.79945,15.98391 -35.39438,15.98391c-0.69551,-0.00027 -1.32242,-0.41935 -1.58857,-1.06193c-0.26615,-0.64258 -0.11915,-1.38219 0.37248,-1.87417c6.15624,-6.15624 6.34001,-15.68611 6.34586,-27.06648c-12.62363,-9.89609 -20.60977,-23.58657 -20.60977,-38.79742c0,-15.32378 8.03279,-29.15434 20.81805,-39.06281c12.78526,-9.90847 30.34349,-15.97719 49.70195,-15.97719c19.35847,0 36.9167,6.06872 49.70195,15.97719zM38.40438,46.21492c-12.11561,9.3895 -19.48438,22.22074 -19.48438,36.34508c0,14.30647 7.5649,27.29461 19.96141,36.71461c0.42709,0.32495 0.67806,0.83061 0.67859,1.36727v0.13102c0,10.15867 -0.23026,19.61304 -5.15328,26.86828c10.45512,-0.63461 22.19586,-4.21138 29.85477,-15.11719c0.40589,-0.57606 1.12208,-0.8463 1.80734,-0.68195c6.29386,1.50608 12.98768,2.31797 19.93117,2.31797c18.63805,0 35.48001,-5.86542 47.59562,-15.25492c12.11561,-9.3895 19.48438,-22.22074 19.48438,-36.34508c0,-14.12434 -7.36876,-26.95558 -19.48437,-36.34508c-12.11561,-9.3895 -28.95757,-15.25492 -47.59562,-15.25492c-18.63805,0 -35.48001,5.86542 -47.59562,15.25492zM129.02687,49.18461c0.25808,0.17698 0.39968,0.48016 0.36973,0.79166c-0.02995,0.3115 -0.22673,0.58214 -0.51381,0.7067c-0.28708,0.12455 -0.61915,0.08335 -0.86709,-0.10757c-10.83633,-7.85956 -25.66935,-12.73539 -42.0157,-12.73539c-16.66297,0 -31.75584,5.06673 -42.64391,13.19563c-10.88807,8.12889 -17.55609,19.27307 -17.55609,31.52438c0,8.96813 3.57035,17.33258 9.75898,24.37227c0.20286,0.23103 0.26704,0.55274 0.16838,0.84393c-0.09867,0.29119 -0.34519,0.50762 -0.64671,0.56776c-0.30152,0.06014 -0.61221,-0.04516 -0.81503,-0.27622c-6.41896,-7.30168 -10.18563,-16.08218 -10.18563,-25.50773c0,-12.87617 7.02474,-24.52248 18.24813,-32.90172c11.22339,-8.37924 26.66068,-13.53828 43.67188,-13.53828c16.68797,0 31.86096,4.966 43.02687,13.06461zM132.13094,51.60336c0.42043,0.35239 0.83794,0.71043 1.24633,1.075c0.22926,0.20463 0.33193,0.51602 0.26934,0.81688c-0.06259,0.30086 -0.28095,0.54546 -0.5728,0.64167c-0.29185,0.09621 -0.61286,0.0294 -0.84209,-0.17526c-0.39314,-0.35095 -0.79404,-0.69892 -1.20265,-1.04141c-0.28178,-0.23105 -0.38738,-0.61458 -0.26358,-0.9573c0.1238,-0.34272 0.45013,-0.57022 0.81451,-0.56786c0.20244,0.00242 0.39753,0.07618 0.55094,0.20828zM136.11516,55.30203c0.55627,0.57376 1.09704,1.15621 1.61922,1.75023c0.31351,0.35716 0.27815,0.90083 -0.07899,1.21437c-0.35713,0.31354 -0.90081,0.27821 -1.21437,-0.0789c-0.50294,-0.57214 -1.0211,-1.13521 -1.55875,-1.68977c-0.24762,-0.24771 -0.32029,-0.62083 -0.18375,-0.94336c0.13654,-0.32254 0.45503,-0.53006 0.80524,-0.52468c0.23218,0.00444 0.4527,0.10259 0.61141,0.27211zM139.21922,59.32992c0.26236,0.00935 0.50608,0.13802 0.6618,0.34938c5.10417,6.73834 8.03898,14.56042 8.03898,22.8807c0,12.87617 -7.02474,24.52248 -18.24812,32.90172c-11.22339,8.37924 -26.66068,13.53828 -43.67187,13.53828c-2.0522,0 -4.08111,-0.07395 -6.08383,-0.22172c-0.47384,-0.03549 -0.82928,-0.44825 -0.79404,-0.92211c0.03524,-0.47386 0.44782,-0.82951 0.9217,-0.79453c1.96016,0.14462 3.94573,0.21836 5.95617,0.21836c16.66297,0 31.75584,-5.06673 42.64391,-13.19563c10.88807,-8.12889 17.55609,-19.27307 17.55609,-31.52437c0,-7.91652 -2.77994,-15.35772 -7.68961,-21.8393c-0.19793,-0.25114 -0.2402,-0.59135 -0.10975,-0.88329c0.13046,-0.29194 0.4121,-0.48741 0.73123,-0.50749c0.0291,-0.00148 0.05825,-0.00148 0.08734,0zM65.36,82.56c0,4.7911 -4.29205,8.6 -9.46,8.6c-5.16795,0 -9.46,-3.8089 -9.46,-8.6c0,-4.7911 4.29205,-8.6 9.46,-8.6c5.16795,0 9.46,3.8089 9.46,8.6zM94.6,82.56c0,4.7911 -4.29205,8.6 -9.46,8.6c-5.16795,0 -9.46,-3.8089 -9.46,-8.6c0,-4.7911 4.29205,-8.6 9.46,-8.6c5.16795,0 9.46,3.8089 9.46,8.6zM123.84,82.56c0,4.7911 -4.29205,8.6 -9.46,8.6c-5.16795,0 -9.46,-3.8089 -9.46,-8.6c0,-4.7911 4.29205,-8.6 9.46,-8.6c5.16795,0 9.46,3.8089 9.46,8.6zM48.16,82.56c0,3.75826 3.40865,6.88 7.74,6.88c4.33135,0 7.74,-3.12174 7.74,-6.88c0,-3.75826 -3.40865,-6.88 -7.74,-6.88c-4.33135,0 -7.74,3.12174 -7.74,6.88zM77.4,82.56c0,3.75826 3.40865,6.88 7.74,6.88c4.33135,0 7.74,-3.12174 7.74,-6.88c0,-3.75826 -3.40865,-6.88 -7.74,-6.88c-4.33135,0 -7.74,3.12174 -7.74,6.88zM106.64,82.56c0,3.75826 3.40865,6.88 7.74,6.88c4.33135,0 7.74,-3.12174 7.74,-6.88c0,-3.75826 -3.40865,-6.88 -7.74,-6.88c-4.33135,0 -7.74,3.12174 -7.74,6.88z"></path></g><path d="M0,172v-172h172v172z" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path><g fill="#3b745c" stroke="none" stroke-width="1" stroke-linejoin="miter"><path d="M86,27.52c-19.35847,0 -36.9167,6.06872 -49.70195,15.97719c-12.78526,9.90847 -20.81805,23.73903 -20.81805,39.06281c0,15.21085 7.98614,28.90133 20.60977,38.79742c-0.00585,11.38038 -0.18962,20.91024 -6.34586,27.06648c-0.49163,0.49197 -0.63862,1.23159 -0.37248,1.87417c0.26615,0.64258 0.89306,1.06165 1.58857,1.06193c11.59493,0 26.0392,-3.48273 35.39438,-15.98391c6.24686,1.4113 12.82014,2.22391 19.64562,2.22391c19.35847,0 36.9167,-6.06872 49.70195,-15.97719c12.78526,-9.90847 20.81805,-23.73903 20.81805,-39.06281c0,-15.32378 -8.03279,-29.15434 -20.81805,-39.06281c-12.78526,-9.90847 -30.34349,-15.97719 -49.70195,-15.97719zM86,30.96c18.63805,0 35.48001,5.86542 47.59562,15.25492c12.11561,9.3895 19.48438,22.22074 19.48438,36.34508c0,14.12434 -7.36876,26.95558 -19.48437,36.34508c-12.11561,9.3895 -28.95757,15.25492 -47.59562,15.25492c-6.94349,0 -13.63731,-0.81189 -19.93117,-2.31797c-0.68526,-0.16434 -1.40145,0.10589 -1.80734,0.68195c-7.65891,10.90581 -19.39964,14.48258 -29.85477,15.11719c4.92302,-7.25524 5.15328,-16.70961 5.15328,-26.86828v-0.13102c-0.00053,-0.53666 -0.2515,-1.04232 -0.67859,-1.36727c-12.3965,-9.42 -19.96141,-22.40814 -19.96141,-36.71461c0,-14.12434 7.36876,-26.95558 19.48438,-36.34508c12.11561,-9.3895 28.95757,-15.25492 47.59563,-15.25492zM86,36.12c-17.01119,0 -32.44849,5.15904 -43.67187,13.53828c-11.22339,8.37924 -18.24813,20.02555 -18.24813,32.90172c0,9.42555 3.76666,18.20606 10.18563,25.50773c0.20282,0.23106 0.51352,0.33636 0.81503,0.27622c0.30152,-0.06014 0.54804,-0.27657 0.64671,-0.56776c0.09867,-0.29119 0.03448,-0.6129 -0.16838,-0.84393c-6.18864,-7.03968 -9.75898,-15.40414 -9.75898,-24.37227c0,-12.25131 6.66802,-23.39548 17.55609,-31.52438c10.88807,-8.12889 25.98094,-13.19562 42.64391,-13.19562c16.34635,0 31.17938,4.87584 42.0157,12.73539c0.24794,0.19093 0.58001,0.23213 0.86709,0.10757c0.28708,-0.12455 0.48385,-0.3952 0.51381,-0.7067c0.02995,-0.3115 -0.11164,-0.61468 -0.36973,-0.79166c-11.16591,-8.0986 -26.3389,-13.06461 -43.02687,-13.06461zM131.58,51.39508c-0.36438,-0.00237 -0.69071,0.22514 -0.81451,0.56786c-0.1238,0.34272 -0.0182,0.72625 0.26358,0.9573c0.40861,0.34249 0.80952,0.69045 1.20265,1.04141c0.22923,0.20466 0.55024,0.27147 0.84209,0.17526c0.29185,-0.09621 0.5102,-0.34081 0.5728,-0.64167c0.06259,-0.30086 -0.04008,-0.61225 -0.26934,-0.81688c-0.40838,-0.36457 -0.8259,-0.72261 -1.24633,-1.075c-0.15341,-0.1321 -0.3485,-0.20586 -0.55094,-0.20828zM135.50375,55.02992c-0.35021,-0.00538 -0.66869,0.20215 -0.80524,0.52468c-0.13654,0.32254 -0.06387,0.69565 0.18375,0.94336c0.53765,0.55456 1.05581,1.11763 1.55875,1.68977c0.31356,0.35711 0.85724,0.39243 1.21437,0.0789c0.35713,-0.31354 0.3925,-0.85721 0.07899,-1.21437c-0.52218,-0.59402 -1.06295,-1.17647 -1.61922,-1.75023c-0.15871,-0.16952 -0.37923,-0.26767 -0.61141,-0.27211zM139.13188,59.32992c-0.31913,0.02008 -0.60077,0.21555 -0.73123,0.50749c-0.13046,0.29194 -0.08819,0.63215 0.10975,0.88329c4.90967,6.48158 7.68961,13.92278 7.68961,21.8393c0,12.25131 -6.66802,23.39548 -17.55609,31.52437c-10.88807,8.12889 -25.98094,13.19563 -42.64391,13.19563c-2.01044,0 -3.99601,-0.07374 -5.95617,-0.21836c-0.47388,-0.03499 -0.88646,0.32067 -0.9217,0.79453c-0.03524,0.47386 0.3202,0.88663 0.79404,0.92211c2.00272,0.14777 4.03163,0.22172 6.08383,0.22172c17.01119,0 32.44849,-5.15904 43.67188,-13.53828c11.22339,-8.37924 18.24812,-20.02555 18.24812,-32.90172c0,-8.32028 -2.93482,-16.14236 -8.03898,-22.8807c-0.15572,-0.21136 -0.39944,-0.34002 -0.6618,-0.34938c-0.0291,-0.00148 -0.05825,-0.00148 -0.08734,0zM55.9,73.96c-5.16795,0 -9.46,3.8089 -9.46,8.6c0,4.7911 4.29205,8.6 9.46,8.6c5.16795,0 9.46,-3.8089 9.46,-8.6c0,-4.7911 -4.29205,-8.6 -9.46,-8.6zM85.14,73.96c-5.16795,0 -9.46,3.8089 -9.46,8.6c0,4.7911 4.29205,8.6 9.46,8.6c5.16795,0 9.46,-3.8089 9.46,-8.6c0,-4.7911 -4.29205,-8.6 -9.46,-8.6zM114.38,73.96c-5.16795,0 -9.46,3.8089 -9.46,8.6c0,4.7911 4.29205,8.6 9.46,8.6c5.16795,0 9.46,-3.8089 9.46,-8.6c0,-4.7911 -4.29205,-8.6 -9.46,-8.6zM55.9,75.68c4.33135,0 7.74,3.12174 7.74,6.88c0,3.75826 -3.40865,6.88 -7.74,6.88c-4.33135,0 -7.74,-3.12174 -7.74,-6.88c0,-3.75826 3.40865,-6.88 7.74,-6.88zM85.14,75.68c4.33135,0 7.74,3.12174 7.74,6.88c0,3.75826 -3.40865,6.88 -7.74,6.88c-4.33135,0 -7.74,-3.12174 -7.74,-6.88c0,-3.75826 3.40865,-6.88 7.74,-6.88zM114.38,75.68c4.33135,0 7.74,3.12174 7.74,6.88c0,3.75826 -3.40865,6.88 -7.74,6.88c-4.33135,0 -7.74,-3.12174 -7.74,-6.88c0,-3.75826 3.40865,-6.88 7.74,-6.88z"></path></g><path d="" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path></g></g></svg>
                <?php $comment = selectCommentCount($post['id']); 
                             echo $comment['count(*)'];
                ?>
                    
                <?php
                    $comments = selectComments($post['id']);
                             
                    
                ?>
                <div id="demo_<?php echo $post['id'];?>"  class="collapse">
                    <div class="comments">
                        <Span><u>Comments</u></Span><br>
                        <img class="member-profile-com" src="images/companies-banner-image.png">
                        <Span class="user-com"><?php echo $post['name'];?>::</Span>
                        <Span class="user-coms">
                            Some quick example text to build on the card title.
                        </Span>
                        <?php foreach($comments as $comment){?>
                        <img class="member-profile-com" src="images/companies-banner-image.png">
                        <Span class="user-com"><?php echo $comment['name'];?>::</Span>
                        <Span class="user-coms">
                            <?php echo $comment['comment'];?>
                        </Span><br>
             <?php   }?>
                    </div>
                    <div class="comment" >
                        <textarea class="textarea" placeholder="Enter comment" id="textid_<?php echo $post['id'];?>"></textarea>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="com"
                             width="25" height="25" id="<?php echo $post['id'];?>" staff_id="<?php echo $_SESSION['id'];?>"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;float:right;margin-right:5px;margin-top:0px;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#5f9ea0"><path d="M149.06667,17.2c-0.55025,0.00377 -1.09709,0.08674 -1.6237,0.24635c-0.15501,0.04207 -0.30818,0.09064 -0.45911,0.14557l-126.05495,40.08854v0.02239c-2.23962,0.83573 -3.72568,2.97333 -3.72891,5.3638c0.00425,2.00222 1.05271,3.85719 2.76589,4.89349l38.30807,30.39114l75.73151,-60.35677l-60.35677,75.73151l30.36875,38.28567c1.0349,1.7286 2.90117,2.78714 4.91589,2.78828c2.39047,-0.00322 4.52807,-1.48928 5.3638,-3.72891h0.02239l40.12214,-126.16692c0.041,-0.11449 0.07834,-0.23027 0.11198,-0.34714c0.15961,-0.52661 0.24258,-1.07345 0.24636,-1.6237c0,-3.16643 -2.5669,-5.73333 -5.73333,-5.73333z"></path></g></g></svg>
                    </div>
                </div>

            </div><br>
            <?php } ?>
            
        </div>
        <div class="board scrollba" id="style-10">
            <div class="scrollbar" id="style-10">
                <div class="force-overflow"></div>
            </div>
            <div class="memboard">
                <h3>MemberBoard</h3>
            </div><br>
            <?php
    foreach ($users as $user):?>
            <table class="table table-hover">
                <tr>
                    <div class="row main">
                        <div class="col-md-6 member-image"><img class="member-profile" src="images/companies-banner-image.png"></div>
                        <div class="col-md-6 member-name"id="<?php echo $user['id'];?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $user['position_name'];?>"><strong><?php echo $user['name'];?></strong></div>

                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="tooltip"]').tooltip();   
                            });
                        </script>
                    </div>
                </tr>
            </table>
            <?php   endforeach ?>
        </div>
        <div id="myStyle">

        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function(){  
            $(document).on('click', '.profile', function(){
                var employee_id = $(this).attr("user_id");  
                $.ajax({  
                    url:"profile_edit.php",  
                    method:"POST",  
                    data:{employee_id:employee_id},  
                    dataType:"json",  
                    success:function(data){  
                        $('#name').val(data.name);  
                        $('#email').val(data.email); 
                        $('#edit_profile_modal').modal('show');  
                    }  
                });  
            }); 
        });

        $(document).ready(function () {
            $(".like").click(function (e) {
                var post_id = $(this).attr("id");
                var staff_id = $(this).attr("staff_id");
                id = post_id+'.'+staff_id;
                $('#post_div').load('like_process.php?id=' +id);
            });
        });
        $(document).ready(function () {
            $(".com").click(function (e) {
                var post_id = $(this).attr("id");
                var textarea_value = $("#textid"+'_'+post_id).val();
                var staff_id = $(this).attr("staff_id");
                var text_id = post_id+'.'+staff_id+'.'+textarea_value;
                $('#post_div').load('comment_process.php?id=' +text_id);
                
            });
        });
        $(document).ready(function () {
            $(".unlike").click(function (e) {
                var post_id = $(this).attr("id");
                var staff_id = $(this).attr("staff_id");
                id = post_id+'.'+staff_id;
                $('#post_div').load('unlike.php?id=' +id);
            });
        });
        $(document).ready(function () {
            $(".member-name").click(function (e) {
                var user_id = $(this).attr("id");
                $('#post_div').load('individual_posts.php?id=' +user_id);
            });
        });
    </script>
    <?php } 
else{
    header("location:login.php");
}
    ?>