<?php

//generating tokens (against CSRF) (bloquer les submits venant d'autres sources qu'à la formulaire (url...))
class token {
    public static function generate(){
        return session::put(config::get("session/token_name"),md5(uniqid()));// (better using random_baytes(32 instead of unique(id)) )
    
    }

    public static function check($token){
        $tokenName=config::get("session/token_name");
        if(session::exists($tokenName)   && $token==session::get($tokenName)){ //use also time_delai_ for the session (time()-session[]<=delai)
            session::delete($tokenName);
            return true;
        }else {
            return false;
        }
    }
}



?>