<?php
include_once dirname(__DIR__,1)."/controller/search.php";

if(!isset($_SESSION)){
    session_start();
}
// echo $_GET["search1"];
?>
<!-- // // value="<?//php echo $_GET["search1"] ?>" -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>Search</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .yy{
            margin-left: 20px;
            margin-top: 20px;
            height: 40px;
        }
        body{
            text-align: center;
        }
    </style>
</head>
<body>
<?php include_once "nav.php" ?>

    <div class="container d-flex flex-column align-items-center justify-content-center">
        <form action="" method="get" class="d-flex">
            <div class="me-3">
                <label for="">Search</label>
                <input type="text" placeholder="Enter Your Search Term" name="search1"  class="form-control">
            </div>
            <div class="mb-3">
            <label for="">Filter Location</label>
                <select name="location" class="form-select" required>
                    <option value="Egypt">Egypt</option>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="KSA">KSA</option>
                    <option value="Iraq">Iraq</option>
                </select>
            </div>
            <a href="search.php" class="btn btn-success me-1 btn-change0 yy" role="button" >Search</a>
        </form>
        <h2 class="mt-3" style="text-decoration: underline;">Results</h2>
    </div>


        
                <?php
                   
                    if(isset($result)){
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
 
                    
                    ?>



    <?php include_once "footer.php" ?>
</body>
</html>