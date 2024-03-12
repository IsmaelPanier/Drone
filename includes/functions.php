<?php
// Fonction pour afficher un message d'erreur
function afficher_erreur($message) {
    echo "<div class='erreur'>$message</div>";
}



// Fonction pour afficher et enregistrer une erreur
function gerer_erreur($message) {
    afficher_erreur($message);
}

// Fonction pour enregistrer une erreur dans la base de données
function enregistrer_erreur_bdd($message, $conn) {
    $timestamp = date("Y-m-d H:i:s");
    $sql = "INSERT INTO gestion_erreurs (description_erreur, heure_erreur, created_at) VALUES ('$message', '$timestamp', NOW())";
    $conn->query($sql);
}

// Fonction pour enregistrer l'activité de connexion dans le journal d'activité
function enregistrer_activite_connexion($userID, $conn) {
    $action = "Connexion";
    $heure_action = date("Y-m-d H:i:s");
    $sql = "INSERT INTO journal_activite (id_utilisateur, action, heure_action, created_at) VALUES ($userID, '$action', '$heure_action', NOW())";
    $conn->query($sql);
}

// Fonction pour enregistrer l'activité de déconnexion dans le journal d'activité
function enregistrer_activite_deconnexion($userID, $conn) {
    $action = "Déconnexion";
    $heure_action = date("Y-m-d H:i:s");
    $sql = "INSERT INTO journal_activite (id_utilisateur, action, heure_action, created_at) VALUES ($userID, '$action', '$heure_action', NOW())";
    $conn->query($sql);
}

//?>
