<?php
session_start();
require_once("../../../../wp-load.php");
 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/login.php' );
  
   exit;
 }


?>

<?php

if(isset($_POST['update'])){
  $fname= $_POST['fname'];
  $lname= $_POST['lname'];
  $cn = $_POST['contact'];
  global $wpdb;
  $em=$_SESSION['email'];
  

  if($_FILES['pic']['error'] == 0){
    $pic=$_FILES['pic']['name'];
    $tmp_loc=$_FILES['pic']['tmp_name'];
    $image= wp_upload_bits($pic,null,file_get_contents($tmp_loc));
    $img_url=($image['url']);
   
   

  
   $wpdb->update('wp_loginsystem', array('fname' => $fname,
'lname' =>$lname , 'contact' => $cn,  'pic' => $img_url,), array('email' => $em )); 
 $exist= $wpdb->get_results("SELECT * FROM `wp_loginsystem` WHERE `email`='$em'");
      
      $_SESSION['loggedin'] = true;
   $_SESSION['fname']= $exist[0]->fname;
   $_SESSION['lname']= $exist[0]->lname;
   $_SESSION['email']= $exist[0]->email;
   $_SESSION['contact']= $exist[0]->contact;
   $_SESSION['password']= $exist[0]->password;
    $_SESSION['pic']= $exist[0]->pic;
   wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/profile.php' );


 }
else{
  $wpdb->update('wp_loginsystem', array('fname' => $fname,
  'lname' =>$lname , 'contact' => $cn,  ), array('email' => $em )); 
   $exist= $wpdb->get_results("SELECT * FROM `wp_loginsystem` WHERE `email`='$em'");
        
        $_SESSION['loggedin'] = true;
     $_SESSION['fname']= $exist[0]->fname;
     $_SESSION['lname']= $exist[0]->lname;
     $_SESSION['email']= $exist[0]->email;
     $_SESSION['contact']= $exist[0]->contact;
     $_SESSION['password']= $exist[0]->password;
      $_SESSION['pic']= $exist[0]->pic;
     wp_safe_redirect( 'http://localhost/wordpress/wp-content/plugins/loginsystem/view/profile.php' );
 
}


}
?>

<?php
       define("loginsystem5" ,plugin_dir_path(__FILE__) );
       include_once loginsystem5 .'../../../themes/astra/header.php';

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
  <div class="container my-4">
    <div  class="border p-4 px-5">
  <h2 class = "text-center text-primary font-weight-bold">Update Data</h2>
  
  <form method= "post" action="#" name= "update" enctype="multipart/form-data" >
   <div class="form-group">
      <label for="name"> Change First Name :</label>
      <input type="name" class="form-control" value=  "<?php echo $_SESSION['fname'];?>" id="name" placeholder="Enter fist name" name="fname">
    </div>

    <div class="form-group">
      <label for="name">Change Last Name :</label>
      <input type="name" class="form-control" value="<?php echo $_SESSION['lname'];?>" id="name" placeholder="Enter last name" name="lname">
    </div>
    
    <div class="form-group">
      <label for="contect">Update contact no:</label>
      <input type="contect-no" class="form-control"  id="contect" value= "<?php echo $_SESSION['contact'] ;?>" placeholder="contect no" name="contact">
    </div>

    <div class="form-group">
      <label for="pic">Change Pofile picture:</label>
      <input type="file"  id="pic" name="pic">
    </div>
   
    
    
    <button type="submit" name="update" class="btn btn-primary">change</button>
  
  </div> 
</div>
<?php
      
       include_once loginsystem5 .'../../../themes/astra/footer.php';

       ?>

  

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script >
  $(update).validate({
 rules:{
         contect:{
            // phoneUS: true,
              digits:true,
             minlength:10,
            maxlength:10 }
         
        },
        messages:{
         contect:{
            // phoneUS: true,
              digits:'Please enter only digits for phone no.',
             minlength:'Please enter exactly 10 digits for phone no.',
            maxlength:'Please enter  exactly 10 digits for phone no.', }
         
        },
        submitHandler:function(form){
       alert("Your Profile detail updated successfully");
       form.submit();
      }

      })
    
</script>
</body>
</html>