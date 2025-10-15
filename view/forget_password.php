<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>Forget Password</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body,html{

            height: 100%;
        }
        body{
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: var(--bs-light);
    text-align: center;
        }
        main{
            background-color: #ffff;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left:50%;
            transform: translate(-50%,-50%);
        }
    </style>
</head>
<body>
<?php
    if (isset($_GET["sent"])) {
    ?>
        <div class="alert-section">
            <div class="alert alert-success fade show" role="alert">
                We sent email with all required steps to rest password
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
    }
    ?>
    <main class="form-auth shadow">
        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>
        <form action="?sent" class="mb-3" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
            </div>
            <button type="submit" class="btn w-100 btn-primary btn-change1">Reset Password</button>
        </form>
        <a class="btn btn-outline-secondary w-100 " href="login.php" >Login</a>
    </main>
<script src="../public/bootstrap.min.js"></script>
</body>
</html>