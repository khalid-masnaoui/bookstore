<?php
class cookie {

        public static function exists($name){
            return(isset($_COOKIE[$name])?true:false);
        }
        public static function get($name){
            //we can invke the exists method here
            return $_COOKIE[$name];
        }
        public static function put($name,$value,$expiry){
            if(setcookie($name,$value,time()+$expiry)){
                return true;
            }else{
                return false;
            }
        }
        public static function delete($name){
            
            if(self::exists($name)){
                self::put($name,"",time()-1);
                
            }
        }



}


?>