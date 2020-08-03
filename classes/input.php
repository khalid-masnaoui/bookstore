<?php
//if the empty(no data SENT) and retrives data


class Input{

    //we can replace this function by a simple if (isset($_post[submit]))
    public static function exists($type="post"){
        switch($type){
            case "post": 
                        return(!empty($_POST)?true:false);
                        break;
            case "get": 
                        return(!empty($_GET)?true:false);
                        break;
            default :
                        return false;
                        break;

        }
    }

    //get the data (used for when errors ) it has that form cuz we r doing it in the same page (so use it directly) (if its wasnt in the same page we gonna still use but not directly !!)
    //better to return the data after sanitizing it
    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        }else if (isset($_GET[$item])){
            return $_GET[$item];

        }else{
            return "";
        }
    }
}






?>