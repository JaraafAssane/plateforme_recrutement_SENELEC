<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../index.html");
    exit();
}

$id_user = $_SESSION['id_user'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - Senelec Recrutement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <img class="logo" src="../img/im1.jfif" alt="logo">
        <h1>Senelec - Recrutement</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Tableau de Bord</a></li>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="offre.php">Offres d'Emploi</a></li>
                <li><a href="candidature.php">Candidature Spontanée</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="A propos.php">A propos</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
                
            </ul>
        </nav>
    </header>

    <main>
        <h2>Politique de Confidentialité</h2>
        <p>Chez Senelec, nous nous engageons à protéger votre vie privée. Cette politique de confidentialité décrit comment nous recueillons, utilisons et protégeons vos informations personnelles.</p>
        <p><strong>Informations Collectées:</strong></p>
        <ul>
            <li>Données personnelles (nom, adresse, email, etc.)</li>
            <li>Informations de candidature (CV, lettre de motivation, etc.)</li>
            <!-- Ajoutez d'autres informations ici -->
        </ul>
        <p><strong>Utilisation des Informations:</strong></p>
        <p>Nous utilisons les informations collectées pour traiter vos candidatures, vous contacter et améliorer nos services.</p>
        <p><strong>Protection des Données:</strong></p>
        <p>Nous mettons en œuvre des mesures de sécurité appropriées pour protéger vos informations personnelles contre l'accès non autorisé.</p>
    </main>

    <footer>
        <h3>Siège social 28 Rue Vincens, Dakar Sénégal</h3>
+221 33 839 30 30 / +221 33 867 66 66 /
+221 33 823 12 67
        <p>&copy; 2024 Senelec. Tous droits réservés.</p>
    </footer>
</body>
</html>