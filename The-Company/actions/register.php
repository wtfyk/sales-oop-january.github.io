<?php
    include '../classes/User.php';

    // Create an OBJECT
    $user = new User;

    // CALL the METHOD
    $user->store($_POST); // connects with $request(first name, last name...) 
?>