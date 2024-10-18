<?php
session_start();
include('../config/app.php');


if (isset($_GET['action'])) {

    $action = $_GET['action'];

    // --------------------- GET ----------------------------------      
    include('get.php');
    // --------------------- POST ----------------------------------          
    include('post.php');
    // --------------------- UPDATE ----------------------------------      
    include('update.php');
    // --------------------- DELETE ----------------------------------  
    include('delete.php');
}

// On ferme la connexion
$con->close();
echo json_encode($result);
