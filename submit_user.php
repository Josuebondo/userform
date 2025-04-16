<?php
require "./uploads/config.php";

// Récupération des données POST
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Dossier d'upload
$uploadDir = __DIR__ . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true); // Crée le dossier s'il n'existe pas
}

// Vérification de l'upload du fichier
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['photo']['tmp_name'];
    $fileName = basename($_FILES['photo']['name']);
    $fileSize = $_FILES['photo']['size'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Validation du type de fichier
    if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = strtolower('photo_de '.$prenom . '_' . $nom . '_' . uniqid()) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        // Déplacement du fichier
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            echo "Photo bien téléchargée. </br>";

            // Enregistrement dans la base de données
            $sql = "INSERT INTO users (nom, prenom, email, photo) VALUES (:nom, :prenom, :email, :photo)";
            $req = $pdo->prepare($sql);
            $exec = $req->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':photo' => "/uploads/" . $newFileName
            ]);

            if ($exec) {
                echo "<div class=\"success\">Données insérées avec succès. </div>";
            } else {
                echo "<div class=\"dager\">Échec de l'insertion des données. </div></br>";
            }
        } else {
            echo "<div class=\"danger\">Une erreur s'est produite lors du téléchargement du fichier.</div> </br>";
        }
    } else {
        echo "<div class=\"danger\">Type de fichier non autorisé. Seuls les fichiers JPG, JPEG, PNG et GIF sont acceptés.</div> </br>";
    }
} else {
    echo "<div class=\"danger\">Aucun fichier téléchargé ou une erreur s'est produite. </div></br>";
}
?>