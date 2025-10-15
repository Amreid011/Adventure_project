<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";
session_start();
authMiddleware();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }
$user = User::findByID($_SESSION["user"]);
if(!isset($_GET["booking"])||!isset($_GET["estate"])||!isset($_GET["user"])||!isset($_GET["status"])){
    setSessionMsg("Please provide estate,user and status","danger");
    return header("location:view_booking.php");    
}
$amount = isset($_GET["amount"])?$_GET["amount"]:0;
if($_GET["status"]=="Accepted" && !$user->checkBookingValid($_GET["estate"],$_GET["user"],$amount)){
    setSessionMsg("couldn't complete the operation user might not have insufficient funds or estate will not be empty","danger");
    return header("location:/project_soft/view/view_bookings.php");
}
$booking = $user->handleBookingRequest($_GET["booking"],$_GET["user"],$_GET["status"],$amount);
setSessionMsg( "Booking ".$_GET["status"],"success");
header("location:/project_soft/view/view_bookings.php");
?>