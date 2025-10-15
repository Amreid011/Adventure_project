<?php
include_once dirname(__DIR__,1)."\user.php";
include_once dirname(__DIR__,1)."/controller/search.php";


if(isset($_GET["logout"])){
    session_destroy();
    setcookie("token","",time()+5,"/","",false,true);
    header("location:login.php");
}

$user = null;
if(isset($_SESSION["user"])){
    $user= User::findByID($_SESSION["user"]);
}
?>





<nav class="navbar navbar-expand-lg navbar-light  rounded" id="navbar" aria-label="Eleventh navbar example" style="background-color: var(--bs-purple);">
        <div class="container-fluid">
          <a class="navbar-brand" href="home.php">
            <img src="../public/logo1.jpg" width="45" alt="" class="d-inline-block align-middle mr-2 bg-image hover-zoom rounded-circle border border-info">
             Adventure
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- <li class="nav-item">
                <a class="nav-link active btn btn-outline-secondary" aria-current="page" href="#">Home</a>
              </li> -->
              <?php
              if($user){
                ?>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary me-1" href="view_real_estates.php">Explore</a>
              </li>
              <?php
                }
              ?>
              <!-- <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary" href="search.php" tabindex="-1" aria-disabled="true">Search</a>
              </li> -->
              <?php
              if($user){
                ?>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary me-1" href="view_bookings.php" tabindex="-1" aria-disabled="true">View Bookings</a>
              </li>
              <?php
                }
              ?>
              <?php
              if($user && $user->type!=="traveller"){
                ?>
                <li class="nav-item">
                  <a class="nav-link btn btn-outline-secondary me-1" href="create_real_estate.php" tabindex="-1" aria-disabled="true">Create Hotel</a>
                </li>
                <?php
              }
              ?>
              <?php
              if($user && $user->type==="admin"){
                ?>
                <li class="nav-item">
                  <a class="nav-link btn btn-outline-secondary me-1" href="controll_panal.php" tabindex="-1" aria-disabled="true">Controll Panal</a>
                </li>
                <?php
              }
              ?>
              <?php
            if($user){
                ?>
                <li class="nav-item">
                  <a class="nav-link btn btn-outline-secondary me-1" href="./view_favorite.php" tabindex="-1" aria-disabled="true">Show Favorite</a>
                </li>
                <?php
              }
              ?>
              <li class="nav-item ">
                <a class="nav-link btn btn-outline-secondary me-1" href="about.php" tabindex="-1" aria-disabled="true">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary me-1" href="qna.php" tabindex="-1" aria-disabled="true" style="margin-right: 15px;">Q&A</a>
              </li>
              <li class="nav-item">
                <button class="btn btn-dark toggle mr-1 btn-change0">DARK</button>
              </li>
              <?php
            if(!$user){
              ?>
                <li class="nav-item">
                  <a class=" btn btn-warning mx-3 bg-image hover-zoom  btn-change3 " href="./buy_package.php" tabindex="-1" aria-disabled="true">start now</a>
                </li>
                <?php
            }
            ?>
            </ul>
            <nav class="navbar bg-body-tertiary">
              <div class="container-fluid">
                <form class="d-flex" role="search" method="GET">
                  <input class="form-control me-2" type="search" name="search1" placeholder="Search" aria-label="Search">
                  <a href="search.php" class="btn btn-success me-1 btn-change0" role="button" >Search</a>
                </form>
              </div>
            </nav>

            <?php
            if($user){
              if( $user->type==="admin"){
                ?> <a href="profile.php"> <img style="width:45px;" class="border border-danger rounded-circle me-1" src="../public/admin.jpg"></a> <?php
              }
              if( $user->type==="host"){
                ?> <a href="profile.php"> <img style="width:45px;" class="border border-success rounded-circle me-1" src="../public/host.jpg"></a> <?php
              }
              if( $user->type==="traveller"){
                ?> <a href="profile.php"> <img style="width:45px;" class="border border-info rounded-circle me-1" src="../public/trav.jpg"></a> <?php
              }
              ?> <a href="?logout" class="btn btn-primary me-2 btn-change0">Logout</a> <?php
            }else{
                ?> 
            <div class="d-flex">
                <a href="login.php" class="btn btn-primary me-2 btn-change0">Login</a>
                <a href="./buy_package.php" class="btn btn-primary  btn-change0">Signup</a>
            </div>
                <?php
            }
            ?>
          </div>
        </div>
</nav>


        <?php
            if($user){
              ?>
                  <a href="chat_list.php">
                    <button onclick="topFunction()" id="myBtn" title="Go to top">chat</button>
                  </a> 
                <?php
            }
            ?>



<script>
  const toggle = document.querySelector(".toggle");
  toggle.addEventListener("click",(e)=>{
    document.body.classList.toggle("dark-mode")
  })
</script>
<?php
    if (isset($_SESSION["msg"])&&!empty($_SESSION["msg"])) {
    ?>
        <div class="alert-section">
            <div class="alert alert-<?php echo$_SESSION["msg_type"] ?> fade show" role="alert">
                <?php viewSessionMsg() ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
    }
    ?>  