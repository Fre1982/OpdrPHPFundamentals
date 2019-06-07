<?php

require_once 'inc/functions.php';

// Check if post is send
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $task = empty($_POST['task']) ? '' : escape($_POST['task']);
    
    // Check if name !emtpy
    if(!empty($task)){
        // connect to DB
        require 'inc/db_connect.php';

        $sql = "
            INSERT INTO tasks (task, completed)
            VALUES ('$task', 0);
        ";

        // Push data into new row
        if($conn->query($sql) === true){
            // Redirect to index.php
            header('Location: index.php');
        }else{
            die('Oeps, Something went wrong!');
        }
    }
}

include_once 'inc/header.php';


include_once 'inc/footer.php';