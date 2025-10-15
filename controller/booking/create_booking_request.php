<?php
require_once dirname(__DIR__,2)."\utils.php";

if(isset($_POST["booking"])&&isset($_POST["enter_date"])&&isset($_POST["exit_date"])){
    $booking = $user->createBookingRequest($estate["id"],$_POST["enter_date"],$_POST["exit_date"],$estate["rent"]);
    setSessionMsg("rent request created","success");
}
?>