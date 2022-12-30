<?php
    session_start();

    require('../config.php');

    $server = constant("SERVER");
    $base = constant("BASE");
    $user = constant("USER");
    $password = constant("PASSWORD");

    header('Refresh: 0; URL=../admin.php');

    // Suppression de l'utilisateur avec l'id en paramètre
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $dsn = "mysql:host=$server;dbname=$base";
            $connexion = new PDO($dsn, $user, $password);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $request = "DELETE FROM UTILISATEURS WHERE ID = $id";
            $result = $connexion->query($request);
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
    }


?>