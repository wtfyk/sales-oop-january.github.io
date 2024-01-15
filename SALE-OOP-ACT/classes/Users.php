<?php

require 'Database.php';

class Users extends Database {
    public function store($request)
    {
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        $password = $request['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(`first_name`,`last_name`,`username`,`password`)
                VALUES ('$first_name','$last_name','$username','$password')";
        
        if($this->conn->query($sql)){
            header('location: ../views/login.php'); //go to index.php
            exit;
        } else {
            die('Error creating the user: '.$this->conn->error);
        }
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('location: ../views/login.php');
        exit;
    }
}
?>