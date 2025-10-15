<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";
session_start();

authMiddleware();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }
if(!isset($_GET["id"])){
    setSessionMsg( "please provide real estate id","danger");
    header("location:home.php");
}
$user = User::findByID($_SESSION["user"]);
$real_estate = $user->getRealEstate($_GET["id"]);
if(!$real_estate[0]){
    setSessionMsg( "real estate not found","danger");
    header("location:home.php");
}
$real_estate = $real_estate[0];
if($real_estate["owner_id"]!=$user->getId()&&$user->type!="admin"){
    setSessionMsg( "you are not authorized to update this real estate","danger");
    header("location:home.php");
}

if(isset($_POST["name"])&&isset($_POST["rent"])&&isset($_POST["location"])){
    $update_str = "`name`='{$_POST['name']}',`rent`={$_POST['rent']},`location`='{$_POST['location']}',`description`='{$_POST['description']}'";
    if(!empty($_FILES["file"]["name"])){
        $file = uploadFile($_FILES["file"]["name"],$_FILES["file"]["tmp_name"]);
        $update_str.=",`image_path`='$file'";
    }
    $state = $user->updateRealEstate($update_str,$_GET["id"]);
    setSessionMsg( "real estate updated","success");
}
?>