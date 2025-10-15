<?php
session_start();
include_once dirname(__DIR__,1)."\controller\\booking\\view_bookings.php";

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
        .bookings-list{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .booking{
            width: 40%;
            background-color: #bdc3c7;
            border-radius: 4px;
            padding: 4px;
        }
    </style>
    <title>Document</title>
</head>
<body>
<?php include_once "nav.php" ?>
    <div class="container">
        <?php
        if (!empty($bookings)){
            if($user->type=="host"){
                ?>
                
                    <div class="bookings-list mb-3">
                        <?php
                            foreach($bookings as $book){
                                ?>
                                <div class="booking mt-3">
                                    <div class="info d-flex">
                                        <p>Hotel: <?php echo $book["estate_name"] ?></p>
                                        <?php
                                        if($book["status"]=="Accepted"){
                                            ?>
                                            <a href="../controller/booking/handle_booking.php?booking=<?php echo $book["id"] ?>&estate=<?php echo $book["estate_id"]?>&user=<?php echo $book["user_id"]?>&status=Canceled" class="btn btn-danger btn-change3">Decline</a>
                                            <?php
                                        }else{
                                            ?>
                                        <a href="../controller/booking/handle_booking.php?booking=<?php echo $book["id"] ?>&estate=<?php echo $book["estate_id"]?>&user=<?php echo $book["user_id"]?>&amount=<?php echo $book["rent"]?>&status=Accepted" style="margin-left: auto;" href="" class="btn btn-success btn-change3">Accept</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <p>Status: <?php echo $book["status"]?></p>
                                    <p>price: <?php echo $book["rent"]?></p>
                                    <div class="user-info d-flex flex-column">
                                        <a href="chat.php?user=<?php echo $book["user_id"]?>">Traveller: <?php echo $book["user_name"] ?></a>
                                        <div class="d-flex">
                                            <p class="me-2">Enter Date: <?php echo $book["enter_date"] ?></p>
                                            <p class="ml-2">Exit Date: <?php echo $book["exit_date"] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                
                <?php
            }else{
                ?>
                <div class="bookings-list mb-3">
                    <?php
                        foreach($bookings as $book){
                            ?>
                            <div class="booking mt-3">
                                <div class="info d-flex">
                                    <p>Hotel: <?php echo $book["name"] ?></p>
                                    <a href="../controller/booking/handle_booking.php?booking=<?php echo $book["id"] ?>&estate=<?php echo $book["estate_id"]?>&user=<?php echo $user->getId()?>&status=Canceled" style="margin-left:auto;" class="btn btn-danger btn-change3">Cancel</a>
                                </div>
                                <p>Status: <?php echo $book["status"]?></p>
                                <p>price: <?php echo $book["rent"]?></p>
                                <div class="user-info d-flex flex-column">
                                    <div class="d-flex">
                                        <p class="me-2">Enter Date: <?php echo $book["enter_date"] ?></p>
                                        <p class="ml-2">Exit Date: <?php echo $book["exit_date"] ?></p>
                                    </div>
                                </div>
                            </div>
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



