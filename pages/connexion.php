<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
    enregistrer_activite_connexion($userID, $conn);
    header("Location: index.php");
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    if (!empty($mail) && !empty($mot_de_passe)) {
        // Échapper les valeurs
        $mail = mysqli_real_escape_string($conn, $mail);

        // Requête pour récupérer l'utilisateur avec cet e-mail
        $sql = "SELECT id, nom, prenom, service, mot_de_passe FROM utilisateurs WHERE mail = '$mail'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Utilisateur trouvé, vérifier le mot de passe
            $row = $result->fetch_assoc();
            $mot_de_passe_hash = $row['mot_de_passe'];

            if (password_verify($mot_de_passe, $mot_de_passe_hash)) {
                // Connexion réussie, stocker les informations de l'utilisateur dans la session
                $_SESSION['id'] = $row['id'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['service'] = $row['service'];

                // Rediriger vers la page d'accueil
                header("Location: index.php");
                exit;
            } else {
                gerer_erreur("Mot de passe incorrect.");
            }
        } else {
            gerer_erreur("Adresse e-mail incorrecte ou utilisateur introuvable.");
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Projet Drone</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="mail">Adresse e-mail :</label>
            <input type="email" id="mail" name="mail" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
</body>
</html>
