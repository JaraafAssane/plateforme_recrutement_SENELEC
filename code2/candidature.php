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
    <title>Candidature Spontanée - Senelec Recrutement</title>
    <link rel="stylesheet" href="css/candidature.css">
</head>
<body>
    <header>
        <img class="logo" src="../img/logo.png" alt="logo">
        <nav>
            <ul>
                <li><a href="dashboard.php">Tableau de Bord</a></li>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="offre.php">Offres d'Emploi</a></li>
                <li><a href="candidature.php">Candidature Spontanée</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="A propos.php">A propos</a></li>              
                <li><a href="https://www.senelec.sn" target="_blank">Notre Site Web</a></li>
            </ul>
        </nav>
        <div class="header-buttons">
            <a href="deconnexion.php" class="button">Se Déconnecter</a>
        </div>
    </header>

    <main>
        <h2>Candidature Spontanée</h2>
        <form action="candidature.php" method="post" enctype="multipart/form-data">
         
              <label for="domaine">Domaine :</label>
              <select id="domaine" name="domaine" required>
                <option value="">Sélectionnez un domaine</option>
                <option value="Informatique">Informatique</option>
                <option value="Fiscalité">Fiscalité</option>
                <option value="Marketing">Marketing</option>
                <option value="Electronique">Électronique</option>
                <option value="Gestion Ressources Humaines">Gestion Ressources Humaines</option>
                <option value="Audit Interne et Contrôle de Gestion">Audit Interne et Contrôle de Gestion</option>
                <option value="Logistique & Supplychain">Logistique & Supplychain</option>
              </select>

             <label for="poste">Poste souhaité :</label>
             <input type="text" id="poste" name="poste" required>
          
            <label for="niveau">Niveau d'étude :</label>
            <input type="text" id="niveau" name="niveau" required>
            
            <label for="diplome">Dernier diplôme obtenu :</label>
            <select id="diplome" name="diplome" required>
                <option value="">Sélectionnez un diplôme</option>
                <option value="BAC">BAC</option>
                <option value="DTD">DTD</option>
                <option value="DUT">DUT</option>
                <option value="DST">DST</option>
                <option value="BUT">BUT</option>
                <option value="Licence">Licence</option>
                <option value="Master">Master</option>
                <option value="Diplôme d’ingénieur">Diplôme d’ingénieur</option>
                <option value="Plus">Plus</option>
            </select>

            <label for="cv">CV :</label>
            <input type="file" id="cv" name="cv" required>

            <label for="motivation">Lettre de Motivation :</label>
            <input type="file" id="motivation" name="motivation" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea>
            
            <button type="submit">Envoyer</button>
</form>

            <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "recrutement";

        // Créer la connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }

        $domaine = $conn->real_escape_string($_POST['domaine']);
        $poste = $conn->real_escape_string($_POST['poste']);
        $niveau = $conn->real_escape_string($_POST['niveau']);
        $diplome = $conn->real_escape_string($_POST['diplome']);
        $message = $conn->real_escape_string($_POST['message']);

        // Vérification des fichiers
        $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $cv_info = pathinfo($_FILES['cv']['name']);
        $motivation_info = pathinfo($_FILES['motivation']['name']);

        if (!in_array(strtolower($cv_info['extension']), $allowed_types) ||
            !in_array(strtolower($motivation_info['extension']), $allowed_types)) {
            die("Format de fichier non autorisé. Seuls les fichiers PDF, DOC, DOCX, JPG, JPEG et PNG sont autorisés.");
        }

        // Dossier de destination pour les fichiers
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $cv = uniqid() . '-' . basename($_FILES['cv']['name']);
        $motivation = uniqid() . '-' . basename($_FILES['motivation']['name']);
        $cv_target = $upload_dir . $cv;
        $motivation_target = $upload_dir . $motivation;

        // Déplacer les fichiers uploadés
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $cv_target) &&
            move_uploaded_file($_FILES['motivation']['tmp_name'], $motivation_target)) {

            // Préparer et exécuter la requête
            $sql = "INSERT INTO candidature (id_user, domaine, poste_souhaite, niveau_etude, dernier_diplome_obtenu, cv, lettre_motivation, message)
                    VALUES ('$id_user','$domaine', '$poste', '$niveau', '$diplome', '$cv', '$motivation','$message' )";

            if ($conn->query($sql) === TRUE) {
                echo "Candidature soumise avec succès.";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Erreur lors de l'upload des fichiers.";
        }

        // Fermer la connexion
        $conn->close();
    }
    ?>
</main>

<footer>
    <h4><a href="Politique_de_confi.php">Politique de confidentialité</a></h4>
    <h4>Siège social 28 Rue Vincens, Dakar Sénégal</h4>
    +221 33 839 30 30 / +221 33 867 66 66 / +221 33 823 12 67
    <p>&copy; 2024 Senelec. Tous droits réservés.</p>
</footer>
</body>
</html>