<?php 
    class db{
        private $dbHost = 'localhost';
        private $dbUser = 'admin';
        private $dbPass = 'Fr4nc15c0';
        private $dbName = 'deportes';

        public function connectDB(){
            $conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die("Some error occurred during connection " . mysqli_error($con));
            return $conn;
        }
    }