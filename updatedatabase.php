<?php

    session_start();

    if (array_key_exists("content", $_POST)) {


    	
        
       include("connection.php");
        
        $query = "UPDATE `diary` SET `notes` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE email = ".mysqli_real_escape_string($link, $_SESSION['email'])." LIMIT 1";
        
        mysqli_query($link, $query);
        
    }

?>
