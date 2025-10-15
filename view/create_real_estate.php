<?php
session_start();
include_once dirname(__DIR__, 1) . "\controller\\real_estate\create_real_estate.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>create real state</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php include_once "nav.php" ?>

    <main class="form-auth">
        <h2>Create Real Estate</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input class="form-control" type="text" name="name" required placeholder="name">
            </div>
            <div class="mb-3">
                <input class="form-control" type="number" name="rent" id="" required placeholder="rent">
            </div>
            <div class="mb-3">
                <select name="location" class="form-select" required>
                    <option value="Egypt">Egypt</option>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="KSA">KSA</option>
                    <option value="Iraq">Iraq</option>
                </select>
            </div>
            <div class="mb-3">
                <select name="type" class="form-select" required>
                    <option value="hotel">Hotel</option>
                    <option value="volunteering">Volunteering</option>
                    <option value="competition">Competition</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea name="description" class="form-control" placeholder="Description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" name="file" required id="file">
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-change1">Create</button>
        </form>
    </main>
    <?php include_once "footer.php" ?>
</body>

</html>