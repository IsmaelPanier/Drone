<?php
$serveur = "localhost";
$utilisateur = "test"; // Remplacez par votre nom d'utilisateur MySQL
$mot_de_passe = "123456"; // Remplacez par votre mot de passe MySQL
$base_de_donnees = "drone";

// Créer une connexion à la base de données
$conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Définir le jeu de caractères de la connexion
$conn->set_charset("utf8mb4");
?>
