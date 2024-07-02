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

// Récupérer l'ID de la candidature à modifier depuis l'URL
if (!isset($_GET['id'])) {
    echo "ID de candidature non spécifié.";
    exit();
}

$candidature_id = $_GET['id'];

// Récupérer les détails de la candidature à modifier
$sql_candidature_selected = "SELECT * FROM candidature WHERE id = ?";
$stmt_candidature_selected = $conn->prepare($sql_candidature_selected);
$stmt_candidature_selected->bind_param("i", $candidature_id);
$stmt_candidature_selected->execute();
$result_candidature_selected = $stmt_candidature_selected->get_result();

if ($result_candidature_selected->num_rows > 0) {
    $candidature_data = $result_candidature_selected->fetch_assoc();
} else {
    echo "Candidature sélectionnée non trouvée.";
    exit();
}

// Traitement du formulaire POST pour la mise à jour de la candidature sélectionnée
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_candidature'])) {
    $domaine = $_POST['domaine'];
    $poste = $_POST['poste'];
    $niveau = $_POST['niveau'];
    $diplome = $_POST['diplome'];
    $message = $_POST['message'];

    // Gestion de l'upload du CV
    if ($_FILES['cv']['size'] > 0) {
        $cv_filename = $_FILES['cv']['name'];
        $cv_tempname = $_FILES['cv']['tmp_name'];
        $cv_folder = "uploads/";
        $cv_filepath = $cv_folder . $cv_filename;

        // Déplacer le fichier temporaire vers le dossier d'upload
        if (move_uploaded_file($cv_tempname, $cv_filepath)) {
            // Mettre à jour la base de données avec le chemin du CV
            $sql_update_cv = "UPDATE candidature SET cv = ? WHERE id = ?";
            $stmt_update_cv = $conn->prepare($sql_update_cv);
            $stmt_update_cv->bind_param("si", $cv_filepath, $candidature_id);

            if ($stmt_update_cv->execute()) {
                echo "CV téléversé avec succès.";
                // Mettre à jour les données affichées après la modification
                $candidature_data['cv'] = $cv_filepath;
            } else {
                echo "Erreur lors du téléversement du CV : " . $conn->error;
            }
        } else {
            echo "Erreur lors de l'upload du fichier CV.";
        }
    }

    // Gestion de l'upload de la lettre de motivation
    if ($_FILES['lettre_motivation']['size'] > 0) {
        $lm_filename = $_FILES['lettre_motivation']['name'];
        $lm_tempname = $_FILES['lettre_motivation']['tmp_name'];
        $lm_folder = "uploads/";
        $lm_filepath = $lm_folder . $lm_filename;

        // Déplacer le fichier temporaire vers le dossier d'upload
        if (move_uploaded_file($lm_tempname, $lm_filepath)) {
            // Mettre à jour la base de données avec le chemin de la lettre de motivation
            $sql_update_lm = "UPDATE candidature SET lettre_motivation = ? WHERE id = ?";
            $stmt_update_lm = $conn->prepare($sql_update_lm);
            $stmt_update_lm->bind_param("si", $lm_filepath, $candidature_id);

            if ($stmt_update_lm->execute()) {
                echo "Lettre de motivation téléversée avec succès.";
                // Mettre à jour les données affichées après la modification
                $candidature_data['lettre_motivation'] = $lm_filepath;
            } else {
                echo "Erreur lors du téléversement de la lettre de motivation : " . $conn->error;
            }
        } else {
            echo "Erreur lors de l'upload du fichier Lettre de motivation.";
        }
    }

    // Mettre à jour les autres champs de la candidature
    $sql_update_candidature = "UPDATE candidature SET domaine = ?, poste_souhaite = ?, niveau_etude = ?, dernier_diplome_obtenu = ?, message = ? WHERE id = ?";
    $stmt_update_candidature = $conn->prepare($sql_update_candidature);
    $stmt_update_candidature->bind_param("sssssi", $domaine, $poste, $niveau, $diplome, $message, $candidature_id);

    if ($stmt_update_candidature->execute()) {
        echo "Candidature mise à jour avec succès.";
        // Mettre à jour les données affichées après la modification
        $candidature_data['domaine'] = $domaine;
        $candidature_data['poste_souhaite'] = $poste;
        $candidature_data['niveau_etude'] = $niveau;
        $candidature_data['dernier_diplome_obtenu'] = $diplome;
        $candidature_data['message'] = $message;
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
    <title>Modifier Candidature - Senelec Recrutement</title>
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
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Modifier Candidature</h2>

        <form action="modifier_candidature.php?id=<?php echo $candidature_id; ?>" method="post" enctype="multipart/form-data">
            <label for="domaine">Domaine :</label>
            <input type="text" id="domaine" name="domaine" value="<?php echo $candidature_data['domaine']; ?>" required>

            <label for="poste">Poste Souhaité :</label>
            <input type="text" id="poste" name="poste" value="<?php echo $candidature_data['poste_souhaite']; ?>" required>

            <label for="niveau">Niveau d'Étude :</label>
            <input type="text" id="niveau" name="niveau" value="<?php echo $candidature_data['niveau_etude']; ?>" required>

            <label for="diplome">Dernier Diplôme Obtenu :</label>
            <input type="text" id="diplome" name="diplome" value="<?php echo $candidature_data['dernier_diplome_obtenu']; ?>" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="4" required><?php echo $candidature_data['message']; ?></textarea>

            <label for="cv">CV :</label>
            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.rtf">

            <label for="lettre_motivation">Lettre de Motivation :</label>
            <input type="file" id="lettre_motivation" name="lettre_motivation" accept=".pdf,.doc,.docx,.rtf">

            <button type="submit" name="update_candidature">Mettre à jour</button>
        </form>
    </main>

    <footer>
        <h4>Siège social 28 Rue Vincens, Dakar Sénégal</h4>
        +221 33 839 02 50
    </footer>
</body>
</html>