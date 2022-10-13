<?php
 session_start();
require_once("../../../../wp-load.php");
 if(!isset($_SESSION['logged']) || $_SESSION['logged']!=true){
  wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/forgetpassword.php' );
     exit;
  }

?>
<?php
require_once("../../../../wp-load.php");
if(isset($_POST['changepass'])){
    $cn = $_POST['Pass'];
    $rn= $_POST['pswd'];
    $vcode=$_POST['vcode'];
    $em=$_SESSION['email'];
    $exist=$_SESSION['vcode'];
    global $wpdb;
    if ($exist== $vcode){

    $wpdb->update('wp_loginsystem', array('password' => $cn), array('email' => $em )); 

    session_unset();
    session_destroy();
    wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/login.php' );
  }

    else{
      echo "<script> window.alert('You have entered wrong verification code.')</script>";
      }
    }



    ?>
    <?php
       define("loginsystem4" ,plugin_dir_path(__FILE__) );
       include_once loginsystem4 .'../../../themes/astra/header.php';

       ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  
  <style>
  .container{
    border-radius: 30px;
    padding: 20px ;
    margin-top:70px;
    margin-left:270px
  }
  .solid {border-style: solid;
    border-radius: 20px
  }
  .error{
    color:red;
    padding: 10px;
  }
  

</style>  

</head>
  <body>
   
  <div class="container">
  
 
  <form  class =" solid col-7 p-4 px-5" method= "post" action="#" name="password" >
  <h2 class = " text-primary  text-center font-weight-bold">Reset Password</h2>

  <div class="form-group">
      <label for="vcode">Verification code:</label>
      <input type="text" class="form-control" id="vcode" placeholder="Enter new password " name="vcode" >
    </div>

    <div class="form-group">
      <label for="pass">New password:</label>
      <input type="password" class="form-control" id="pass" placeholder="Enter new password " name="Pass" >
    </div>
    <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Confirm new password" name="pswd" >
    </div>
    
    <button type="submit" class="btn btn-primary " name= "changepass" >Reset Password</button>
   
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 
<script >
   $(password).validate({
 rules:{  
         Pass: 'required',
         vcode:'required',
         pswd:{
             required:true,
             equalTo:("#pass") 
            }},
        messages:{
         Pass: {required:'The new Password  is required for Password change',},
         vcode:{required:'The verification code  is required for set new password',},
         pswd:{
             required:'The Confirm Password is required for Password change ',
             equalTo: 'Please enter the same value for password and confirm password', },
        }
        

      })
  
</script>

</body>
</html>
<?php
       include_once loginsystem4 .'../../../themes/astra/footer.php';

       ?>