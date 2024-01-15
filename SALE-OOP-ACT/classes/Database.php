<?php

class Database {
    private $server_name = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "sales_oop";
    protected $conn; // need when use inheriting classes, only to inheriting classes

    public function __construct()
    {
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        if($this->conn->connect_error){
            die('Unable to connect to the database: '. $this->conn->connect_error);
        }
    }

    public function login($request)
    {
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);

        //check the username
        if($result->num_rows == 1)
        {
            //check if the password is correct
            $user = $result->fetch_assoc();

            //$user = id->1, username=>john, password=> $2y$..]
            if(password_verify($password, $user['password']))
            {
                //create a session variables for the future use
                session_start();

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['first_name']." ".$user['last_name'];

                header('location: ../views/dashboard.php');
                exit;
            } else {
                die('Password is incorrect');
            }
        } else {
            die('Username not found');
        }
    }
}
?>