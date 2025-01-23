<?php
require_once __DIR__ . '/../config/db.php';

function getAllProducts() {
    global $connexion;
    $query = "SELECT * FROM article ";
    $stmt = $connexion->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsById($id) {
    global $connexion;
    $query = "SELECT * FROM article WHERE id = :id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function AddProducts($name, $price, $image, $description, $categorie){
    global $connexion;
    $sql = "INSERT INTO `products` (`nom`, `price`, `image`, `description`,`categorie`) VALUES 
    (:nom, :prix, :image, :description)";    
      $state=$connexion->prepare($sql);
      $state->bindValue("name",$name,PDO::PARAM_STR);
      $state->bindValue("price",$price,PDO::PARAM_INT);
      $state->bindValue("image",$image,PDO::PARAM_STR);
      $state->bindValue("description",$description,PDO::PARAM_STR);
      $state->bindValue("categorie",$categorie,PDO::PARAM_STR);
      return $state->execute();


}

function ModifierProducts($id,$name, $price,$image,$description,$categorie){
    global $connexion;
    $sql = "UPDATE `products` SET  `nom` = :nom,  `prix` = :prix, `image` = :image,  `description` = :description ,`categorie`=categorie WHERE `id` = :id";    
      $state=$connexion->prepare($sql);
      $state->bindValue("id", $id, PDO::PARAM_INT);
      $state->bindValue("nom",$name,PDO::PARAM_STR);
      $state->bindValue("prix",$price,PDO::PARAM_INT);
      $state->bindValue("image",$image,PDO::PARAM_STR);
      $state->bindValue("description",$description,PDO::PARAM_STR);
      $state->bindValue("categorie",$categorie,PDO::PARAM_STR);
      return $state->execute();


}

