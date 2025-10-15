<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";

session_start();
$error_msg = "";
if(isset($_POST["email"]) && isset($_POST["password"])){
    $user = User::authenticate($_POST["email"],$_POST["password"]);
    if(!$user){
        $error_msg="Wrong credentials";
    }else{
        $_SESSION["user"] = $user->getId();
        $jwt = JWT::encode(array("uid"=>$user->getId()));
        setcookie("token",$jwt,time()+12*60*60,"/","",false,true);
        // header("Authorization:Bearer $jwt");
        header("location:home.php");
    }
}

?>