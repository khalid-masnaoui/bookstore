<?php 
require_once "core/ini.php";




?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Author Meta -->
    <meta name="author" content="Sondos_Onlg">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Book</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">

    <!--CSS============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <script src="https://kit.fontawesome.com/bd6072e88e.js"></script>

    <link rel="stylesheet" href="css/main.css">

    <style>
        .alert2{
           position : fixed !important;
            z-index:999999999;
        }
        .banner-area{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff) !important;
        }
        .counter{
            color: #3931af !important;
        }
        .footer-area{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff) !important;
            color: black;
        }
        
    </style>
</head>

<body>
    <?php
if(Session::exists("messages") ){
    $session=session::get("messages");
    $key=array_keys($session)[0];

    $msg=session::flash("messages")[$key];



    echo      "<div class='alert alert2 alert-success alert-dismissible fade show' role='alert'>
    <strong>".$msg."
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button> </div>";
}
    ?>

            <header id="header" id="home">
                <div class="container">
                    <div class="row align-items-center justify-content-between d-flex">
                        <div id="logo" class="text-light">
                            <h3 class="text-light"> <i class="fas fa-swatchbook mr-1"></i>Book</h3>
                        </div>
                        <nav id="nav-menu-container">
                            <ul class="nav-menu">
                                <li class="menu-active"><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#fact">Fact</a></li>
                                                                                                        
                                                                                            <?php
                                                                                                            $user=new user();
                                                                                    if($user->isLoggedIn()){
                                                                                    ?>



                                                                            <li class="menu-has-children"><a  class="text-light"> <?php echo escape($user->data()->username)?></a>!</p>

                                                                                    <ul>                <li><a href='profile.php'>profile</a></li>
                                                                                    <li><a href='bookstore.php'>Your BookStore</a></li>

                                                                                                        <li><a href='update.php'>update profile</a></li> 

                                                                                                            <li><a href='logout.php'>Log Out</a></li>

                                                                                        




                                                                                    </ul>
                                                                            <?php
                                                                            }else{
                                                                            ?>

                                                                                    <li><a href="login.php">Login</a></li>
                                                                                    <li><a href="register.php">Register</a></li>
                                                                            <?php

                                                                            }
                                                                            ?>
                                                                                                    
                                                                                                </ul>
                                                                                            </nav>
                                                                                            <!-- #nav-menu-container -->
                                                                                        </div>
                                                                                    </div>
            </header>
    <!-- #header -->


    <!-- start banner Area -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-start">
                <div class="banner-content col-lg-7">
                    <h5 class="text-white text-uppercase">Creator: Sondos Onlg</h5>
                    <h1 class="text-uppercase">
                        Manage Your BookStore
                    </h1>
                    <p class="text-white pt-20 pb-20">
                        Our bookstore system provides you with a simple user-friendly, straightforward way to manage your store, no matter how vast your selection of books. Track your store's books to keep up with what your customers are needing, create new books fields all
                        with entering the necessary information (price , publisher..).
                    </p>
                    <a href="register.php" class="primary-btn text-uppercase">Get Started</a>
                </div>
                <div class="col-lg-5 banner-right">
                    <img class="img-fluid" src="img/header-img.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start about Area -->
    <section class="section-gap info-area" id="about">
        <div class="container">
            <div class="single-info row mt-40 align-items-center">
                <div class="col-lg-6 col-md-12 text-center no-padding info-left">
                    <div class="info-thumb">
                        <img src="img/about-img.jpg" class="img-fluid info-img" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 no-padding info-rigth">
                    <div class="info-content">
                        <h2 class="pb-30">Sondos Onlg</h2>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi minus quisquam tempora corporis earum, quod, nisi dolorem placeat veritatis culpa voluptatum eum ducimus iure esse.
                        </p>
                        <br>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, et perspiciatis nemo facere nesciunt, voluptatum iusto vero vitae aut eveniet aliquam facilis, corporis quidem. Ut voluptate architecto sapiente, eius ullam atque porro blanditiis veniam.
                            Expedita hic quisquam ipsam sunt temporibus eaque. Velit expedita et enim quam, adipisci totam quod, vel doloribus earum, cum dolor alias?
                        </p>
                        <br>
                        <img src="img/signature.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End about Area -->

    <!-- Start fact Area -->
    <section class="fact-area relative section-gap" id="fact">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-40 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Some Features that Made us Unique</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End fact Area -->

    <!-- Start counter Area -->
    <section class="counter-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">2536</h1>
                        <p>Happy Clients</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">6784</h1>
                        <p>Total BookStor created</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">12239</h1>
                        <p>User Submitted</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end counter Area -->


    <!-- Start testomial Area -->
    <section class="testomial-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">What our Bookstore's managers Say about us</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="active-tstimonial-carusel">
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t1.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t2.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t3.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t1.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t2.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t3.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t1.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t2.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                    <div class="single-testimonial item">
                        <img class="mx-auto" src="img/t3.png" alt="">
                        <p class="desc">
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware and more. laptop accessory
                        </p>
                        <h4>Mark Alviro Wiens</h4>
                        <p>
                            CEO at Google
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End testomial Area -->


    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
                        </p>
                        <p class="footer-text">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                             </script> All rights reserved | colorlib. 
                             <!-- this template is from the colorlib website -->
                        </p>
                    </div>
                </div>
                <div class="col-lg-5  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">
                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                                <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                </div>

                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/easing.min.js"></script>
    <script src="js/hoverIntent.js"></script>
    <script src="js/superfish.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/main.js"></script>
</body>

</html>