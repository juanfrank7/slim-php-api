<?php 

function con(){    
    $dbHost = 'localhost';
    $dbUser = 'admin';
    $dbPass = 'Fr4nc15c0';
    $dbName = 'deportes';
    static $conn = null;

    if($conn === null){
        $conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
    }
    return $conn;
}