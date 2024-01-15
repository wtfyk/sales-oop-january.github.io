<?php

require 'Database.php';

class User extends Database {
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
            header('location: ../views'); //go to index.php
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

        header('location: ../views');
        exit;
    }
    public function getAllUsers()
    {
        $sql = "SELECT id,first_name,last_name,username,photo FROM users";

        if($result = $this->conn->query($sql))
        {
            return $result;
        } else {
            die('Error retrieving all users: ' . $this->conn->error);
        }
    }
    public function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc(); //to associative array
        } else {
            die('Error retrieving the user: ' . $this->error);
        }
    }
    public function update($request, $files)
    {
        session_start();
        $id = $_SESSION['id'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        $photo = $files['photo']['name'];
        $tmp_photo = $files['photo']['tmp_name'];

        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id = '$id'";

        if($this->conn->query($sql)){
            $_SESSION['username'] = $username;
            $_SESSION['full_name'] = "$first_name $last_name";

            if($photo){
                $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                $destination = "../assets/images/$photo";

                if($this->conn->query($sql)){
                    if(move_uploaded_file($tmp_photo, $destination)){
                        header('location: ../views/dashboard.php');
                        exit;
                    } else {
                        die('Error moving the photo');
                    }
                } else {
                    die('Error uploading the photo: '. $this->conn->error);
                }
            }
            header('location: ../views/dashboard.php');
            exit;
        } else {
            die('Error updating the user; '. $this->conn->error);
        }
    }
    public function delete()
    {
        session_start();
        $id = $_SESSION['id'];

        $sql = "DELETE FROM users WHERE id = $id";

        if($this->conn->query($sql)){
            $this->logout();
        } else {
            die('Error delete your account: '.$this->conn->error);
        }
    }
}

?>