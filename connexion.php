<?php
    require('header.php')
?>

<div class="connexion">
    <form action="connexion.php" method="post">
        Email <input type="email" name="email" id="email">
        Password <input type="pw" name="pw" id="pw">
        <input type="submit" value="Se connecter">
    </form>
</div>

<?php


    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['pw'])) {
        $pw = $_POST['pw'];
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
                    echo "Vous êtes connecté";
                } else {
                    echo "Le mot de passe est incorrect";
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