<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../models/commandeModel.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $commande = getAllCommandeById($id);
            if ($commande) {
                echo json_encode($commande);
            } else {
                echo json_encode(['message' => 'commande non trouvée']);
            }
        } else {
            $commandes = getAllCommande();
            echo json_encode($commandes);
        }
        break;

        case 'POST':
            $etat = $_POST['etat'] ?? null;
            $payer = $_POST['payer'] ?? null;
            $idClient = $_POST['idClient'] ?? null;
            $idProduct = $_POST['idProduct'] ?? null;
    
            if ($etat && $payer && $idClient && $idProduct) {
                $success = AddCommande($etat, $payer, $idClient, $idProduct);
                if ($success) {
                    echo json_encode(['message' => 'Commande créée avec succès']);
                } else {
                    echo json_encode(['message' => 'Erreur lors de la création de la commande']);
                }
            } else {
                echo json_encode(['message' => 'Données invalides. Assurez-vous que tous les champs sont remplis correctement.']);
            }
            break;
    
        

    default:
        echo json_encode(['message' => 'Méthode non supportée']);
}

