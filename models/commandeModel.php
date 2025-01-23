<?php

function getAllCommande() {
    global $connexion;
    $sql = "SELECT * FROM `commande`";
    $state = $connexion->prepare($sql);
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}


function getAllCommandeById($id) {
    global $connexion;
    $sql = "SELECT * FROM `commande` WHERE `id` = :id";
    $state = $connexion->prepare($sql);
    $state->bindParam(":id", $id, PDO::PARAM_INT);
    $state->execute();
    return $state->fetch(PDO::FETCH_ASSOC);
}



function AddCommande($etat, $payer, $idClient, $idProduct) {
    global $connexion;
    $sql = "INSERT INTO `commande` (`etat`, `payer`, `created_at`, `updated_at`, `idClient`, `idProduct`) 
            VALUES (:etat, :payer, NOW(), NOW(), :idClient, :idProduct)";
    $state = $connexion->prepare($sql);
    $state->bindValue(":etat", $etat, PDO::PARAM_STR); 
    $state->bindValue(":payer", $payer, PDO::PARAM_BOOL);
    $state->bindValue(":idClient", $idClient, PDO::PARAM_INT);
    $state->bindValue(":idProduct", $idProduct, PDO::PARAM_INT);
  
    return $state->execute();
}
