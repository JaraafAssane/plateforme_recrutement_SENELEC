<?php
session_start();
if (!isset($_SESSION['utilisateur'])){
    header("Location: connexion.html");
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Senelec Recrutement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <img class="logo" src="../img/im1.jfif" alt="logo">
        <h1>Senelec Recrutement</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Tableau de Bord</a></li>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="offre.php">Offres d'Emploi</a></li>
                <li><a href="candidature.php">Candidature Spontanée</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="A propos.php">A propos</a></li>
                <li><a href="Politique_de_confi.php">Politique de confidentialité</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Contactez-nous</h2>
        <form action="submit_contact.html" method="post">

            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" ></textarea>

            <button type="submit">Envoyer</button>
        </form>
    </main>

    <footer>
        <h4>Siège social 28 Rue Vincens, Dakar Sénégal</h4>
+221 33 839 30 30 / +221 33 867 66 66 /
+221 33 823 12 67
        <p>&copy; 2024 Senelec. Tous droits réservés.</p>
    </footer>
</body>
</html>