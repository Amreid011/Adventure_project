<?php

if(isset($_GET["review_id"])){
    $review = $user->deleteReview($_GET["review_id"]);
    if(!$review){
        setSessionMsg("Couldn't delete review","danger");
    }else{
        setSessionMsg("Review deleted","success");
    }
}

?>