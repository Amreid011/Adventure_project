<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";
// session_start();

$msg="";
if(isset($_POST["register"])){
    if(
        isset($_POST["name"])&&isset($_POST["password"])&&isset($_POST["email"])&&
        isset($_POST["location"])&&isset($_POST["dob"])&&isset($_POST["type"])
    ){
        $_POST["cash"] = 10000;
        $user = new User($_POST);
        $user->hash_password();
        $user->encode_user();
        $user->save();
        // $_SESSION["user"] = $user->save();
        header("location:profile.php");
    }else{
        $msg="Please enter all required values";
    }
}




?>