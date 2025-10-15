<?php
include_once dirname(__DIR__, 1) . "\controller\auth\\register.php"
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
        body,
        html {

            height: 100%;
        }

        body {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        
        main {
            background-color: #f5f5f5;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <title>register</title>
</head>

<body class="text-center">
    <?php
    if ($msg) {
    ?>
        <div class="alert-section">
            <div class="alert alert-danger fade show" role="alert">
                <?php echo $msg ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
    }
    ?>
    <main class="form-auth shadow">
        <h1 class="h3 mb-3 fw-normal">Register</h1>
        <form action="" class="mb-3" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="name" name="name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" required placeholder="Password" name="password"></input>
            </div>
            <div class="mb-3">
                <select  name="location" class="form-select" required>
                <option value="Egypt">Egypt</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <option value="KSA">KSA</option>
                <option value="Iraq">Iraq</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="dob" id="" required>
            </div>

            <div class="mb-3">
                <select class="form-select" name="type" id="" required>
                    <option value="host">Host</option>
                    <option value="traveller">Traveller</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea class="form-control" placeholder="Your Info" name="info" rows="3"></textarea>
            </div>
            <button type="submit" name="register" class="btn w-100 btn-primary  btn-change1">Register</button>
        </form>
            <a href="login.php" class="btn btn-outline-secondary mb-1 w-100">Have Account?</a>
    </main>
    <script src="../public/bootstrap.min.js"></script>
</body>

</html>