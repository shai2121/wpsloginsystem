

<?php
session_start();
require_once("../../../../wp-load.php");
if(isset( $_SESSION['loggedin'])){
  
  wp_safe_redirect( 'profile.php' );
      exit;
  }

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // logic for registration:-
     

    if(isset($_POST['submit'])){
        $fname= $_POST['fname'];
       $lname= $_POST['lname'];
        $email= $_POST['email'];
       $contact= $_POST['contect'];
      $pass= $_POST['pswd'];
       $cpass=$_POST['cpswd'];
       if($_FILES['pic']['error'] == 0){
        $pic=$_FILES['pic']['name'];
        $tmp_loc=$_FILES['pic']['tmp_name'];
        $image= wp_upload_bits($pic,null,file_get_contents($tmp_loc));
        $img_url=($image['url']);
     }
    else{
    //  $img_url="http://localhost/wordpress/wp-content/uploads/2022/10/default.png";
     $img_url="../../../uploads/2022/10/default.png";
    }


       global $wpdb;
       
     $exist= $wpdb->get_var("SELECT `email` FROM `wp_loginsystem` WHERE `email`='$email'");
    
    
    if ($exist==$email){
      echo "<script> window.alert('Email id already exist please login to the system')</script>";
    }
    else{

       $wpdb  ->insert("wp_loginsystem", array(
          "fname" => $fname,
          "lname" => $lname,
          "email" => $email,
          "contact" => $contact,
          "password" => $pass,
          "pic" => $img_url,
         
       ));
       echo "<script> window.alert('You have Registor successfully please login now.')</script>";
    }
    }
}
      
?>
<?php
        define("loginsystem8" ,plugin_dir_path(__FILE__) );
        include_once loginsystem8 .'../../../themes/astra/header.php';

       ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  
  <style>
  .border{border-style: solid;
    border-radius: 20px
  }
  .error{
    color:red;
    padding: 10px;
  }
  </style>
</head>
  <body>
  

  
  <div class="container my-4">

  <div class="border p-4 px-5">
  <h2 class="text-primary text-center">Registration form</h2>
  
  <form method= "post" action="#" enctype="multipart/form-data" name ="signup" >


  <div class="form-group  ">
      <label for="name">First Name :</label>
      <input type="name" class="form-control" id="name"  placeholder="Enter fist name" name="fname">
    </div>

    <div class="form-group">
      <label for="name">Last Name :</label>
      <input type="name" class="form-control" id="name" placeholder="Enter last name" name="lname">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" >
    </div>

    <div class="form-group">
      <label for="contect">Phone No:</label>
      <input type="contect-no" class="form-control" titile ="contect no must be only 10digit."  placeholder="contect no" name="contect">
    </div>
    <div class="form-groups">
      <label for="pic">Pofile picture:</label>
      <input type="file"  id="pic" name="pic">
    </div>
    <div class="form-group">
      <label for="pswd">Password:</label>
      <input type="password" class="form-control" id="pswd" placeholder="password" name="pswd" >
    </div>
    <div class="form-group">
      <label for="cpswd"> conform Password:</label>
      <input type="password" class="form-control" id="cpswd" placeholder="password" name="cpswd">
    </div>

   
    
    <button type="submit" name="submit" class="btn btn-primary m-2">Submit</button>
    <button type="Reset" class="btn btn-primary m-2">Reset</button>
    <a class="btn btn-primary m-2" href="login.php" role="button">Login</a>
  </form>
</div>

 
       
  
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 
<script >
  $(signup).validate({
 rules:{
         email:
           {
            required:true,
            email:true },
           
         pswd: 'required',
         cpswd:{
             required:true,
             equalTo:pswd },

         contect:{
            // phoneUS: true,
              digits:true,
             minlength:10,
            maxlength:10 }
         
        },
        messages:{
         email:
           {
            required:'The email Id is required for signup',
            email:'You must enter a velid email address', },
           
         pswd: {required:'The Password  is required for signup',},
         cpswd:{
             required:'The Confirm Password is required for signup',
             equalTo: 'Please enter the same value for password and confirm password', },

         contect:{
            // phoneUS: true,
              digits:'Please enter only digits for phone no.',
             minlength:'Please enter exactly 10 digits for phone no.',
            maxlength:'Please enter  exactly 10 digits for phone no.', }
         
        }
      })
</script>

</body>
</html> 
<?php
       
         include_once loginsystem8 .'../../../themes/astra/footer.php';

       ?>


     