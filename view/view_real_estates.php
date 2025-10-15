<?php
    include_once dirname(__DIR__,1)."\controller\\real_estate\\view_real_estates.php"
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
<div class="type">
    <a class="btn btn-info btn-change2" href="?type=all">All</a>
    <a class="btn btn-info btn-change2" href="?type=hotel">Hotels</a>
    <a class="btn btn-info btn-change2" href="?type=volunteering">Volunteering</a>
    <a class="btn btn-info btn-change2" href="?type=competition">Competition</a>
</div>
<div class="container estate-list mt-2">
    <?php
    if (!empty($estates)){
        foreach($estates as $estate){
            ?>
                <div class="estate shadow my-3">
                    <div class="estate-info">
                        <div class="estate-actions">
                            <a href="view_real_estate.php?id=<?php echo $estate["id"]?>"><?php echo $estate["name"] ?></a>
                            <?php 
                            if(isset($_GET["me"])||(isset($user) &&$estate["owner_id"]==$user->getId())){
                                ?>
                                <a href="update_real_estate.php?id=<?php echo $estate["id"] ?>" style="margin-left:auto;" class="btn btn-primary me-2  btn-change3">Update</a>
                                <a href="/project_soft/controller/real_estate/delete_real_estate.php?id=<?php echo $estate["id"] ?>" class="btn btn-danger  btn-change3">Delete</a>

                                <?php
                            }
                            ?>
                        </div>
                        <div>
                            <p class="me-3 text-muted">Rent: <strong><?php echo $estate["rent"] ?>$</strong></p>
                            <p class="ml-3 text-muted">Location: <strong><?php echo $estate["location"] ?></strong></p>
                            <p class=" text-muted" style="margin-left: 8px;text-transform:capitalize;">Type: <strong><?php echo $estate["type"] ?></strong></p>

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
    }
    ?>
</div>
<?php include_once "footer.php" ?>
</body>
</html>