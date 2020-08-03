<?php
require_once "core/ini.php";

$user = new user();
if(!$user->isLoggedIn()){
    redirect::to("index.php");
}else {
    $id=$user->data()->id;
     $data=DB::getInstance()->get("users",array("id","=",$id))->first();
    }
     ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/bd6072e88e.js"></script>

<link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <script src="https://kit.fontawesome.com/bd6072e88e.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
                body{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }
        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 70%;
            height: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .profile-edit-btn{
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>
</head>
<body>
<header id="header" id="home" class="bg bg-dark">
                                                                <div class="container ">
                                                                    <div class="row align-items-center justify-content-between d-flex">
                                                                        <div id="logo" class="text-light">
                                                                            <h3 class="text-light"> <i class="fas fa-swatchbook mr-1"></i>Book</h3>
                                                                        </div>
                                                                        <nav id="nav-menu-container">
                                                                            <ul class="nav-menu">
                                                                                <li class="menu-active"><a href="index.php#home">Home</a></li>
                                                                                <li><a href="index.php#about">About</a></li>
                                                                                <li><a href="index.php#fact">Fact</a></li>
                                                                            
                                                                <?php
                                                                                $user=new user();
                                                        if($user->isLoggedIn()){
                                                        ?>



                                                        <li class="menu-has-children"><a  class="text-light"> <?php echo escape($user->data()->username)?>

                                                                <ul>                <li><a href='profile.php'>profile</a></li>
                                                                <li><a href='bookstore.php'>Your BookStore</a></li>

                                                                                 

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


<div class="container emp-profile">
            <form method="post" action="bookstore.php">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                    <?php echo $data->username ?>

                                    </h5>
                                    <h6>
                                        bookStore Owner
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="BookStore"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                           
                            <p>SKILLS</p>
                            <a href="">Management</a><br/>
                            <a href="">Marketing</a><br/>
                            <a href="">Writting</a><br/>
                           
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data->username ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data->name ?></p>
                                            </div>
                                        </div>
                                    
                                     
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>bookStore Owner</p>
                                            </div>
                                        </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </form>           
        </div>

        </body>
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
  
</html>