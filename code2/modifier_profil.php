<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../index.html");
    exit();
}

$email_utilisateur = $_SESSION['utilisateur'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recrutement";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur
$sql_user = "SELECT * FROM users WHERE email = '$email_utilisateur'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql_update = "UPDATE users SET prenom = '$prenom', nom = '$nom', adresse = '$adresse', email = '$email', telephone = '$telephone', mot_de_passe = '$mot_de_passe' WHERE email = '$email_utilisateur'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Informations personnelles mises à jour avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil - Senelec Recrutement</title>
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
                <li><a href="Politique_de_confi.php">Politique de confidentialité</a></li>                
                <li><a href="https://www.senelec.sn" target="_blank">Notre Site Web</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Modifier Profil</h2>
        <form action="modifier_profil.php" method="post">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $user_data['prenom']; ?>" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user_data['nom']; ?>" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $user_data['adresse']; ?>" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>

            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $user_data['telephone']; ?>" required>

            <label for="mot_de_passe">Mot de Passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo $user_data['mot_de_passe']; ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>

    <footer>
        <h4>Siège social 28 Rue Vincens, Dakar Sénégal</h4>
        +221 33 839 30 30 / +221 33 867 66 66 / +221 33 823 12 67
        <p>&copy; 2024 Senelec. Tous droits réservés.</p>
    </footer>
</body>
</html>