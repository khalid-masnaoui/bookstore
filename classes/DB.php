<?php
require_once "core/ini.php"; //why including this?

//sigleton_pattern (get_instance);

class DB {
    private static $_instance=null;
    private $_pdo, $_query, $_error=false,$_results,$_count=0;

    private function __construct(){  // use get function to get that 
        try{
            $this->_pdo=new PDO("mysql:host=".config::get("mysql/host").";dbname=".config::get("mysql/db"),config::get("mysql/username"),config::get("mysql/password"));



        } catch(PDOException $e){
            echo $e->getMessage();
            die();
        }


    }
    public static function getInstance(){ //for private and also to chek if already connected (same page---(not refreshing the page !));
        if (!isset(self::$_instance)){
            self::$_instance=new DB();
        }
        return self::$_instance;
    }
    //that is the singeloton pattern (above);

    public function query($sql,$params=[]){ // (when no condition , we pass by it , sinon we pass by action methode then by it)
        $this->_error=false;
        $this->_query=$this->_pdo->prepare($sql);
        if($this->_query){
            $x=1;
            if(count($params)>0)
            {
                foreach($params as $param){
                    //  ;
                    $this->_query->bindValue($x++,$param);
                }
            }

           
            if($this->_query->execute()){
                $this->_results=$this->_query->fetchALL(PDO::FETCH_OBJ);
                $this->_count=$this->_query->rowCount();
         
            }else{
                $this->_error=true;
            }
        }
        return $this; //chainning
        }

    



    private function action($action , $table, $where=[]){
        if(count($where)===3){ //also the case where no conditions are there and u can genrlize it by for each array (multiple conditions)
            $operators=array("=","+","<",">","=>","=<");

            $field=$where[0];
            $operator=$where[1];
            $value=$where[2];
            if(in_array($operator,$operators)){ //no need actually cuz we gonna use the query methode 
                $sql="{$action} FROM {$table} WHERE {$field} {$operator} ? ";
                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }
        }
        return false;///////////////// 
    }

    //get data
    public function get($table,$where){
         return $this->action("SELECT *",$table, $where); //u can pass * in param
    }

    //delete data
    public function delete($table,$where){
        return $this->action("DELETE ",$table, $where); //u can pass * in param
    }

    //insert data
    public function insert($table,$fields=[]){
        if(count($fields)){
            $keys=array_keys($fields);
            $values = "";
            $x=0;
            foreach($fields as $field=>$value){
                ++$x;
                if($x==count($fields)){
                    $values.="?";

                }else{$values.="? ";}                

            }
            $sql="INSERT INTO {$table} (".implode(',',$keys).") values (".implode(', ',explode(' ',$values)).")";
            
            if(!$this->query($sql,array_values($fields))->error()){
                return true; /////////////////
            } 
        }
        return false;/////////////////
    }

        //update data
        public function update($table,$id,$fields=[]){
                $set="";
                $x=0;

                foreach($fields as $field=>$value){
                ++$x;
                if($x==count($fields)){
                    $set.=$field."=?";;

                }else{  $set.=$field."=?,";
                }
                }


                $sql="UPDATE {$table} SET ".$set." WHERE id =?";
                $fields["id"]=$id;

                if(!$this->query($sql,array_values($fields))->error()){
                    return true; ///////////////
                } 
            
            return false; ///////////////
        }
    


    //the resutlts
    public function results(){
        return $this->_results;
    }

    //return only the first result
    public function first(){
        // return $this->_results[0];
        return $this->results()[0];
    }

    public function error(){
    return $this->_error;
    }


    public function count(){
    return $this->_count;
    }




}





?>