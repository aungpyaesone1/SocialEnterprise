<script src="js/jquery-3.3.1.min.js"></script>

<?php
include('functions.php');

session_start();
if(isset($_POST['submit']) && $_POST['tok'] == $_SESSION['token']){
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $pass = hash("sha512", $password);
    $result = checkMember($email,$pass);
    
    if(!empty($result)){
        if($result['active']==1){
        $_SESSION['username'] = $result['name'];
        $_SESSION['id'] =$result['id'];
        $_SESSION['email'] =$email;
        $_SESSION['userpass'] = $password;
        $_SESSION['id']=$result['id'];
        $_SESSION['profile'] = $result['profile'];
        header("location:index.php");
        }
        else{
            header("location:login.php?status=e");
        }
        
    }
    else{
        header("location:login.php?status=e");
    }
}

if(isset($_POST['register'])){
    include('mail_test.php');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
     
    $pass = hash("sha512", $password);
    include_once ('lib/smtp_validateEmail.class.php');
    $SMTP_Validator = new SMTP_validateEmail();
    $check=false;
    if ($email != "") {
        /* $email.="@";*/
        $results = $SMTP_Validator->validate(array($email));
        $res = mailSend($email);
        if ($results[$email]) {
            $check = true;
            
        }
        echo $check;
        if($check){
            $res = insertUser($name,$email,$pass,$res);
            header("location:login.php?activate=true");
            
        }
        else{
            header("location:login.php?email=e");
        }
    }
    
}
if(isset($_POST['activate'])){
    $code= $_POST['code'];
    $res = makeActive($code);
    if($res){
        header('location:login.php?s=s');
    }
    else{
        header('location:login.php');
    }
}


?>
<script>
    jQuery(document).ready(function() {
        jQuery("#submit").click(function() {
            var val = jQuery('.email_box').val();
            if (val == "") {
                alert('Please enter an email.');
            }
        });
    });
</script>