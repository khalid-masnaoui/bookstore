<?php
require_once "core/ini.php";

if(session::exists(config::get("session/session_name")) ){
   
    redirect::to("index.php");
}

if( input::exists()){
    if(token::check(input::get(config::get("session/token_name")))){ //prevent the crsf
    $validate = new validate();  //we can pass the $_post args in __construct method as well actually no need , input class does this 
    $validation=$validate->check($_POST,array(
        "username"=>[   
                        "required"=>true,
                        "min"=>2,
                        "max"=>20,
                        "unique"=>"users"
    ],
        "password"=>[
                        "required"=>true,
                        "min"=>6,
        ],
        "password_again"=>[
                        "required"=>true,
                        "matches"=>"password"

        ],
        "name"=>[
                        "required"=>true,
                        "min"=>2,
                        "max"=>50,
        ],


    ));
    if($validation->passed()){
        //register user
       $user=new user(); //bcuz we throw an error ---we use try
       $salt=hash::salt(32);
       try{
        $user->create(array("username"=>input::get("username"),
                            "password"=>hash::make(input::get("password"),$salt),
                            "salt"=>$salt,
                            "name"=>input::get("name"),
                            "joined"=>date("Y-m-d  h:i:s A"),
                            "grp"=>1,
                            
    ));
        // if(session::exists("register")){ //when we first launch it (production , we can delete this verification)
        //     session::delete("register");
        // }
        // session::flash("register","you have been successfully registred, you can now log in !");
        session::flash("messages",array("register"=>"you have been successfully registred, you can now log in !"));


        redirect::to("index.php");
    }catch(Exception $e){
            //better to redirect to other page;
            die($e->getMessage());
    }
}
        else {
        //output errors & and inputs /use sessions or globals if in the same page
        foreach($_GLOBALS["ERR"]=$validation->errors() as $error){
            echo $error."</br>";
            //should output inputs only when eroors aqcuired !! not outputing when we refresh the page after errors-->$_post isent sent but the items are still there (in the action page !!!!)

        }
    }
    if(isset($_GLOBALS["ERR"])){
        unset($_GLOBALS["ERR"]);}
}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>REGISTRATION</title>
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

body {
    background-color: #eeeeee;
    font-family: 'Ubuntu', sans-serif;
}

.main {
    background-color: #FFFFFF;
    padding: 20px;
    width: 450px;
    margin: 7em auto;
    border-radius: 1.5em;
    box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
}

.sign {
    padding-top: 40px;
    color: #0779e4;
    font-family: 'Ubuntu', sans-serif;
    font-weight: bold;
    font-size: 23px;
}
.margin{
    margin-bottom: 27px;

}
.un {
width: 76%;
color: rgb(38, 50, 56);
font-weight: 700;
font-size: 14px;
letter-spacing: 1px;
background: rgba(136, 126, 126, 0.04);
padding: 10px 20px;
border: none;
border-radius: 20px;
outline: none;
box-sizing: border-box;
border: 2px solid rgba(0, 0, 0, 0.02);
margin-left: 46px;
text-align: center;
font-family: 'Ubuntu', sans-serif;
}

form.form1 {
    padding-top: 40px;
}

.pass {
        width: 76%;
color: rgb(38, 50, 56);
font-weight: 700;
font-size: 14px;
letter-spacing: 1px;
background: rgba(136, 126, 126, 0.04);
padding: 10px 20px;
border: none;
border-radius: 20px;
outline: none;
box-sizing: border-box;
border: 2px solid rgba(0, 0, 0, 0.02);
margin-left: 46px;
text-align: center;
font-family: 'Ubuntu', sans-serif;
}


.un:focus, .pass:focus {
    border: 2px solid rgba(0, 0, 0, 0.18) !important;
    
}

.submit {
  cursor: pointer;
    border-radius: 5em;
    color: #fff;
    background: linear-gradient(to right, #0779e4, #0779e4);
    border: 0;
    padding-left: 40px;
    padding-right: 40px;
    padding-bottom: 15px;
    padding-top: 15px;
    font-family: 'Ubuntu', sans-serif;
    font-size: 13px;
    box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    width: 60%;
    margin-left:20%;
    text-align: center;
}

.forgot {
    text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
    color: #0779e4;
    text-decoration: none;
}
    

    </style>
</head>

<body>
    
<div class="container m-auto text-center">
    <a href="index.php">
        <h3 class="mt-5">Book</h3></a>
    </div>


    <div class="main">

    <p class="sign" align="center">Sign up</p>

    <form action="register.php" method="POST">

    <div class="margin">
        <input type="text" name="username"  required class="un" align="center" id="username" placeholder=" Choose a username"  value="<?php 
        if(isset($_GLOBALS["ERR"])){echo escape(input::get('username'));}  ?>" 
        >
    </div>

    <div class="margin">
        <input type="password" align="center"  required class="pass" name="password" id="password" placeholder=" Choose a password"  value="">
    </div>

    <div class="margin">
        <input type="password" align="center" required class="pass" name="password_again" id="password_again" placeholder=" Repeat your password"  value="">
    </div>

    <div class="margin">
        <input type="text" align="center" required class="un" name="name" id="name" placeholder=" Enter your name"  value="<?php 
        if(isset($_GLOBALS["ERR"])){echo escape(input::get('name'));}  ?>">
    </div>
    <button class="submit" type="submit" role="btn" align="center">Register</button>
    <input type="hidden" name="token" value="<?php  echo token::generate(); ?>">
    

    
    
    
    </form>

    </div>
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