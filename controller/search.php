<?php
include_once dirname(__DIR__,1)."\user.php";
include_once dirname(__DIR__,1)."\utils.php";

authMiddleware();

if(isset($_SESSION["user"])){
    $user = User::findByID($_SESSION["user"]);
}

$word = isset($_GET["search1"])?$_GET["search1"]:"";


if(isset($_GET["search1"])){
    $result = $user->search($word);
    return header("location:search.php");    
}





