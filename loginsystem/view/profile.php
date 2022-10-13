<?php
session_start();
require_once("../../../../wp-load.php");

 if(!isset($_SESSION['loggedin'])){
  wp_safe_redirect( 'login.php' );
      exit;
  }

?>
<?php

// logic for delete :-
    if(isset($_POST['delete'])){
    $em=$_SESSION['email'];
    global $wpdb;
   $wpdb->delete('wp_loginsystem', ['email' => $em] ); 
   $_SESSION['loggedin'] = null;
       session_unset();
        session_destroy();
        wp_safe_redirect( 'login.php' );
   
    exit;
   

    }


    // logic for logout :-
    if(isset($_POST['logout'])){
      $_SESSION['loggedin'] = null;
        session_unset();
        session_destroy();
        wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/login.php' );
         
    exit;
       
    }
    ?>
<?php
        define("loginsystem3" ,plugin_dir_path(__FILE__) );
        include_once loginsystem3 .'../../../themes/astra/header.php';

       ?>

 <!DOCTYPE html>
<html lang="en">
<head>

  <title>User Profile </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .main{
        
    }
  .container {
    padding: 20px 120px;
   
    
  }
  .xtz{
    padding: 0px 0px 10px;

  }
 
  
   .bg-1 {
    
    background: #2d2d30;
    color: #bdbdbd;
  }
 
  .bg-1 p {font-style: italic;}
  li{
    color: #000;
  }
  </style>
</head>
<body>



<div class="bg-1">
  <div class="container">
  

    <h3 class="text-center text-primary font-weight-bold">PROFILE DETAIL</h3>
    <p class="text-center">hii <strong class="font-weight-bold text-success"> <?php echo $_SESSION['fname'];?></strong>,wlcome to your profile page .<br> Here below find your profile details!</p>
    
    <div class="text-center xtz">
    <span class="rounded"> 

      <img src="<?php  echo $_SESSION['pic'];
     ?> " class="rounded-circle   text-center" style="width:160px;height:170px;" alt="">  
      </span>
    </div> 
    <ul class="list-group">
      <li class="list-group-item">You have loged in into system on <?php date_default_timezone_set('Asia/Kolkata'); echo date('d-m-y h:i:s');?></li>
      <li class="list-group-item">Name:- <?php echo $_SESSION['fname']." ".$_SESSION['lname'] ;?></li>
      <li class="list-group-item"> Email Id :-<?php echo $_SESSION['email'] ;?></li>
      <li class="list-group-item">Phone No :- <?php echo $_SESSION['contact'] ;?></li>
      

      
      <li class="list-group-item">
      <form method= "post" action="#" >
<button type="submit" name="delete" class="btn btn-primary">Delete</button>
<button type="submit" name="logout" class="btn btn-primary">Logout</button>
<a class="btn btn-primary" href="http://localhost/wordpress/wp-content/plugins/loginsystem/view/update.php" role="button">Edit Profile</a>
<a class="btn btn-primary" href="http://localhost/wordpress/wp-content/plugins/loginsystem/view/password.php" role="button">Update-Password</a>
</form>

</li> 

    </ul>
  </div>
</div>
</div>

</body>
</html>
<?php
       
         include_once loginsystem3 .'../../../themes/astra/footer.php';

       ?>
