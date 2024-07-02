<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recrutement";

// Créer la connexion a la base
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion a la base
if ($conn->connect_error) {
   die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $prenom = $_POST['prenom'];
   $nom = $_POST['nom'];
   $ddn = $_POST['ddn'];
   $adresse = $_POST['adresse'];
   $email = $_POST['email'];
   $telephone = $_POST['telephone'];
   $mot_de_passe = $_POST['mot_de_passe'];
   $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];

   if ($mot_de_passe === $confirmer_mot_de_passe) {
       // Insérer les données dans la base de données
       $sql = "INSERT INTO users (prenom, nom, date_naissance, email, adresse, telephone, mot_de_passe)
               VALUES ('$prenom', '$nom', '$ddn', '$email', '$adresse','$telephone', '$mot_de_passe')";

       if ($conn->query($sql) === TRUE) {
           echo "Inscription réussie. Allez vous connecter. ";
           header("Location: connexion.html");
       } else {
        echo "Cette utilisateur existe deja. Verifiez votre email. ";
           echo "Erreur : " . $sql . "<br>" . $conn->error;
           
       }
   } else {
       echo "Les mots de passe ne correspondent pas.";
   }
}

// Fermer la connexion
$conn->close();
?>