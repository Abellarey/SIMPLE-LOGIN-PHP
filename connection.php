<?php
   $dbserver = "localhost";
   $dbusername = "root";
   $dbpass = "";
   $dbname = "abelladb";

   if(!$conn = mysqli_connect($dbserver,$dbusername,$dbpass,$dbname)){
    die("Something Went Wrong");
   }

?>