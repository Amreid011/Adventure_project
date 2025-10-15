<?php
include_once dirname(__DIR__, 1) . "\controller\auth\login.php"
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
        body,html{

            height: 100%;
        }
        body{
    padding-top: 40px;
    padding-bottom: 40px;
}
main{
            background-color: #f5f5f5;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left:50%;
            transform: translate(-50%,-50%);
        }
    </style>
    <title>Login</title>
</head>

<body class="text-center">
    <?php
    if ($error_msg) {
    ?>
        <div class="alert-section">
            <div class="alert alert-danger fade show" role="alert">
                <?php echo $error_msg ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
    }
    ?>
    <main class="form-auth shadow">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <form action="" class="mb-3" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" required placeholder="Password" name="password"></input>
            </div>
            <button type="submit" class="btn w-100 btn-primary  btn-change1">Login</button>
        </form>
        <div class="d-flex flex-column">
            <a class="btn btn-outline-secondary mb-1" href="register.php" >Need Account?</a>
            <a class="btn btn-outline-secondary mt-1" href="forget_password.php" >Forget Password?</a>
            <a class="btn btn-outline-secondary mt-1" href="home.php" >Home</a>
        </div>
    </main>
    <script src="../public/bootstrap.min.js"></script>
</body>

</html>