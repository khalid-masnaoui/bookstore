<?php
session_start();

$GLOBALS["config"]=array(
    "mysql"=>array(
        "host"=>"127.0.0.1",
        "username"=>"root",
        "password"=>"",
        "db"=>"LRS",
        
    ),
    "remember"=>array(

        "cookie_name"=>"hash",
        "cookie_exp"=>604800 //a month
    ),
"session"=>array(
    "session_name"=>"user",
    "token_name"=>"token"
));

spl_autoload_register("autoload");


function autoload($class){
$path="classes/";
$extension=".php";
$full_Path=$path.$class.$extension;
require_once $full_Path;


}

//the cookie part , logged in automatucally
if(cookie::exists(config::get("remember/cookie_name")) && !session::exists(config::get("session/session_name")) ){
    $hash=cookie::get(config::get("remember/cookie_name"));
    
    $hashCheck=DB::getInstance()->get("users_session",array("hash","=",$hash));
    if($hashCheck->count()){
        $user=new user($hashCheck->first()->user_id);

        $user->log();
        // session::flash("welcome_again"," Welcome again!");
        session::flash("messages",array("welcome_again"=>"Welcome again!"));


    }
}


require_once "functions/sanitize.php";




?>