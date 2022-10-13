<?php

session_start();
require_once("../../../../wp-load.php");
if(isset( $_SESSION['loggedin'])){
  
  // wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/profile.php' );
  wp_safe_redirect( 'profile.php' );
      exit;
  }
// logic for login :-

    if(isset($_POST['logon'])){
       $email= $_POST['email'];
       $pass= $_POST['pswd'];
       global $wpdb;
       $exist= $wpdb->get_var("SELECT `email` FROM `wp_loginsystem` WHERE `email`='$email'");
         if ($exist==$email){
           $exist= $wpdb->get_var("SELECT `password` FROM `wp_loginsystem` WHERE `email`='$email'");
              if ($exist==$pass){
       
                  $exist= $wpdb->get_results("SELECT * FROM `wp_loginsystem` WHERE `email`='$email'");
                  session_start();
                 $_SESSION['loggedin'] = true;
              $_SESSION['fname']= $exist[0]->fname;
              $_SESSION['lname']= $exist[0]->lname;
              $_SESSION['email']= $exist[0]->email;
              $_SESSION['contact']= $exist[0]->contact;
              $_SESSION['password']= $exist[0]->password;
              $_SESSION['pic']= $exist[0]->pic;
              // wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/profile.php' );
              wp_safe_redirect( 'profile.php' );
              }
            
               else{
                 echo "<script> window.alert('Please enter correct password for login.')</script>";
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
  <h2 class = " text-primary text-center font-weight-bold">Welcome to login page</h2>
 
    <div class="form-group ">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" >
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" >
    </div>
    
    <button type="submit" class="btn btn-primary" name= "logon" >Login</button>
    <a class="btn btn-primary" href="signup.php" role="button">Register</a>
    <a class="btn btn-primary m-2" href="forgetpassword.php" role="button">Forget Password</a>
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
           
         pswd: 'required',},
         
        messages:{
         email:
           {
            required:'The email ID is required for Login',
            email:'Please enter only registered EmailId for Login', },
           
         pswd: {required:'The Password  is required for login',},
         
        }


      })
</script>
 
  