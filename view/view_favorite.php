<?php
include_once dirname(__DIR__,1)."/user.php";
include_once dirname(__DIR__,1)."/utils.php";
session_start();
authMiddleware();

// if(!isset($_SESSION["user"])){
//     return header("location:login.php");
// }
$user = User::findByID($_SESSION["user"]);
$estates = $user->getFavorites();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>view real state</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <?php include_once "nav.php" ?>
    <div class="container estate-list mt-2">
        <?php
        if(!empty($estates)){
            foreach($estates as $estate){
                ?>
                    <div class="estate shadow my-3">
                        <div class="estate-info">
                            <div class="estate-actions">
                                <a href="view_real_estate.php?id=<?php echo $estate["id"]?>"><?php echo $estate["name"] ?></a>
                                <?php 
                                if(isset($_GET["me"])||(isset($user) &&$estate["owner_id"]==$user->getId())){
                                    ?>
                                    <a href="update_real_estate.php?id=<?php echo $estate["id"] ?>" style="margin-left:auto;" class="btn btn-primary me-2 btn-change1">Update</a>
                                    <a href="/project_soft/controller/real_estate/delete_real_estate.php?id=<?php echo $estate["id"] ?>" class="btn btn-danger btn-change3">Delete</a>
    
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <p class="me-3 text-muted">Rent: <strong><?php echo $estate["rent"] ?></strong></p>
                                <p class="ml-3 text-muted">Location: <strong><?php echo $estate["location"] ?></strong></p>
                            </div>
                        </div>
                        <img src="../public/images/<?php echo $estate["image_path"]?>" alt="">
                        <?php
                        if(isset($estate["description"])){
                            ?> 
                            <p class="mt-2 estate-desc"><?php echo $estate["description"] ?></p>
                            <?php
                        }
                        ?>
                    </div>
                <?php
            }
        }else{
            ?> <h1>There Is No Favorite</h1> <?php
        }
    ?>
</div>
<?php include_once "footer.php" ?>
</body>
</html>