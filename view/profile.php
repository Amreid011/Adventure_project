<?php
include_once dirname(__DIR__, 1) . "/user.php";
include_once dirname(__DIR__, 1) . "/utils.php";

session_start();
authMiddleware();
// if (!isset($_SESSION["user"])) {
//     return header("location:login.php");
// }
$user = User::findByID($_SESSION["user"]);

if (
    isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["email"]) &&
    isset($_POST["location"]) && isset($_POST["dob"])
) 
{
    $user->name = $_POST["name"];
    $user->location = $_POST["location"];
    $user->dob = $_POST["dob"];
    $user->password = $_POST["password"];
    $user->email = $_POST["email"];
    $user->info = $_POST["info"];
    $user->update();
}
$encrypt_name = $user->name;
// $encrypt_name = user::decode_user($user->name);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>Document</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php include_once "nav.php" ?>
    <div class="container">
        <main class="form-auth shadow">
            <h1 class="h3 mb-3 fw-normal">Update Your Profile Info</h1>
            <form action="" class="mb-3" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" value="<?php echo $encrypt_name ?>" placeholder="name" name="name" required>
                </div>
                <div class="mb-3">
                    <input type="email" value="<?php echo $user->email ?>" class="form-control" id="email" name="email" placeholder="Email address" required>
                </div>
                <div class="mb-3">
                    <input type="password" value="<?php echo $user->password ?>" class="form-control" id="password" required placeholder="Password" name="password"></input>
                </div>
                <div class="mb-3">
                    <select name="location" class="form-select">
                        <option <?php echo "Egypt" == $user->location ? "selected" : "" ?> value="Egypt">Egypt</option>
                        <option <?php echo "USA" == $user->location ? "selected" : "" ?> value="USA">USA</option>
                        <option <?php echo "UK" === $user->location ? "selected" : ""  ?> value="UK">UK</option>
                        <option <?php echo "KSA" == $user->location ? "selected" : "" ?> value="KSA">KSA</option>
                        <option <?php echo "Iraq" == $user->location ? "selected" : "" ?> value="Iraq">Iraq</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="date" class="form-control" name="dob" id="" value="<?php echo $user->dob ?>" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Your Info" name="info" rows="3"><?php echo $user->info ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100  btn-change1">Update</button>
            </form>
        </main>
        </div>
    <?php include_once "footer.php" ?>
</body>

</html>