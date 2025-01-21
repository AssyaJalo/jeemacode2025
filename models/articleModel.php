<?php
require_once __DIR__ . '/../config/db.php';

function getAllArticle() {
    global $connexion;
    $query = "SELECT * FROM article ";
    $stmt = $connexion->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getArticleById($id) {
    global $connexion;
    $query = "SELECT * FROM article WHERE id = :id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function AddArticle($nom, $prix,$image,$description){
    global $connexion;
    $sql = "INSERT INTO `article` (`nom`, `prix`, `image`, `description`) VALUES 
    (:nom, :prix, :image, :description)";    
      $state=$connexion->prepare($sql);
      $state->bindValue("nom",$nom,PDO::PARAM_STR);
      $state->bindValue("prix",$prix,PDO::PARAM_INT);
      $state->bindValue("image",$image,PDO::PARAM_STR);
      $state->bindValue("description",$description,PDO::PARAM_STR);
      return $state->execute();


}

function ModifierArticle($id,$nom, $prix,$image,$description){
    global $connexion;
    $sql = "UPDATE `article` SET  `nom` = :nom,  `prix` = :prix, `image` = :image,  `description` = :description WHERE `id` = :id";    
      $state=$connexion->prepare($sql);
      $state->bindValue("id", $id, PDO::PARAM_INT);
      $state->bindValue("nom",$nom,PDO::PARAM_STR);
      $state->bindValue("prix",$prix,PDO::PARAM_INT);
      $state->bindValue("image",$image,PDO::PARAM_STR);
      $state->bindValue("description",$description,PDO::PARAM_STR);
      return $state->execute();


}

