<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moduleconnexion";
$wrong = "";
$sql = mysqli_connect($servername, $username, $password, $dbname);
session_start();

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = "SELECT * FROM utilisateurs WHERE login='$login' && password='$password'";

    if (mysqli_num_rows(mysqli_query($sql, $query)) > 0) {
        $_SESSION['login'] = $login;
        if ($_POST['login'] == 'admin') {
            header("Location:admin.php");
        } else {
            header("Location:profil.php");
        }

    } else {
        $wrong = "le login ou le mot de passe n'est pas correct";
    }

} elseif (isset($_SESSION['login'])) { // si deja connecter rederiction vers le profil.php
    header("Location:profil.php");
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
            <a href="index.php">Acceuil</a>
            <a href="inscription.php">Inscription</a>
        </nav>
    </header>
    <main>
        <section>
            <div>
            <h3>
        <?php echo $wrong ?>
            </h3>
                <form action="" method="POST">

                    <label for="login"></label>
                    <input type="text" name="login" id="login" placeholder="Username">
                    <br>
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
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
