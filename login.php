<?php
require_once "core/ini.php";

if(session::exists(config::get("session/session_name")) ){
   
    redirect::to("index.php");
}

if(input::exists()){
        if(token::check(input::get(config::get("session/token_name")))){
            $validate = new validate();  //we can pass the $_post args in __construct method as well actually no need , input class does this 
            $validation=$validate->check($_POST,array(
                "username"=>[   
                                "required"=>true,
                                // "exist"=>"users"
            ],
                "password"=>[
                                "required"=>true,
                                // "pass_matches"=>"password_users",
                ],
            ));
            if($validation->passed()){
                //log the user

                $user=new user();
                $remember=(input::get("remember")=="on")?true:false;
                $login=$user->log(input::get("username"),input::get("password"),$remember);
                if($login){
                    //log the user and set the user_session ;
                    // if(session::exists("logged")){ //when we first launch it (production , we can delete this verification)
                    //     session::delete("logged");
                    // }
                    // session::flash("logged","you have been successfully logged in, enjoy  !");
                    session::flash("messages",array("logged"=>"you have been successfully logged in, enjoy  !"));

                    redirect::to("index.php"); 



                }else {
                    //add the msg error ;
                   echo  $_GLOBALS["ERR"]="the username or the password are incorrect";
                   
                   
                }

            
                
            
            }else {
                //output errors & and inputs /use sessions or globals if in the same page
                foreach($_GLOBALS["ERR"]=$validation->errors() as $error){
                    echo $error."</br>";
                    //should output inputs only when eroors aqcuired !!!
        
                }
                
            }
        }
        if(isset($_GLOBALS["ERR"])){
            unset($_GLOBALS["ERR"]);
        }



              
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOG IN</title>
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

        <h3 class="mt-5">Book</h3>
        <a>
    </div>
    <div class="main">

  
        <form action="" method="POST"> <!--submit back to this page;-->

                <div class="margin">
                        <input type="text" class="un" name="username" required id="username" placeholder=" Choose a username"  value="<?php 
        if(isset($_GLOBALS["ERR"])){echo escape(input::get('username'));}  ?>">

<!-- <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> -->
                </div>

                <div class="margin">
                        <input type="password" class="pass" name="password" id="password" placeholder=" Choose a password"  value="">
                </div>


                <div class="margin d-flex justify-content-around mb-4 align-items-center">
                        <label for="remember" class="form-check-label">remember me :</label>
                        <input type="checkbox" name="remember" id="remember" value="on"> 
                        
                        
                </div>
          
                <button class="submit" type="submit" role="btn" align="center">Log In</button>

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


        
