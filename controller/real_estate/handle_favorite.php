<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";

$user = User::findByID($_SESSION["user"]);
$id = $_GET["id"];
$fav = $user->checkFavorite($_GET["id"]);
if(isset($_GET["action"])){
    if($_GET["action"]=="del"){
        $user->deleteFavorite($_GET["id"]);
        $fav = null;
        setSessionMsg("Favorite deleted","success");
        header("location:view_real_estate.php?id=$id");
    }else{
        $add = $user->addFavorite($_GET["id"]);
        if($add){
            setSessionMsg( "Favorite created","success");
        }
        $fav=true;
        header("location:view_real_estate.php?id=$id");
    }
}
?>