<?php

/* 
 * All the database operations are defined in the Model Class
 */

Class Model {
    
    public $connection,$database,$tablename;
    
    /* Initialize mysql connection, database and table replace the servername, username and password as required */
    function __construct() {
        $this->connection = mysqli_connect("localhost", "root", "");
        $this->database = "hype_db";
        $this->tablename = "distributors";
    }
    
    /* Select user using the username and password fields */
    public function select_user($data) {
        if($this->user_exists("username",$data["username"])) {
            mysqli_select_db($this->connection, $this->database);
            $password_hash = $this->generate_password_hash($data["password"]);
            $select_user = "SELECT * FROM ".$this->tablename." WHERE username = '".$data["username"]."' AND password='".$password_hash."'";
            $user = mysqli_query($this->connection,$select_user);
            if (mysqli_num_rows($user) == 1) {
                $action="list";
                $_SESSION['username'] = $data["username"];
            } else {
                $action = "error";
                $_SESSION['errors'] = array("username");
            }
            header("Location: ../index.php?action=".$action."&formtype=login");
        } else {
            $_SESSION['errors'] = array("username");
            header("Location: ../index.php?action=error&formtype=login");
        }
    }
    
    /* List all the registered users */
    public function list_users() {
        mysqli_select_db($this->connection, $this->database);
        $select_users = "SELECT * FROM ".$this->tablename." WHERE 1";
        $users = mysqli_query($this->connection,$select_users);
        return $users;
    }
    
    /* Insert new user to the table */
    public function insert_user($data) {
        if(!$this->user_exists("email",$data["email"])) {
            mysqli_select_db($this->connection, $this->database);
            $password_hash = $this->generate_password_hash($data["password"]);
            $insert_user = "INSERT INTO ".$this->tablename." (username, password, email) VALUES ('".$data["username"]."', '".$password_hash."', '".$data["email"]."')";
            print_r($insert_user);
            if (mysqli_query($this->connection,$insert_user)) {
              $action = "success";
            } else {
              $action = "error";
            }
            header("Location: ../index.php?action=".$action."&formtype=login");

            $this->connection->close();
        } else {
            $_SESSION['errors'] = array("existingemail");
            header("Location: ../index.php?action=error&formtype=register");
        }
    }
    
    /* Check whether the user exists in the table by any field */
    public function user_exists($field,$value) {
        mysqli_select_db($this->connection, $this->database);
        $select_user = "SELECT * FROM ".$this->tablename." WHERE ".$field." = '".$value."'";
        print_r($select_user);
        $user = mysqli_query($this->connection,$select_user);
        if (mysqli_num_rows($user) == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    /* Generate a secured password Hash using a manual key */
    public function generate_password_hash($password) {
        $secret_code = "28rjxqhi3haqqmaf273ziyiwawx78mqpdh0c3p6glshq8qrhq4";
        $hashed_pwd = hash_hmac("sha256", $password, $secret_code);
        return $hashed_pwd;
    }
}

