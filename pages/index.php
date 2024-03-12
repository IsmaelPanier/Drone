<?php
session_start();
require_once('../includes/db.php');

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];

    // Requête pour récupérer les informations de l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($result->num_rows == 1) {
        // Récupérer les données de l'utilisateur
        $user = $result->fetch_assoc();
        $nom = $user['nom'];
        $mail = $user['mail'];
        $service = $user['service'];

        // Afficher les informations de l'utilisateur
        echo "<p>Bienvenue, $nom ! Votre adresse e-mail est $mail et vous êtes du service $service.</p>";
        echo "<p><a href='deconnexion.php'>Se déconnecter</a></p>";
    } else {
        // L'utilisateur n'existe pas ou une erreur s'est produite
        echo "Utilisateur non trouvé.";
    }
} else {
    // L'utilisateur n'est pas connecté, afficher un message d'invitation à se connecter
    echo "<p>Bienvenue sur notre site. Veuillez vous <a href='connexion.php'>connecter</a> pour accéder à votre compte.</p>";
}
?>
