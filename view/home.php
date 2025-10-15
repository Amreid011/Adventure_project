<?php
 include_once dirname(__DIR__,1)."/utils.php";
//  include_once dirname(__DIR__,1)."\controller\\real_estate\\view_real_estates.php";
 if(!isset($_SESSION)) 
 { 
    session_start();
    authMiddleware();
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
    <title>Adventure</title>
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <main>
        <?php include_once "nav.php" ?>

        
        
        <div class="scrollbar scrollbar-mean-fruit">
          <div class="force-overflow"></div>
          </div>
      <div style="background: url(../public/w4.jpg)" class="jumbotron bg-cover text-white">
        <div class="container py-5 text-center slider1">
            <h1 class="display-4 font-weight-bold amm">Welcome to <span>Adventure</span></h1>
            <p class="font-italic mb-0 text-dark">Welcome to our Homestays and cultural exchange site! We are a team of passionate travel enthusiasts who believe that travel is not just a way to escape the routine of daily life, but also an opportunity to discover new places, connect with different cultures, and create unforgettable memories</p>
           
            <?php
            if(!$user){
              ?>
                  <a class="btn btn-warning  bg-image hover-zoom btn-change0 " href="./buy_package.php" tabindex="-1" aria-disabled="true">start now</a>
            <?php
            }
            else {
            ?>
                <a href="about.php" role="button" class="btn btn-primary mt-2 px-5 btn-change1">About</a>
            <?php
            }
            ?>

        </div>
    </div>







           



    <div class="text-center mt-3">
            <h2>Our Hotels</h2>
            <div class="container mt-3 justify-content-evenly d-flex flex-row flex-wrap home-list">
                
                <?php
                $_GET["type"]="?type=hotel";
                if (!empty($estates)){
                    foreach($estates as $estate){
                ?>
                    <div class="estate shadow my-3 ">
                        <img src="../public/images/<?php echo $estate["image_path"]?>" alt="">
                        <div class="estate-info">
                            <a href="view_real_estate.php?id=<?php echo $estate["id"]?>" class=""><?php echo $estate["name"] ?></a>
                            <p class="ml-3 text-muted">Location: <strong><?php echo $estate["location"] ?></strong></p>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>

            </div>

            <div class="container justify-content-evenly d-flex flex-row flex-wrap home-list">
                <div class="home-list-round">
                    <img src="../public/wh.jpg">
                    <p class="mt-2">test host</p>
                </div>
                
            </div>



            <?php
            if(!$user){
              ?>
                  <a href="./buy_package.php" class="btn btn-primary btn-full mt-2 btn-change1">Explore</a> 
            <?php
            }
            else {
            ?>
                <a href="./view_real_estates.php?type=hotel" class="btn btn-primary btn-full mt-2 btn-change1">Explore Hotels</a> 
            <?php
            }
            ?>
            

        </div>
        <br><br><hr>

        <div class="text-center mt-3">
            <h2>Competition</h2>
            <div class="container justify-content-evenly d-flex flex-row flex-wrap home-list">
                <div class="home-list-round">
                    <img src="../public/wc.jpg">
                    <p class="mt-2">test host</p>
                </div>
                
            </div>
            
            <?php
            if(!$user){
                ?>
                  <a href="./buy_package.php" class="btn btn-primary btn-full mt-2 btn-change1" >Explore</a> 
                  <?php
            }
            else {
                ?>
                <a href="./view_real_estates.php?type=competition" class="btn btn-primary btn-full mt-2 btn-change1">view more</a> 
                <?php
            }
            ?>

        </div>
        <br><br><hr>
        <div class="text-center mt-3">
            <h2>Volunteering</h2>
            <div class="container mt-3 justify-content-evenly d-flex flex-row flex-wrap home-list">
                <div class="home-list-round">
                    <img src="../public/wv.jpg">
                    <p class="mt-2">test host</p>
                </div>
                
            </div>
            
            <?php
                if(!$user){
                    ?>
                    <a href="./buy_package.php" class="btn btn-primary btn-full mt-2 btn-change1" style="margin-bottom: 20px;">Explore</a> 
                    <?php
                }
                else {
                    ?>
                    <a href="./view_real_estates.php?type=volunteering" class="btn btn-primary btn-full mt-2 btn-change1" style="margin-bottom: 20px;">view more</a> 
                    <?php
                }
            ?>

        </div>
    </main>

    <?php include_once "footer.php" ?>












    
    <!-- <script>
let myWindow = document.getElementById("myBtn");


function openPopup() {
  // يفتح نافذة جديدة ويحفظ مرجع النافذة في متغير لاستخدامه لاحقًا
  myWindow = window.open("", "myWindow", "width=200, height=100");
  myWindow.document.write("<p>This is my pop-up window!</p>");
}

function closePopup() {
  // يغلق النافذة المفتوحة إذا كانت مفتوحة
  if (myWindow) {
    myWindow.close();
  }
}

// let mybutton = document.getElementById("myBtn");

// function scrollFunction() {
//   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//     mybutton.style.display = "block";
//   } else {
//     mybutton.style.display = "none";
//   }
// }
            </script> -->







</body>
</html>