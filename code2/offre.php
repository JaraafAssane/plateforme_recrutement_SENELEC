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
    <title>Offres d'Emploi - Senelec Recrutement</title>
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
                <li><a href="candidature.php">Candidature Spontanée</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="A propos.php">A propos</a></li>
                <li><a href="Politique_de_confi.php">Politique de confidentialité</a></li>               
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Offres d'Emploi</h2>
        <section class="job-listings">
            <article class="job">
                <h3>Ingénieur Électricien</h3>
                <p>Nous recherchons un ingénieur électricien expérimenté...</p>
                <a href="#">En savoir plus</a>
            </article>
            <article class="job">
                <h3>Technicien de Maintenance</h3>
                <p>Nous recherchons un technicien de maintenance qualifié...</p>
                <a href="#">En savoir plus</a>
            </article>
            <!-- Ajoutez d'autres annonces ici -->
        </section>
    </main>

    <footer>
        <h4>Siège social 28 Rue Vincens, Dakar Sénégal</h4>
+221 33 839 30 30 / +221 33 867 66 66 /
+221 33 823 12 67
        <p>&copy; 2024 Senelec. Tous droits réservés.</p>
    </footer>
</body>
</html>