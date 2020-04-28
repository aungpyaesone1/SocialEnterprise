<?php
session_start();
$salt = time('now');
$token = hash("sha256",$salt);
$_SESSION['token'] = $token;
?>
<html>
    <head>
        <title>Yammo Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <!--<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">-->
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        
        <style>
            body{
                background-color: #efefef;
            }
            .main{
                background: white;
                width: 70%;
                height: 73%;
                position: relative;
                margin-left: auto;
                margin-right: auto;
                vertical-align: middle !important;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                margin-top: 80;
                border-radius: 10px;
                border:1px solid cadetblue;
                
            }
            .img_container{
                width: 55%;
                height: 100%;
                border:;
                float: left;
            }
            .img{
                border-radius: 8px;
            }
            .text_container{
                border:;
                width: 44%;
                height: 100%;
                padding-top: 20px;
                align-content: center !important;
                align-items: center;
                text-align: center;
                float: right;   
            }
            h2{
                font-family: sans-serif;
                color: cadetblue;
                display: block;
                margin: 0 auto;
                font-weight: bold;    
                
            }
            .form_container{
                align-items: center;
                border:;
                padding: 20px;
                padding-top: 0px;
                display: inline-block;
                margin: 0 auto;
                vertical-align: center;
                margin-top:30px;
            }
            .aung{
                display: inline-block;
                align-content: center;
                padding-top: 30px;
            }
            .register{
                display: none;
            }
            .des{
                text-align: center;
                position: absolute;
                margin-top: -80px;
                width: 100%;
                
            }
        </style>
    </head>
    <body>
        <?php
        if(isset($_GET['destory'])){
            session_destroy();
        }
        if(isset($_GET['status'])){?>
        <div class="alert alert-danger des" role="alert">
                <strong>Error!</strong> Login fail!
            </div>
        <?php }
        if(isset($_GET['s'])){?>
        <div class="alert alert-danger des" role="alert">
            <strong>Successful!</strong> YOur account have been created!
        </div>
        <?php }
        if(isset($_GET['email'])){?>
            <div class="alert alert-danger des" role="alert">
                <strong>Oop!</strong> your email does not exist!
            </div>
       <?php }
        
        if(isset($_GET['activate'])){ ?>
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#activateModal').modal('show');
            });
        </script>
        <?php }
        ?>
        <div class="modal fade" id="activateModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"  class="close">&times;</button>
                        <h4 class="modal-title">Activate Account</h4>
                    </div>
                    <form action="login_process.php" method="post">
                    <div class="modal-body">
                        
                            <input type="text" placeholder="Enter your code" name="code">
                            
                       
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-default" value="Submit" name="activate">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(300, 0).slideUp(300, function(){
                    $(this).remove(); 
                });
            }, 1000);
        </script>
        <div class="main login">
           
            <div class="img_container login100-pic js-tilt" data-tilt>
               <image class="img" src="images/undraw_email_campaign_qa8y%20(1).png" style="width:480;height:400;"></image>
           </div>
           <div class="text_container">
              <div class="aung">
               <h2>Yammodo<hr style="width:220;height:4px;"></h2>
              </div>
                  <div class="form_container">
                   <form method="POST" class="login100-form validate-form" action="login_process.php">
                       <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                          <input type="hidden" value="<?php echo $token;?>" name="tok">
                           <input class="input100" type="email" name="email" placeholder="Email">
                           <span class="focus-input100"></span>
                           <span class="symbol-input100">
                               <i class="fa fa-envelope" aria-hidden="true"></i>
                           </span>
                       </div>

                       <div class="wrap-input100 validate-input" data-validate = "Password is required">
                           <input class="input100" type="password" name="pass" id="pass1" placeholder="Password">
                           <span style="color:darkblue;cursor:pointer;margin-top:-30px;margin-left:220px;" class="glyphicon glyphicon-eye-open"></span>
                           <script>
                               $(".glyphicon-eye-open").on("click", function() {
                                   $(this).toggleClass("glyphicon-eye-close");
                                   var type = $("#pass1").attr("type");
                                   if (type == "text"){ 
                                       $("#pass1").prop('type','password');}
                                   else{ 
                                       $("#pass1").prop('type','text'); }
                               });
                           </script>
                           <span class="focus-input100"></span>
                           <span class="symbol-input100">
                               <i class="fa fa-lock" aria-hidden="true"></i>
                           </span>
                       </div>

                       <div class="container-login100-form-btn">
                           <input type="submit" class="login100-form-btn" value="Login" name="submit">
                           
                       </div>

                       <div class="text-center p-t-12">
                           <span class="txt1">
                               Forgot
                           </span>
                           <a class="txt2" href="#">
                               Username / Password?
                           </a>
                       </div>
                      

                       <!--<div class="text-center p-t-136">
                           <a class="txt2" href="#">
                               Create your Account
                               <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                           </a>
                       </div>-->
                   </form>
                      <div class="text-center p-t-12">
                          <a class="txt2" href="#">
                              If you are not a member?
                          </a>
                          <button onclick="fade()"><span style="font-size:11px;">Register</span></button>
                      </div>
                      
                  </div>
           </div>
            
        </div>
        
        <div class="main register" id="reg">

            <div class="img_container login100-pic js-tilt" data-tilt>
                <image class="img" src="images/undraw_manage_chats_ylx0%20(1).png" style="width:470;height:400;"></image>
            </div>
            <div class="text_container">
                <div class="aung">
                    <h2>Yammodo<hr style="width:220;height:4px;"></h2>
                </div>
                <div class="form_container" style="margin-top:-5px;">
                    <form method="POST" class="login100-form validate-form" action="login_process.php">
                        <div class="wrap-input100 validate-input">
                            <input type="hidden" value="<?php echo $token;?>" name="tok">
                            <input class="input100" type="text" name="name" placeholder="Name" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="email" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100" type="password" id="pass" name="pass" placeholder="Password" minlength="5">
                            <span style="color:darkblue;cursor:pointer;margin-top:-29px;margin-left:220px;" class="glyphicon glyphicon-eye-open open1"></span>
                            <script>
                                $(".open1").on("click", function() {
                                    $(this).toggleClass("glyphicon-eye-close");
                                    var type = $("#pass").attr("type");
                                    if (type == "text"){ 
                                        $("#pass").prop('type','password');}
                                    else{ 
                                        $("#pass").prop('type','text'); }
                                });
                            </script>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <input type="submit" class="login100-form-btn" value="Register" name="register">

                        </div>

                        <!--<div class="text-center p-t-12">
                            <span class="txt1">
                                Forgot
                            </span>
                            <a class="txt2" href="#">
                                Username / Password?
                            </a>
                        </div>-->

                        <!--<div class="text-center p-t-136">
<a class="txt2" href="#">
Create your Account
<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
</a>
</div>-->
                    </form>
                </div>
            </div>
            <script>
                function fade() {

                    window.setTimeout(function() {
                        $(".login").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 300);
                    $("#reg").fadeIn(4000);
                   
                }
            </script>
                
        </div>
    </body>
    
</html>