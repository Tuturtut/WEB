<?php

    require('header.php');

?>

<h1>ADMINISTRATEURS</h1>
<?php

    try{

        $dsn = "mysql:host=$server;dbname=$base";
        $connexion = new PDO($dsn, $user, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // Affiche la liste des utilisateurs
        $request = "SELECT * FROM UTILISATEURS";
        $result = $connexion->query($request);
        if ($result->rowCount() > 0){
            echo '<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Administrateur</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>';
            while ($row = $result->fetch()){
                echo '<tr>
                <th scope="row">'.$row['ID'].'</th>
                <td>'.$row['Nom'].'</td>
                <td>'.$row['Prenom'].'</td>
                <td>'.$row['Email'].'</td>';

                $request = "SELECT * FROM ADMINISTRATEURS WHERE IdUtilisateur = ".$row['ID'];
                $result2 = $connexion->query($request);
                if ($result2->rowCount() > 0){
                    echo '<td>Oui</td>';
                } else {
                    echo '<td>Non</td>';
                }
                // Si l'utilisateur n'est pas un administrateur, lien pour le supprimer
                if ($result2->rowCount() == 0){
                    echo '<td><a href="function/deleteUser.php?id='.$row['ID'].'">Supprimer</a></td>';
                } else {
                    echo '<td></td>';
                }

                echo '</tr>';
            }
            echo '</tbody>
            </table>';
        }
    }
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }

    echo '<h1>Ajouter un administrateur</h1>';

    // Recupere la valeur de l'id de l'utilisateur
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $dsn = "mysql:host=$server;dbname=$base";
            $connexion = new PDO($dsn, $user, $password);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Ajoute l'utilisateur dans la table ADMINISTRATEURS si il n'y est pas deja
            $request = "INSERT INTO ADMINISTRATEURS (IdUtilisateur) VALUES ($id)";

            $result = $connexion->query($request);
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Formulaire pour ajouter un administrateur
    echo '<form action="" method="get">
            <label for="id">ID de l\'utilisateur</label>
            <input type="text" name="id" id="id" required>
            <input type="submit" value="Ajouter">
        </form>';

    $_


?>

<?php

    require('footer.php');

?>
