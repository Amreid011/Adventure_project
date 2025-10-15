<?php

use function PHPSTORM_META\type;

include_once dirname(__DIR__, 1) . "/user.php";
include_once dirname(__DIR__, 1) . "/utils.php";
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}
$user = User::findByID($_SESSION["user"]);
if($user->type!="admin"){
    header("location:home.php");
}
list($admin_count,$host_count,$traveller_count,$user_count,$hotel_count, $competition_count,$volunter_count,$money_spent) = $user->adminStats();

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
        .blocks{
            display: grid;
    grid-template-columns: repeat(auto-fit, minmax(17rem, 1fr));
    gap: 1.5rem;
    max-width: 1200px;
    margin: 16px auto;
    align-items: flex-start;
        }
        .blocks .box{
            border-radius: 0.5rem;
    padding: 2rem;
    background-color: #f5f5f5;
    box-shadow:4px 4px 9px 0px #333;
    border: #333;
    text-align: center;
}
.blocks .box h3{
    font-size: 5rem;
    color: #333;
}
.blocks .box p{
background-color: #fff;
color: #8e44ad;
font-size: 1.6rem;
border-radius: 0.5rem;
border: #333;
}
    </style>
    <title>Document</title>
</head>
<body>
<?php include_once "nav.php" ?>
    <div class="blocks">
        <div class="box">
            <h3><?php echo $admin_count[0]["COUNT(*)"] ?></h3>
            <p>Admins</p>
        </div>
        <div class="box">
            <h3><?php echo $traveller_count[0]["COUNT(*)"] ?></h3>
            <p>Travellers</p>
        </div>
        <div class="box">
            <h3><?php echo $host_count[0]["COUNT(*)"] ?></h3>
            <p>Hosts</p>
        </div>
        <div class="box">
            <h3><?php echo $user_count[0]["COUNT(*)"] ?></h3>
            <p>Total Users</p>
        </div>
        <div class="box">
            <h3><?php echo $hotel_count[0]["COUNT(*)"] ?></h3>
            <p>Total Hotels</p>
        </div>
        <div class="box"> 
            <h3><?php echo $competition_count[0]["COUNT(*)"] ?></h3>
            <p>Competions Count</p>
        </div>
        <div class="box">
            <h3><?php echo $volunter_count[0]["COUNT(*)"] ?></h3>
            <p>Volunters Count</p>
        </div>
        <div class="box">
            <h3><?php echo $money_spent[0]["total"] ?></h3>
            <p>Total Money Spent</p>
        </div>
        <!-- <ul>
        </ul> -->
    </div>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix ">
                        <h2 class="pull-left">user Details</h2>
                        <a href="./register.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <?php
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM user";
                    $link = mysqli_connect('localhost', 'root','' , 'project_soft' );
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Salary</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>" . $row['cash'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        // echo "<td>";
                                            // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            // echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            // echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        // echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>


<?php include_once "footer.php" ?>    
</body>
</html>