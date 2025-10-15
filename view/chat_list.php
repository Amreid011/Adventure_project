<?php
 include_once dirname(__DIR__,1)."/utils.php";
 include_once dirname(__DIR__, 1) . "/user.php";
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 }  

 if (!isset($_SESSION["user"])) {
     return header("location:login.php");
 }

 $user = User::findByID($_SESSION["user"]);
 $chats = $user->getMyChats();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>Adventure</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <main>

        <?php include_once "nav.php" ?>

        <br><br>
        <main class="form-auth shadow p-3 mb-5 bg-white rounded list-group row sideBar">
            
            
            <?php
                if(!empty($chats)){
                    foreach($chats as $chat){
                        if( $user->type==="admin"){
                            $imgg = "admin.jpg";
                        }
                        elseif( $user->type==="host"){
                            $imgg = "host.jpg";
                        }
                        elseif( $user->type==="traveller"){
                            $imgg = "trav.jpg";
                        }
                        ?>
                         <a href="chat.php?user=<?php echo $chat["id"] ?>" class=" list-group-item list-group-item-secondary"><img width="45" class=" align-middle mr-2 bg-image hover-zoom rounded-circle border border-info imggg" src="../public/<?php echo$imgg ?>"> <?php echo $chat["name"]?></a> 
                        <?php
                    }
                }
            ?>

        </main>




        <?php include_once "footer.php" ?>

    </body>
</html>