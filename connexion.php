<?php
    require('header.php');

    if (isset($_SESSION['connected'])){
        if ($_SESSION['connected'] == true){
            echo "Vous êtes déjà connecté, vous allez être redirigé vers la page d'accueil";
            header('Refresh: 0; URL=accueil.php');           

        }

        // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
        else {
            header('Refresh: 0; URL=accueil.php');  
        }

    } else {
        echo '<div class="connexion">
        <form action="connexion.php" method="post">
            Email <input type="email" name="email" id="email">
            Password <input type="password" name="pw" id="pw">
            <input type="submit" value="Se connecter">
        </form>
        </div>';

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
    
        if (isset($_POST['pw'])) {
            $pw = $_POST['pw'];
        }    
        

    
    }



    

    try{

        $dsn = "mysql:host=$server;dbname=$base";
        $connexion = new PDO($dsn, $user, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['email'])){
            $request = "SELECT * FROM UTILISATEURS WHERE Email = '$email'";
            $result = $connexion->query($request);
            if ($result->rowCount() > 0){
                $request = "SELECT * FROM UTILISATEURS WHERE Email = '$email' AND MotDePasse = '$pw'";
                $result = $connexion->query($request);
                if ($result->rowCount() > 0){
                    // Session de connexion
                    $_SESSION['connected'] = true;
                    $_SESSION['email'] = $email;

                    
                    // Récupération du nom et du prénom de l'utilisateur
                    $request = "SELECT Nom FROM UTILISATEURS WHERE Email = '$email'";
                    $result = $connexion->query($request);


                    $_SESSION['name'] = $result->fetch()['Nom'];


                    $request = "SELECT Prenom FROM UTILISATEURS WHERE Email = '$email'";
                    $result = $connexion->query($request);

                    $_SESSION['surname'] = $result->fetch()['Prenom'];

                    header('Refresh: 0; URL=accueil.php');  
                    

                } else {
                    echo "Le mot de passe est incorrect";
                }

                // test si l'utilisateur est un administrateur)
                $request = "SELECT * FROM ADMINISTRATEURS WHERE IdUtilisateur = (SELECT ID FROM UTILISATEURS WHERE Email = '$email')";
                $result = $connexion->query($request);
                if ($result->rowCount() > 0){
                    $_SESSION['admin'] = true;
                } else {
                    $_SESSION['admin'] = false;
                }
            } else {
                echo "L'email n'est pas présent dans la base de données, veuillez vous inscrire";
            }
        }

    } catch(PDOException $e){
        echo 'Echec de la connexion : ' . $e->getMessage();
    }

    require('footer.php')
?>