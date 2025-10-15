<?php
    include_once dirname(__DIR__,1)."\controller\\real_estate\update_real_estate.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <title>Update real state</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php include_once "nav.php" ?>

    <main class="form-auth">
        <h2>Update Real Estate</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input class="form-control" type="text" name="name" value="<?php echo $real_estate["name"] ?>" placeholder="name">
            </div>
            <div class="mb-3">
                <input class="form-control" value="<?php echo $real_estate["rent"] ?>" min="0" type="number" name="rent" id=""  placeholder="rent">
            </div>
            <div class="mb-3">
                <select name="location" class="form-select">
                    
                    <option <?php echo "Egypt"==$real_estate["location"]?"selected":"" ?> value="Egypt">Egypt</option>
                    <option <?php echo "USA"==$real_estate["location"]?"selected":"" ?> value="USA">USA</option>
                    <option <?php echo "UK"===$real_estate["location"]?"selected":""  ?> value="UK">UK</option>
                    <option <?php echo "KSA"==$real_estate["location"]?"selected":"" ?> value="KSA">KSA</option>
                    <option <?php echo "Iraq"==$real_estate["location"]?"selected":"" ?> value="Iraq">Iraq</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea name="description" class="form-control" placeholder="Description" rows="3">
                <?php echo $real_estate["description"] ?>
                </textarea>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" name="file" value="<?php echo $real_estate["image_path"] ?>" id="file">
            </div>
            <button type="submit" class="btn btn-primary w-100  btn-change1">Update</button>
        </form>
    </main>
    <?php include_once "footer.php" ?>
</body>
    
    
