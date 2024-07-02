<?php
session_start();

if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../index.html");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID de candidature non spécifié.";
    exit();
}

$candidature_id = $_GET['id'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recrutement";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Supprimer la candidature de la base de données
$sql_delete_candidature = "DELETE FROM candidature WHERE id = ?";
$stmt_delete_candidature = $conn->prepare($sql_delete_candidature);
$stmt_delete_candidature->bind_param("i", $candidature_id);

if ($stmt_delete_candidature->execute()) {
    echo "Candidature supprimée avec succès.";
} else {
    echo "Erreur lors de la suppression de la candidature : " . $conn->error;
}

// Fermer la connexion
$conn->close();
?>