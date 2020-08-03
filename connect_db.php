<?php
$host="127.0.0.1";
$dbname="LRS";
$user_name="root";
$password="";

try{
    $db=new PDO("mysql:host=$host;dbname=$dbname",$user_name,$password);
}catch(PDOException $e){
    echo "Eroor : ".$e->getMessage();
}



?>