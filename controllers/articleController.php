<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../models/articleModel.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $article = getProductsById($id);
            if ($article) {
                echo json_encode($article);
            } else {
                echo json_encode(['message' => 'article non trouvée']);
            }
        } else {
            $articles = getAllProducts();
            echo json_encode($articles);
        }
        break;

        case 'POST':
            $name = $_POST['name'] ?? null;
            $price = $_POST['price'] ?? null;
            $description = $_POST['description'] ?? null;
            $categorie = $_POST['categorie'] ?? null;
        
            if ($name && $price && $description &&  $categorie && isset($_FILES['image'])) {
                $image = $_FILES['image'];
        
                if ($image['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/uploads/';
                    $imagePath = $uploadDir . basename($image['name']);
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
        
                    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                        $success = AddProducts($name, $price, $imagePath, $description,$categorie);
                        if ($success) {
                            echo json_encode(['message' => 'Article créé avec succès']);
                        } else {
                            echo json_encode(['message' => 'Erreur lors de la création']);
                        }
                    } else {
                        echo json_encode(['message' => 'Échec du téléchargement de l\'image']);
                    }
                } else {
                    echo json_encode(['message' => 'Erreur lors de l\'envoi de l\'image']);
                }
            } else {
                echo json_encode(['message' => 'Données invalides']);
            }
            break;
            
        

    default:
        echo json_encode(['message' => 'Méthode non supportée']);
}

