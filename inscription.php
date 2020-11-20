<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moduleconnexion";
$wrongpass = "";
$existe = "";
$remplissez = "";

$sql = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_POST['submit'])) {
    $login = trim($_POST['login']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $checklogin = mysqli_query($sql, "SELECT login FROM utilisateurs WHERE login='$login'");

    if (!empty($login) && !empty($nom) && !empty($prenom) && !empty($password) && !empty($confirm_password)) {
        $query = "INSERT INTO utilisateurs(login, prenom, nom, password)
                VALUES ('$login', '$prenom', '$nom', '$password')";

        if ($password != $confirm_password) {
            $wrongpass = "le mot de passe n'est pas le meme YALAHMAR<br>";
        } elseif (mysqli_num_rows($checklogin) != 0) {
            $existe = "Le Pseudo est deja  utiliser";
        } elseif (mysqli_query($sql, $query)) {
            echo "Bienvenue $prenom";
            header("Location:connexion.php");
        }
    } else {
        $remplissez = "Remplissez le formulaire YALAHMAR<br>";
    }

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <title>Good Vibes</title>
</head>
<body>
    <header>
        <div>
        <h1><a href="index.php">VIBES</a></h1>
        </div>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="connexion.php">Connexion</a>
        </nav>
    </header>
    <main>
        <section>
            <div>
            <h3>
                <?php echo $remplissez ?>
                <?php echo $wrongpass ?>
                <?php echo $existe ?>
            </h3>
                <form action="" method="POST">

                    <label for="login"></label>
                    <input type="text" name="login" id="login" placeholder="Username">
                    <br>
                    <label for="nom"></label>
                    <input type="text" name="nom" id="nom" placeholder="Nom">
                    <br>
                    <label for="prenom"></label>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom">
                    <br>
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                    <br>
                    <label for="confirm_password"></label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le mot de passe">
                    <br>
                    <input type="submit" name="submit" value="VALIDER">
                </form>
                </div>
        </section>

    </main>
    <footer>
        <div>
            <p>Copyright 2020 All rights reserved - Samy & Morad</p>
        </div>
    </footer>
</body>
</html>