<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";

authMiddleware();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }

$user = User::findByID($_SESSION["user"]);

$bookings = array();
if($user->type=="host"){
    $bookings= $user->viewMyEstatesBookings();
}else{
    $bookings = $user->viewMyBookings();
}
?>