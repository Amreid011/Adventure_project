<?php
    include_once dirname(__DIR__,1)."\controller\\reviews\\update_review.php"
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
<main class="form-auth">
    <h2>Update Review</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="">Rate:</label>
            <input type="number" min="1" max="5" name="rate" value="<?php echo $review["rate"] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Feedback:</label>
            <textarea name="feedback" class="form-control" rows="3"><?php echo $review["feedback"] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-change1">Update</button>
    </form>

</main>
    <?php include_once "footer.php" ?>
</body>
</html>