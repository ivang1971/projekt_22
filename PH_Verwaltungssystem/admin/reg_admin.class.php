<?php
class RegisterAdmin{

    private $username;
    private $password;
    public $error;
    public $success;
    private $storage = "admin_data.json";
    private $stored_admins;
    private $new_admin;


    public function __construct($username,$password){

        $this->username = trim($this->username);
        $this->username = filter_var($username);

        $this->password = trim($this->password);
        $this->password = filter_var($password);

        $this->stored_admins = json_decode(file_get_contents($this->storage), true);

        $this->new_admin = [
            "username" => $this->username,
            "password" => $this->password,
        ];

        if($this->checkFieldValues()){
            $this->insertUser();
        }

        if($this->checkFieldValues()){
            $this->deleteUser();
        }
    }




    private function checkFieldValues(){

        if(empty($this->username) || empty($this->password)){
            $this->error ="All fields are required.";
            return false;
        }else{
            return true;
        }

    }



    private function usernameExists(){
        foreach($this->stored_admins as $admin){
            if($this->username == $admin["username"]){
               $this->error = "Username is already taken, please choose a different one.";
               return true;
            }
        }

        return false;
    }

    private function insertUser(){
        if($this->usernameExists() == FALSE){
            array_push($this->stored_admins, $this->new_admin);
            if(file_put_contents($this->storage, json_encode($this->stored_admins, JSON_PRETTY_PRINT))){
                return $this->success = "Your registration ist successful";
            }else{
                return $this->error = "Something went wrong,please try again";
            }
        }
    }

    private function deleteUser(){
        for($i = 0; $i < count($this->stored_admins) - 1; $i++){
            if ($this->stored_admins[$i]['username'] == $this->username){
                unset($this->stored_admins[$i]);
            }
        }
        $this->stored_admins = array_values($this->stored_admins);

        if(file_put_contents($this->storage, json_encode($this->stored_admins, JSON_PRETTY_PRINT))){
            return $this->success = "Datei gelöscht";
        }else{
            return $this->error = "Bitte versuchen Sie noch einmal";
        }
            
    }

}
?>