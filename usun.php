<?php


   include('db_connect.php');


    if(isset($_GET['id_event']))
    {
        $id_event = $_GET['id_event'];
        $statement = $mysqli->prepare("DELETE FROM events WHERE id_event = ? LIMIT 1 ");
        $statement->bind_param("i",$id_event);
        $statement->execute();
        $statement->close();
        
        header("location: main.php");
    }
    
    
?>