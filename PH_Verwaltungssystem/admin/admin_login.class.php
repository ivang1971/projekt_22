<?php

class LoginAdmin{

   private $username;
   private $password;
   public $error;
   public $success;
   private $storage = "admin/admin_data.json";
   private $stored_admins;


   public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
        $this->stored_admins = json_decode(file_get_contents($this->storage), true);
        $this->login();
   }


   public function login(){
        foreach ($this->stored_admins as $admins){
            if($admins["username"] == $this->username){
                if($this->password == $admins["password"]){
                    session_start();
                    $_SESSION["admins"] = $this->username;
                    header("location: admin/user_table.php"); exit();
                }
            }
        }
   }


}

?>