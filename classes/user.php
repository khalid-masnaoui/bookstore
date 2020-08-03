<?php

class user{
    private $_db,$_data,$_sessionName,$_cookieName,$_loggedIn;

    public function __construct($user=null){
        $this->_db=DB::getInstance();
        $this->_sessionName=config::get("session/session_name");
        $this->_cookieName=config::get("remember/cookie_name");

        //after log in , and the redirecting we wanna to know if the user is log in or no !

        //is the user logged in ? //in the session(from page to another) (expire when the session is closed (all the windows))
        if(!$user){
            if(session::exists($this->_sessionName)){
                $user=session::get($this->_sessionName);
                if($user){
                    $this->find($user); //for getting the data in the new page !!
                    $this->_loggedIn=true;
                }else{
                //log out !
                }
            }
        }else{ //for the user!=null --> cookie automatucally logged in
            $this->find($user);
        }


    }

   

    public function create($fields=array()){ //for registring
        if(!$this->_db->insert("users",$fields)){
            throw new Exception("sorry ,a probleme acquired while we were registring you");
        
        }
    //  
    }
    public function update($table,$fields=[],$id=null){ 

        if(!$id && $this->exists()){ //if not defined its for the current user ---> the admin can change users details
            $id=$this->data()->id;
        }
        if(!$this->_db->update($table,$id,$fields)){
            throw new Exception("sorry ,a probleme acquired while we were updating your profile");
        
        }

    }

    public function find($user=null){ //unicité
        if($user){
            $field =(is_numeric($user)?"id":"username");
            $data=$this->_db->get("users",array($field,"=",$user));
            if($data->count()){
                $this->_data=$data->first();
                return true;
            }else{
                return false;
            }
        }
    }

    // delete a user account




//log the user
    public function log($username=null,$password=null,$remember=false){ //null for the remmeber me , automatuclly log in if the cookie/session are good
        if(!$username && !$password && $this->exists()){ //we have the user informations using the user_id and new user(id);
            //log user in 
            session::put($this->_sessionName,$this->data()->id); //equivalent to loggedin=true (using $user= new user())
            


        }else{
            $user=$this->find($username);
            if($user){ //we gonna use the msg (the password is incorrect or the usernamae doesnt exist)
                //cas ou il n y a pas de salt (adminstrator , manuellemenet insere)
                $salt=$this->_data->salt; //use the permission
                if($salt==""){
                    $pass=$password;
                }else{
                    $pass=hash::make($password,$this->_data->salt);
                }

                if($this->_data->password==$pass){
                    session::put($this->_sessionName,$this->data()->id);
                    if($remember){
                        //wanna send a cookie to the user's computer and store it in the DB; (a prb...every user would have a cookie --->a whole additional table!! ---> use jwt)
                        $hash="";
                        $hashCheck=$this->_db->get("users_session",array("user_id","=",$this->_data->id));
                        if(!$hashCheck->count()){//user doesnt have a record in users_session
                            $hash=hash::unique();
                            $this->_db->insert("users_session",array(
                                "user_id"=>$this->_data->id,
                                "hash"=>$hash
                            ));
                        }else{
                            $hash=$hashCheck->first()->hash; //no need , since we gonna delte the record when loging out !! but the cookie can be deleted without logged out (expiration !!!)
                        }
                        
                        cookie::put($this->_cookieName,$hash,config::get("remember/cookie_exp"));
                    }


                    return true;
                }
                return false;
                
                
            }else{
                return false;
            }}

        
    }

    //log out 
    public function logOut(){
        //delete the record from the db
        // $this->_db->delete("users",array("id","=",3));
        $this->_db->delete("users_session",array("user_id","=",$this->data()->id));
        session::delete($this->_sessionName);
        cookie::delete($this->_cookieName);
        

    }
    public function exists(){
        return(!empty($this->_data)?true:false); 
        }

    public function data(){
        return $this->_data;
    }
    public function isLoggedIn(){
        return $this->_loggedIn;
    }
}



?>