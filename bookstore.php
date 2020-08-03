<?php
require_once "core/ini.php";

require_once("./php/copmnt.php");
require_once("connect_db.php");

$user=new user();
$user_id = $user->data()->id;
// $db=DB::getInstance();

 try{
    $db->setATTribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $stmt=$db->prepare("SELECT * FROM BOOKS WHERE USER_ID=$user_id");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $N=count($result);
    }catch(PDOException $e){
        echo "Eroor : ".$e->getMessage();
    }

if(isset($_SESSION["ERR"])){
    $name_ERR=$_SESSION["ERR"]["name"];
    $publisher_ERR=$_SESSION["ERR"]["publisher"];
    $id_input=$_SESSION["inputs"]["id"];
    $name_input=$_SESSION["inputs"]["name"];
    $publisher_input=$_SESSION["inputs"]["publisher"];
    $price_input=$_SESSION["inputs"]["price"];

    unset($_SESSION["ERR"],$_SESSION["inputs"]);

}

if(!isset($_SESSION["ERR1"]) and isset($_SESSION["disabled"])){
    unset($_SESSION["disabled"]);
}
$attr1="";
$attr2="disabled";
if(isset($_SESSION["disabled"])){
    $attr1="disabled";
    $attr2="";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD with PHP/JS</title>
    <script src="https://kit.fontawesome.com/bd6072e88e.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <script src="https://kit.fontawesome.com/bd6072e88e.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<style>
             body{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff) !important;
        }
</style>
<body>
<main>
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



                                                        <li class="menu-has-children"><a  class="text-light"> <?php echo escape($user->data()->username)?></a></p>

                                                                <ul>                <li><a href='profile.php'>profile</a></li>
                                                                <li><a href='bookstore.php'>Your BookStore</a></li>

                                                                                   

                                                                                        <li><a href='logout.php'>Log Out</a></li>

                                                                    




                                                                </ul>
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
    <!-- #header -->

<?php
//{}
if(isset($_SESSION["action"])){
$action=$_SESSION["action"];
switch($action){
    case "ADD":
        echo "<div class='mb-3 py-2  text-center  bg-success'><span class='align-middle'> Record added 
        </span><br></div>";
        unset($_SESSION["action"]);
    break;
    case "UPDATED":
        echo "<div class='mb-3 py-2  text-center bg bg-success'><span class='align-middle'> Record updated 
        </span><br></div>";
        unset($_SESSION["action"]);

    break;
    case "DELETED":
        echo "<div class='mb-3 py-2  text-center bg bg-warning'><span class='align-middle'> Record delted 
        </span><br></div>";
        unset($_SESSION["action"]);

    break;
    default:
    
}}

?>
<section class="mt-5">
    <div class="container text-center">
        <h1 class="py-4 bg bg-dark text-light rounded"> <i class="fas fa-swatchbook"></i> Book Store</h1>
    
    <div class="d-flex justify-content-center">
        <form action="process.php" method="post" class="w-50">
        <!-- //the input elements -->
            <div class="pt-2">
                <?php

                //the moment the information sent ,,we take in consideration the actual inputs !
                
            //the disabled attr will create a prb here!!! so use readonly
                inputElement("<i class='fas fa-id-badge'></i>","ID","book_id","ID","readonly='readonly'");
                ?>
               
            </div>
            <div class="pt-2">
                <?php
                $value2="";
                if(isset($name_input)){
                    $value2=$name_input;
                }
                inputElement("<i class='fas fa-book'></i>","Book name","book_name",$value2,"");
                ?>
                <?php
                    if(isset($name_ERR) and $name_ERR!=""){
                        echo "<span class='alert alert-danger'>$name_ERR</span>";
                    }
                ?>
            </div>
            <div class="row pt-2">
                <div class="col">
                <?php
                $value3="";
                if(isset($publisher_input)){
                    $value3=$publisher_input;
                }
                inputElement("<i class='fas fa-people-carry'></i>","Publisher","book_publisher",$value3,"");
                ?>
                <?php
                    if(isset($publisher_ERR) and $publisher_ERR!=""){
                        echo "<span class='alert alert-danger'>$publisher_ERR</span>";
                    }
                ?>
                </div>
                <div class="col">
                <?php
                $value4="";
                if(isset($price_input)){
                    $value4=$price_input;
                }
                inputElement("<i class='fas fa-dollar-sign'></i>","Book price","book_price",$value4,"");
                ?>

                <input type="hidden" name="user_id" value= <?php echo escape($user->data()->id)?>>
                </div>
            </div>
    <!-- //the buttons -->
            <div class="d-flex justify-content-center">
                <?php
            
                buttonElement("btn btn-success","btn_create","<i class='fas fa-plus'></i>","Create","data-toggle='tooltip' data-placement='bottom' title='Create' $attr1'");
                ?>
                <?php
                buttonElement("btn btn-primary","btn_read","<i class='fas fa-sync'></i>","Read","data-toggle='tooltip' data-placement='bottom' title='Read' $attr1");
                ?>
                <?php
                
                
                buttonElement("btn btn-light border","btn_update","<i class='fas fa-pen-alt'></i>","Update","data-toggle='tooltip' data-placement='bottom' title='Update' $attr2");
                ?>
                 <?php
                buttonElement("btn btn-danger ","btn_delete","<i class='fas fa-trash-alt'></i>","Delete","data-toggle='tooltip' data-placement='bottom' title='Delete' $attr2");
                ?>
                  <?php
                  if($N>3){
                echo buttonElement("btn btn-danger ","btn_delete_all","<i class='fas fa-trash-alt'> ALL</i>","Delete_All","data-toggle='tooltip' data-placement='bottom' title='Delete_All' ");}
                ?>


            
            
            </div>
        
        
        
        
        </form>
    </div>

    <!-- //tables -->

    <div class="d-flex table-data justify-content-center">
    <table class="table table-striped table-dark">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Book Name</th>
                <th>Publisher</th>
                <th>Book price</th>
                <th>Edit</th>
            </tr>
        
        </thead>
        <tbody>

<!-- //displaying the data from the databse -->

        <?php if(count($result)) {
                
                foreach($result as $row) { 

           ?>
            <tr>
                <td class="book_id"><?php echo $row["book_id"]  ?></td>
                <td class="book_name"><?php echo $row["book_name"]  ?></td>
                <td class="book_publisher"><?php echo $row["publisher"]  ?></td>
                <td class="book_price"><?php echo $row["book_price"]." $"  ?></td>
                <td><i class="fas fa-edit edit"></i></td>
                <!-- hidden input --only one-- use js , when click to edit button -..value changed to the hidden input 
                and then if(isset($_POST['id']))
  {
    $id = $_POST['id']; 
                -->
            
            
            </tr>
            <?php  }  }
            

           ?>
        
        
        </tbody>
    
    </table>
    </div>
   </div>
  </section>
</main>







    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="js/vendor/jquery-2.2.4.min.js"></script>

    <script src="js/vendor/bootstrap.min.js"></script>
 
    <script src="js/main.js"></script>
</body>
</html>