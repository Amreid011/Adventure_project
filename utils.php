<?php
require_once "jwt.php";
// function getDBConnection(){
    // $db=null;
    // require_once "db.php";
    // global $db;
    // $db = new DB();
    // $db->openConnection();
    // return $db;
// }

// function validatePost($toValidate,$postData){
//     for ($i=0; $i < count($toValidate); $i++) { 
//         if(!isset($postData[$toValidate[$i]])){
//             return false;
//         }
//     }
//     return true;
// }

function uploadFile($name,$tmp_name){
    $target_dir = __DIR__."/public/images/";
    $target_file = $target_dir . basename($name);
    if (move_uploaded_file($tmp_name, $target_file)) {
        return basename($name);
    } else {
        return false;
    }
}
/** 
 * function help you to make concatenation to your query criteria
 * you can choose any separator default is " , "
 * example: createCriteria(array("creating","test")) return creating , test; 
 */
// function createCriteria($criteria,$separator=" AND "){
//     $criteria = gettype($criteria)=="array"?$criteria = join($separator,$criteria):$criteria;
//     return $criteria;
// }

function authMiddleware(){
    $token = $_COOKIE["token"];
    if(!isset($_SESSION["user"])&&!$token){
        header("location:login.php");
        exit;
    }
    if($token){
        $payload = JWT::decode($token);
        $_SESSION["user"] = $payload->uid;
    }
}

function viewSessionMsg(){
    echo $_SESSION["msg"];
    $_SESSION["msg"]="";
}
function setSessionMsg($msg,$type){
    $_SESSION["msg"] = $msg;
    $_SESSION["msg_type"] = $type;
}
?>