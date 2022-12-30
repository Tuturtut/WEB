<?php
    session_start();

    header('Refresh: 0; URL=../accueil.php');

    if (isset($_SESSION['connected'])){
        if ($_SESSION['connected'] == true){
            $_SESSION['connected'] = false;
            session_destroy();

        }
    }


?>