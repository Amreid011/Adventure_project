<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";
session_start();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }
authMiddleware();

$user = User::findByID($_SESSION["user"]);
$estates = array();
if(isset($_GET["user_id"])){
    $estates = $user->viewUserRealEstates($_GET["user_id"]);
}else if(isset($_GET["me"])){
    $estates = $user->viewMyRealEstates();
}else{
    if(isset($_GET["type"])){
        $type=$_GET["type"];
    }else{
        $type="all";
    }
    $estates = $user->explore($type);
}
?>