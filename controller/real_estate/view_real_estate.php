<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";

session_start();
authMiddleware();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }
$user = User::findByID($_SESSION["user"]);
if(!isset($_GET["id"])){
    header("location:home.php");
}
$estate = $user->getRealEstate($_GET["id"]);
if(count($estate)==0){
    setSessionMsg("hotel Not Found","warning");
    header("location:home.php");
}
$estate = $estate[0];
$avg = $user->calcReviewAvg($_GET["id"]);
?>