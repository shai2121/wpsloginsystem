<?php
require_once("../../../../wp-load.php");


    if(isset($_POST['fpassword'])){
       $email= $_POST['email'];
       $rp= wp_rand( $min = 000000, $max = 999999 );
    $message = 'varification code :-'.$rp;
   $adm=get_option('admin_email');

   global $wpdb;
   $exist= $wpdb->get_var("SELECT `email` FROM `wp_loginsystem` WHERE `email`='$email'");
     if ($exist==$email){

  //php mailer variables

    $to = $email;

    $subject = "verification code from Login system";

    $headers = 'From: '. $adm . "\r\n" .

      'Reply-To: ' . $adm . "\r\n";

      echo "<script> window.alert('Verification code sent to your register email id')</script>";
 

  //Here put your Validation and send mail

  $sent = wp_mail($to, $subject, strip_tags($message), $headers);

        if($sent) {
          session_start();
          $_SESSION['logged'] = true;
          $_SESSION['email']= $email;
          $_SESSION['vcode']= $rp;
          

          wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/changepass.php' );

        }//message sent!

        else  {

          echo "<script> window.alert('please check your email id and retry')</script>";

        }
        }
     
      else{
        echo "<script> window.alert('Please login with registered emailID')</script>";
        }



}



?>


       <?php
        define("loginsystem2" ,plugin_dir_path(__FILE__) );
        include_once loginsystem2 .'../../../themes/astra/header.php';

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

 
  <form  class =" solid col-7 p-4 px-5" method= "post" action="#" name ="login">
  <h2 class = " text-primary text-center font-weight-bold">Forget Password page</h2>
 
    <div class="form-group ">
    <p >Please enter your registered email id for reset password</p>
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" >
    </div>
   
    
    <button type="submit" class="btn btn-primary" name= "fpassword" >SUBMIT</button>
    <a class="btn btn-primary" href="http://localhost/wordpress/wp-content/plugins/loginsystem/view/login.php" role="button">Login</a>
  </form>
  </div>
  </body>
</html>
<?php
      
        include_once loginsystem2 .'../../../themes/astra/footer.php';

       ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script >
  $(login).validate({
 rules:{
         email:
           {
            required:true,
            email:true },
           
        },
         
        messages:{
         email:
           {
            required:'The email ID is required for reset password',
            email:'Please enter only registered EmailId for Login', },
         
        }


      })
</script>
 
  