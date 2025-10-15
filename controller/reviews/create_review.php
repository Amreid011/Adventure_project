<?php
require_once dirname(__DIR__,2)."\user.php";
require_once dirname(__DIR__,2)."\utils.php";

if(isset($_POST["review"])&&isset($_POST["rate"])){
    if(!$_POST['feedback']){
        $_POST['feedback']=null;
    }
    $review = $user->createReview("'{$_POST['rate']}','{$_POST['feedback']}','{$_GET['id']}'");
    if(!$review){
        setSessionMsg("Couldn't create review","danger");
    }else{
        setSessionMsg("Review created","success");
    }
}
?>