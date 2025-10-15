<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";
session_start();

authMiddleware();

// if(!isset($_SESSION["user"])){
//     header("location:/project_soft/view/login.php");
// }
if(!isset($_GET["id"])){
    setSessionMsg( "Please provide real estate id","danger");
    header("location:/project_soft/view/home.php");
}
$user = User::findByID($_SESSION["user"]);
$state = $user->deleteRealEstate($_GET["id"]);
if($state){
    setSessionMsg( "Real estate deleted","success");
}else{
    setSessionMsg( "Real estate couldn't be deleted","danger");
}
header("location:/project_soft/view/view_real_estates.php");
?>