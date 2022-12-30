<?php
    require('header.php');
?>

<div class="inscription">
    <form action="inscription.php" method="post">
        Nom <input type="text" name="nom" id="nom">
        Prenom <input type="text" name="prenom" id="prenom">
        Email <input type="email" name="email" id="email">
        Mot de passe <input type="password" name="password" id="password">
        Confirmer mot de passe <input type="password" name="password2" id="password2">
        <input type="submit" value="S'inscrire">
    </form>
</div>

<?php
    if (isset($_POST['nom'])) {
        $nom = $_POST['nom'];
    }

    if (isset($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    try{

        $dsn = "mysql:host=$server;dbname=$base";
        $connexion = new PDO($dsn, $user, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
        if (isset($_POST['email'])){
            $request = "SELECT * FROM UTILISATEURS WHERE Email = '$email'";
            $result = $connexion->query($request);
            if ($result->rowCount() > 0 and isset($_POST['email'])){
                echo "L'email est déjà présent dans la base de données, veuillez en choisir un autre ou vous connecter";
            } else {
                $password = $_POST['password'];
                $password2 = $_POST['password2'];

                if($password == $password2){
                    $request = "INSERT INTO UTILISATEURS (Nom, Prenom, Email, MotDePasse) VALUES ('$nom', '$prenom', '$email', '$password')";
                    $connexion->query($request);
                    header('Refresh: 0; URL=accueil.php');  
                }
                else{
                    echo "Les mots de passe ne correspondent pas";
                }
            }
        }

    } catch(PDOException $e){
        echo 'Echec de la connexion : ' . $e->getMessage();
    }

    require('footer.php')
?>