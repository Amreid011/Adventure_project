<?php
include_once dirname(__DIR__, 1) . "/user.php";
include_once dirname(__DIR__, 1) . "/utils.php";
session_start();


$user = null;
if(isset($_SESSION["user"])){
    $user= User::findByID($_SESSION["user"]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>FAQS</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<?php include_once "nav.php" ?>



<?//php include_once "./about/index.php" ?>
<h1 style="text-align: center; margin: 10px; color: var(--bw-wb);" class="b_to_w">this page is About</h1><br>

      
      
<?php include_once "footer.php" ?>

</body>
</html>




<?php
//header("location:./about/index.php");
?>