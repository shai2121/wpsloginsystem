<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // logic for registration:-

    if(isset($_POST['submit'])){
        $fname= $_POST['fname'];
       $lname= $_POST['lname'];
        $email= $_POST['email'];
       $contact= $_POST['contect'];
      $pass= $_POST['pswd'];
       $cpass=$_POST['cpswd'];

       echo $fname;

       global $wpdb;
       $wpdb  ->insert("wp_login", array(
          "fname" => $fname,
          "lname" => $lname,
          "email" => $email,
          "contact" => $contact,
          "password" => $pass,
         
       ));
    }
}
       ?>
