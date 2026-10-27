<?php
$host="localhost";
    $dbname="online_glam";
    $username="root";
    $password="";
    try{
        $conn=new PDO("mysql:host=$host;dbname=$dbname;
        charset=utf8",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      //  echo "connecte avec succes";
    }catch(exception $e){
        die("erreur de connexion :".$e->getMessage());
    }

?>