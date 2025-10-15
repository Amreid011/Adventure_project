<?php
require_once dirname(__DIR__,1)."\utils.php";
session_start();
$db = getDBConnection();
header('Content-Type: application/json');

$msg = $db->select("SELECT * FROM message WHERE chat_id='{$_GET["chat"]}' AND sender_id='{$_GET["user"]}' ORDER BY createdAt DESC LIMIT 1");
if(!empty($msg)){
    echo json_encode($msg[0]);
}else{
    echo json_encode(array());
}


?>