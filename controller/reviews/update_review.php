<?php
require_once dirname(__DIR__,2)."\user.php";
include_once dirname(__DIR__,2)."\utils.php";

session_start();
if(!isset($_GET["id"])){
    header("location:home.php");
}
authMiddleware();
// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }
$user = User::findByID($_SESSION["user"]);
if(isset($_POST["rate"])){
    if(!$_POST['feedback']){
        $_POST['feedback']=null;
    }
    $updated = $user->updateReview("`rate`='{$_POST['rate']}',`feedback`='{$_POST['feedback']}'",$_GET["id"]);
    if(!$updated){
        setSessionMsg("Couldn't update review","danger");
    }else{
        setSessionMsg("Review updated","success");
        $estate_id = $_GET["estate_id"];
        header("location:view_real_estate.php?id=$estate_id");
    }
}
$review = $user->getReview($_GET["id"]);
if(!$review || count($review)==0){
    setSessionMsg("Couldn't find the review","danger");
    header("location: home.php");
}
$review = $review[0];

?>