<?php
require_once "core/ini.php"; //why ?--> for the sanitize

class validate {

    private $_passed=false,$_errors=[],$_db=null;


    public function __construct(){
        $this->_db=DB::getInstance();
    }

    public function check($source,$items=[]){
        foreach($items as $item=>$rules){
            $value= $source[$item];
            foreach($rules as $rule=>$rule_value){
                if($rule ==="required" && empty($value)){ //or use $rule_value
                    $this->addError("{$item} is required"); //using key value pair error , we wont need to that
                }else { 
                    $y=0;
                    ///the required is alone , cuz here we should use the 3 functions (trim , escape, slashes)
                    switch($rule){
                        
                        case "min":
                                if(strlen($value)<$rule_value && strlen($value)>0 ){
                                    $this->addError("{$item} is too short : {$item} must be a minimun of {$rule_value} caracters");
                                }
                                break;
                        case "max":            
                            if(strlen($value)>$rule_value){
                            $this->addError("{$item} is too long :  {$item} must be a minimun of {$rule_value} caracters");
                        }
                        break;

                        case "matches":

                            if($value!=$source[$rule_value]){
                                $this->addError("the passwords must be matched");
                            }
                            
                        break;

                        case "unique":
                            // $user=DB::getInstance()->get("users",["username","0",$value])->count();
                            $user=$this->_db->get($rule_value,[$item,"=",$value])->count();
                            if($user>0){
                                $this->addError("this username is already taken");
                            }

                            ;
                        break;
                        //we onna check the log in validation on the user class
                        // case "exist":
                        //     // $user=$this->_db->get($rule_value,[$item,"=",$value])->count();
                        //     // if($user==0){
                        //     //     
                        //     //     $this->addError("no such username");
                        //     // }
                        //     //its better to keep the class focusing on just only one function

                        //     $user=new user();
                        //     $out=$user->find($value);
                        //     if(!$out){
                        //         $y=1;
                        //         $this->addError("no such username");
                        //     }

                        //     ;
                        // break;
                        // case "expass_matches": //based on the username result bcuz username is unique!!!
                        //     if($y==1){
                        //     break;
                        //     }else{
                        //         $user=new user();
                        //         $username=$user->data();
                        //         $salt=$user->salt;
                        //         $password=$user->password;
                        //         $password_inp=hash::make(input::get($item),$salt);
                        //         if($password!=$password_inp){
                        //             $this->addError("password incorrect");
                        //         }
                        //     }
                            
                                
                            }

                            
                       //stupid break (a break was here  by error (in the end of the project) costed me so much time)
                    }
                }
                
            }
        
        if(empty($this->_errors)){
            $this->_passed=true;
        
        
        }
        return $this;
    }


    private function addError($error){ //better to do a key value error to display errors
        $this->_errors[]=$error;

    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
}




















?>