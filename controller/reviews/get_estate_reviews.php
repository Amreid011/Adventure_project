<?php
require_once dirname(__DIR__,2)."\user.php";

$reviews = $user->getEstateReviews($_GET["id"]);

?>