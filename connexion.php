<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $utilisateur = $_POST['utilisateur']; // Email de l'utilisateur
    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête pour vérifier les informations de connexion
    $sql = "SELECT id FROM users WHERE email = '$utilisateur' AND mot_de_passe = '$mot_de_passe'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        
        // Récupérer l'ID de l'utilisateur
        $row = $result->fetch_assoc();
        $id_user = $row['id'];
        
        // Stocker les informations dans la session
        $_SESSION['utilisateur'] = $utilisateur;
        $_SESSION['id_user'] = $id_user;
        
        header("Location: code2/index.html");
        exit();
    } else {
        // Connexion échouée
        echo "Email ou mot de passe incorrect.";
    }
}

// Fermer la connexion
$conn->close();
?>