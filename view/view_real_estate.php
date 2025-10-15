<?php
    include_once dirname(__DIR__,1)."\controller\\real_estate\\view_real_estate.php";
    include_once dirname(__DIR__,1)."\controller\\booking\create_booking_request.php";
    include_once dirname(__DIR__,1)."\controller\\reviews\create_review.php";
    include_once dirname(__DIR__,1)."\controller\\reviews\delete_review.php";
    include_once dirname(__DIR__,1)."\controller\\reviews\get_estate_reviews.php";
    include_once dirname(__DIR__,1)."\controller\\real_estate\handle_favorite.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .reviews{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .review{
            padding: 4px;
            border-radius: 4px;
            width: 450px;
            background-color: #bdc3c7;
        }
        .author-info{
            display: flex;
            justify-content: space-between;
        }
    </style>
    <title>View real Estate</title>
</head>
<body>
<?php include_once "nav.php" ?>
    <div class="container">

        <div class="d-flex justify-content-evenly mb-2">

            <div class="estate shadow my-3">
                <div class="estate-info">
                    <div class="estate-actions">
                        <a href="view_real_estate.php?id=<?php echo $estate["id"]?>"><?php echo $estate["name"] ?></a>
                        <?php 
                        if($fav){
                            ?>
                            <a href="?id=<?php echo $estate["id"] ?>&action=del" style="margin-left:auto;" class="btn btn-warning  btn-change3">Remove Fav</a>
                            <?php
                        }else{
                            ?>
                            <a href="?id=<?php echo $estate["id"] ?>&action=add" style="margin-left:auto;" class="btn btn-info btn-change3">Add Fav</a>
                            <?php
                        }
                        ?>
                        <?php
                        if(isset($_GET["me"])||(isset($user) &&$estate["owner_id"]==$user->getId())){
                            ?>
                            <a href="update_real_estate.php?id=<?php echo $estate["id"] ?>" style="margin-left:auto;" class="btn btn-primary me-2 btn-change3">Update</a>
                            <a href="/project_soft/controller/real_estate/delete_real_estate.php?id=<?php echo $estate["id"] ?>" class="btn btn-danger btn-change3">Delete</a>
                            <?php
                        }
                        ?>
                    </div>
                    <div>
                        <p class="me-3 text-muted">Rent: <strong><?php echo $estate["rent"] ?> </strong></p>
                        <p class="ml-3 me-3 text-muted">Location: <strong><?php echo $estate["location"] ?></strong></p>
                        <p class="text-muted">Avg Rate: <strong><?php echo $avg["avg"] ?></strong></p>
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
            <div>
                <h3>Rent This Room</h3>
                <form method="post">
                    <div class="mb-3">
                        <label for="enter_date">Enter Date</label>
                        <input type="date" name="enter_date" id="" class="form-control">
                </div>
                    <div class="mb-3">
                        <label for="exit_date">Exit Date</label>
                        <input type="date" name="exit_date" id="" class="form-control">
                        <!-- <label for="exit_date">select package</label>
                        <div class="mb-3">
                            <select  name="location" class="form-select" required>
                            <option value="Egypt">singel 5%</option>
                            <option value="USA">cauple 10%</option>
                            <option value="UK">famly 20%</option>
                            </select>
                        </div>
                        <label for="exit_date">stute</label>
                        <div class="mb-3">
                            <select  name="location" class="form-select" required>
                            <option value="Egypt">vip</option>
                            <option value="USA">normal</option>
                            </select>
                        </div> -->
                        <label for="exit_date">select package</label>
                        <div class="mb-3">
                            <select  name="location" class="form-select" required>
                            <option value="Egypt">normal travelar </option>
                            <option value="USA">vip > 2  (20%)</option>
                            </select>
                        </div>
                        <label for="exit_date">do you  need brekfast</label>
                        <div class="mb-3">
                            <select  name="location" class="form-select" required>
                            <option value="Egypt">yes</option>
                            <option value="USA">no</option>
                            </select>
                        </div>
                </div>
                <button type="submit" name="booking" class="btn btn-primary w-100 btn-change1">Rent</button>
                </form>
            </div>
        </div>
    </div>
    <div class="estate-reviews d-flex flex-column align-items-center">
        <h2>Reviews Section</h2>
        <div class="w-50">
            <form action="" method="post">
                <div class="mb-3">
                    <input type="number" name="rate" min="1" required placeholder="rate" class="form-control" max="5" required>
                </div>
                <div class="mb-3">
                    <textarea name="feedback" id="" class="form-control" placeholder="Review" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 btn-change1" name="review">Create Review</button>
            </form>
        </div>
        <div class="reviews mt-3">
                <?php
                if(!empty($reviews)){
                
            
                foreach($reviews as $review){
                    ?>
                        <div class="review mb-2">
                            <div class="author-info">
                                <p>Name: <?php echo $review["name"] ?></p>
                                <p>Rate: <?php echo $review["rate"] ?></p>
                                <?php
                                if($review["user_id"]==$user->getId() || $user->type=="admin"){
                                    ?>
                                    <div class="actions">
                                        <a href="update_review.php?id=<?php echo $review["id"] ?>&estate_id=<?php echo $_GET["id"] ?>" class="btn btn-primary btn-change3">Edit</a>
                                        <a href="?id=<?php echo $_GET["id"] ?>&review_id=<?php echo $review["id"] ?>" class="btn btn-danger btn-change3">Delete</a>
                                    </div>
                                    <?php 
                                }

                                ?>
                            </div>
                            <?php
                            if(!empty($review["feedback"])){
                                ?>
                                    <p><?php echo $review["feedback"]?> </p>
                                <?php
                            }
                            ?>
                        </div>

                    <?php
                }
            }
                ?>
        </div>
    </div>
    <?php include_once "footer.php" ?>
</body>
</html>