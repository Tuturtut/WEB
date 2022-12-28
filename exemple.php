<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body id="post-page">
    <?php 
        include_once('./config.php');
        $dsn = "mysql:dbname=".$DATABASE.";host=".$HOST;
        $connexion = new PDO($dsn, $USER, $PASSWORD);

        $request2 = "CREATE TABLE IF NOT EXISTS COMMENTAIRE(
            comment_ID INT AUTO_INCREMENT PRIMARY KEY,
            author_name VARCHAR(30) NOT NULL,
            comment_text VARCHAR(500) NOT NULL)";


        $connexion->query($request2);
    ?>

        <header>
            <div class="header-content">
                <a href="./" class="title"><span class="logo"></span>Miitter</a>
                <input class="search" placeholder="Search Miitter...">
            </div>
        </header>
        <div class="content">

        <?php 
        $request3 = "SELECT * FROM POST";
        $result=$connexion->query($request3);
        foreach ($result as $row){
        ?>

            <a class="single-post flex" href="./post.php?post=<?php echo $row['ID_POST'];?>">
                <div class="left">
                    <div class="thumbnail"></div>
                </div>
                <div class="right">
                    <div class="post-head">
                        <div class="name"><?php echo($row["PSEUDO_POST"])?></div>
                        <div class="number">2 Miits</div>
                    </div>
                    <div class="post-content">
                        <?php echo($row["TEXT_POST"])?>
                    </div>
                    <div class="post-media">
                        <img src="./assets/bike.jpg"/>
                    </div>
                </div>
            </a>
            <?php 
        }
        ?>



        </div>
    </body>
</html>