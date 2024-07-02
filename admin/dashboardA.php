<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexionA.html");
    exit();
}

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

// Récupérer l'ID de l'utilisateur connecté
$email_utilisateur = $_SESSION['utilisateur'];
$sql_user = "SELECT * FROM users WHERE email = '$email_utilisateur'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
    $user_id = $user_data['id'];
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

// Requête pour récupérer les candidatures de l'utilisateur
$sql_candidature = "SELECT * FROM candidature WHERE id_user = '$user_id'";
$result_candidature = $conn->query($sql_candidature);

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <header>
    <img class="logo" src="../img/logo.png" alt="logo">

    <nav>
            <ul>
                <li><a href="dashboard.php">Tableau de Bord</a></li>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="candidature.php">Candidature Spontanée</a></li>
                <li><a href="contact.php">Contact</a></li>
                
                
            </ul>
        </nav>
        
        <div class="header-buttons">
            <a href="deconnexion.php" class="button">Se Deconnecter</a>
        </div>
        
       
    </header>

    <main>
    <h1>Profil Utilisateur</h2>

        <h2>Informations Candidatures</h2>
        <table border="1">
    <tr>
        <th>ID</th>
        <th>Domaine</th>
        <th>Poste souhaité</th>
        <th>Niveau d'étude</th>
        <th>Dernier diplôme obtenu</th>
        <th>CV</th>
        <th>Lettre de Motivation</th>
        <th>Message</th>
        <th>Date de soumission</th>
        <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
    </tr>
    <?php
    if ($result_candidature->num_rows > 0) {
        while ($row = $result_candidature->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['domaine'] . "</td>";
            echo "<td>" . $row['poste_souhaite'] . "</td>";
            echo "<td>" . $row['niveau_etude'] . "</td>";
            echo "<td>" . $row['dernier_diplome_obtenu'] . "</td>";
            echo "<td><a href='uploads/" . $row['cv'] . "'>Télécharger</a></td>";
            echo "<td><a href='uploads/" . $row['lettre_motivation'] . "'>Télécharger</a></td>"; 
            echo "<td>" . $row['message'] . "</td>";
            echo "<td>" . $row['date_soumission'] . "</td>";
            echo "<td>
                    <a href='modifier_candidature.php?id=" . $row['id'] . "'>Modifier</a> | 
                    <a href='delete_candidature.php?id=" . $row['id'] . "'>Supprimer</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>Aucune candidature trouvée.</td></tr>";
    }
    ?>
</table>

<h2>Informations Compte</h2>
        <h4>Cliquez ici pour modifier des parametres du compte <a href="modifier_profil.php">Mettre a jour</a></h4>
        <table border="1">
            <tr>
                <th>Identifiant</th>
                <td><?php echo $user_data['id']; ?></td>
            </tr>
            <tr>
                <th>Nom</th>
                <td><?php echo $user_data['nom']; ?></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><?php echo $user_data['prenom']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $user_data['email']; ?></td>
            </tr>
            <tr>
                <th>Date de Naissance</th>
                <td><?php echo $user_data['date_naissance']; ?></td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td><?php echo $user_data['adresse']; ?></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><?php echo $user_data['telephone']; ?></td>
            </tr>
           
        </table>
    </main>

    <footer>
    <h4><a href="Politique_de_confi.php">Politique de confidentialité</a></h4>
        <h4>Siège social 28 Rue Vincens, Dakar Sénégal</h4>
        +221 33 839 30 30 / +221 33 867 66 66 / +221 33 823 12 67
        <p>&copy; 2024 Senelec. Tous droits réservés.</p>
    </footer>
</body>
</html>