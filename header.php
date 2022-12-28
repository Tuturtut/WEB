<?php
    // PDO = PHP Data Object
    // new PDO() = Créer un nouvel objet PDO
    // (host, user, password) = Paramètres de connexion
    require('config.php');

    $server = constant("SERVER");
    $base = constant("BASE");
    $user = constant("USER");
    $password = constant("PASSWORD");
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Natation</title>
</head>
<body>
    
    <nav>
        <a href="Accueil.php">Accueil</a>
        <a href="Connexion.php">Connexion</a>
        <a href="Inscription.php">Inscription</a>
    </nav>
