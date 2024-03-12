<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier les données soumises
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $service = isset($_POST['service']) ? $_POST['service'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    // Vérifier les données non vides
    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($service) && !empty($mot_de_passe)) {
        // Échapper les valeurs
        $nom = mysqli_real_escape_string($conn, $nom);
        $prenom = mysqli_real_escape_string($conn, $prenom);
        $mail = mysqli_real_escape_string($conn, $mail);
        $service = mysqli_real_escape_string($conn, $service);

        // Hacher le mot de passe avant de le stocker en base de données
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Vérifier si l'e-mail existe déjà dans la base de données
        $sql_verif_email = "SELECT id FROM utilisateurs WHERE mail = '$mail'";
        $result_verif_email = $conn->query($sql_verif_email);
        if ($result_verif_email->num_rows > 0) {
            // L'adresse e-mail existe déjà, afficher un message d'erreur
            gerer_erreur("L'adresse e-mail existe déjà.");
        } else {
            // Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la base de données
            $sql = "INSERT INTO utilisateurs (nom, prenom, mail, service, mot_de_passe, created_at) VALUES ('$nom', '$prenom', '$mail', '$service', '$mot_de_passe_hache', NOW())";

            if ($conn->query($sql) === TRUE) {
                // Rediriger l'utilisateur vers une page de succès avec toutes les informations dans l'URL
                header("Location: index.php?" . http_build_query($_POST));
                exit;
            } else {
                // Afficher un message d'erreur en cas d'échec de l'insertion
                echo "Erreur lors de l'inscription : " . $conn->error;
            }
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
} else {
    // Rediriger l'utilisateur vers la page d'inscription si le formulaire n'a pas été soumis
    header("Location: inscription.php");
    exit;
}

// Fermer la connexion à la base de données
$conn->close();
?>
