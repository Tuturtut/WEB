<?php
    require('header.php');
?>

<?php

    if (isset($_SESSION['connected'])){
        if ($_SESSION['connected'] == true){
            // Affichage du profil

            echo '<div class="profil">
            <h1 class="hProfil">Profil</h1>
            <p class="pProfil">Prénom : '.$_SESSION['surname'].'</p>
            <p class="pProfil">Nom : '.$_SESSION['name'].'</p>
            <p class="pProfil">Email : '.$_SESSION['email'].'</p>';
            if ($_SESSION['admin'] == true) {
                echo '<p class="pProfil">Vous êtes administrateur</p>';
            }


        }
    }

?>

<!-- Depot de document via un blob -->
    <form action="profil.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Déposer</button>
    </form>


<?php

    $dsn = "mysql:host=$server;dbname=$base";
    $connexion = new PDO($dsn, $user, $password);

    // Depot de document via un blob
    if (isset($_POST['submit'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');

        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 10000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;


                    // Dépot de documents pdf dans la base de données
                    $query = "INSERT INTO document_pdf (fileName,fileType,data) VALUES ('$fileNameNew','$fileType',LOAD_FILE('$fileTmpName') )";
                    $result = $connexion->query($query);
                    echo $query;
                    if ($result){
                        echo "Votre fichier a bien été déposé";
                    } else {
                        echo "$fileName, $fileType, $fileTmpName <br>";
                        echo "Il y a eu une erreur lors du dépot de votre fichier";
                    }

                    header("Refresh: 0; Url: profil.php?uploadsuccess");
                } else {
                    echo "Votre fichier est trop volumineux";
                }
            } else {
                echo "Il y a eu une erreur lors du téléchargement de votre fichier";
            }
        } else {
            echo "Vous ne pouvez pas télécharger ce type de fichier";
        }
    }

    else {
        echo "Vous n'avez pas déposé de fichier";
    }
    

?>




<?php

    // Dépot de documents pdf dans la base de données

    require('footer.php');
?>