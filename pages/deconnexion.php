<?php
session_start();
require_once('../includes/functions.php');
require_once('../includes/db.php');

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    // Enregistrer l'activité de déconnexion dans le journal d'activité
    $userID = $_SESSION['id'];
    enregistrer_activite_deconnexion($userID, $conn);

    // Détruire la session
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - Projet Drone</title>
</head>
<body>
    <h1>Déconnexion</h1>
    <p>Vous avez été déconnecté.</p>
    <p><a href="connexion.php">Cliquez ici</a> pour vous connecter à nouveau.</p>
</body>
</html>
