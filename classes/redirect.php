<?php

class redirect {

    public static function to($page_name=""){
        if($page_name){
                // the other cases ; errors pages
                if(is_numeric($page_name)){
                    switch($page_name){
                        case 404:
                                header("HTTP/1.0 404 Not Found"); //still the same page , but forcing an 404 error
                                include "includes/errors/404.php";//Il y a deux en-têtes spéciaux. Le premier commence par la chaîne "HTTP/" (insensible à la casse), qui est utilisée pour signifier le statut HTTP à envoyer. Par exemple, si vous avez configuré Apache pour utiliser les scripts PHP pour gérer les requêtes vers des fichiers inexistants (en utilisant la directive ErrorDocument), assurez-vous que le script génère un code statut correct.
                                exit();
                                break;
                    }
                }



                // $path=$page_name.".php"; if not all files in have the same directory
                header("location:".$page_name);
                exit();
        }
       
    }

}

?>


