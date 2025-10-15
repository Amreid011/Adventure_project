<?php 
include_once dirname(__DIR__,1)."/controller/search.php";

?>

    <!-- FOOTER -->
    <br><br>

    <footer class="w-100 py-4 flex-shrink-0" style="background-color: var(--bs-gray-dark);">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-4 col-md-6">
                    <h5 class="h1 text-white">Adventure</h5>
                    <p class="small text-muted">Welcome to our Homestays and cultural exchange site!</p>
                    <p class="small text-muted mb-0 ">&copy; Copyrights. All rights reserved. <a class="text-primary amm" href="#"><span>A</span>mr <span>E</span>id</a></p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-3">Quick links</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="./home.php">Home</a></li>
                        <li><a href="./about.php">About</a></li>
                        <?php
            if(!$user){
                ?>
                        <li><a href="./buy_package.php">Get started</a></li>
                <?php
                }
              ?>
                        <li><a href="./qna.php">FAQ</a></li>
                    </ul>
                </div>
                <?php
            if($user){
                ?>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-3">Quick links</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="./view_real_estates.php">Explore</a></li>
                        <li><a href="./view_favorite.php">Favorite</a></li>
                        <li><a href="./view_bookings.php">view_bookings</a></li>
                    </ul>
                </div>
                <?php
                }
              ?>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3">Search</h5>
                    <p class="small text-muted">Whether you're looking for an exotic beach vacation, a cultural tour of a foreign city, or an adrenaline-packed adventure, we've got you covered.</p>
                    <!-- Search.php Link -->
                    <form action="search.php" method="GET">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="search1" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <a href="./search.php" class="btn btn-primary btn-change0" id="button-addon2" type="button"><i class="fas fa-paper-plane">go</i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>
    <script src="../public/bootstrap.min.js"></script>
