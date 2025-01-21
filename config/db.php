<?php

$serveur="localhost";
$user="root";
$password="";
$nomBd="gestionCommandes";

try {
   $connexion= new PDO("mysql:host=$serveur;port=3307;dbname=$nomBd",
   $user,$password,
   [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
  
} catch (PDOException $e) {
    echo "Erreur de connexion a la bd" .$e->getMessage();
    die;
}









?>
