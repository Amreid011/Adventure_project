<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";
authMiddleware();

// if(!isset($_SESSION["user"])){
//     header("location:login.php");
// }

$user = User::findByID($_SESSION["user"]);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["name"])&&isset($_POST["rent"])&&isset($_POST["location"])&&isset($_POST["type"])){
        $file = uploadFile($_FILES["file"]["name"],$_FILES["file"]["tmp_name"]);
        $description = isset($_POST["description"])?$_POST["description"]:null;
        $state = $user->createRealEstate("'{$_POST['name']}','{$_POST['rent']}','{$_POST['location']}','{$_POST['type']}','{$file}','{$description}'");
        setSessionMsg("Real estate created","success");
    }else{
        setSessionMsg("Please set all data","danger");
    }
}

?>