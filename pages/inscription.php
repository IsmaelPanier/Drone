<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Projet Drone</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="inscription_traitement.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" required><br><br>
        
        <label for="mail">E-mail :</label><br>
        <input type="email" id="mail" name="mail" required><br><br>
        
        <label for="service">Service :</label><br>
        <select id="service" name="service" required>
            <option value="service informatique">Service Informatique</option>
            <option value="service commercial">Service Commercial</option>
            <option value="service administration">Service Administration</option>
        </select><br><br>
        
        <label for="mot_de_passe">Mot de passe :</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
        
        <input type="submit" value="S'inscrire">
    </form>
    <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
</body>
</html>
