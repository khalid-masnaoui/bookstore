<?php

class hash{

    //its a one way : so when we want to check a password we should do the same algo with the same salt (thats why the salt is stored in the DB)
    public static function make($string,$salt=""){
        return hash("sha256",$string.$salt);
    }

    public static function salt($length){
        return random_bytes($length);
    }

    public static function unique(){ //for the cookie_hash
        return self::make(uniqid());
    }
}




?>