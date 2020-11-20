<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moduleconnexion";

$sql = mysqli_connect($servername, $username, $password, $dbname);
$users = mysqli_query($sql, "SELECT * FROM utilisateurs");

session_start();
$login = $_SESSION["login"];

if (!isset($login)) {
    header("Refresh: 3; url=connexion.php");
    echo "<p>Tu dois te connecter pour accéder à ton profil.</p><br><p>Redirection en cours, retour à la page d'accueil...</p>";
    exit(0);
}
if ($login != "admin") {
    header("Refresh: 3; url=profil.php");
    echo "<p>Vous n'etes pas un admin :)</p><br><p>Redirection en cours, retour à la page d'accueil...</p>";
    exit(0);
}
if (isset($_POST['exit'])) {
    session_unset ( );
    header("Location: connexion.php"); 
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
    </header>
    <main>
        <section>
            <div>
                <h1>Bonjour Mr <?php echo $_SESSION['login'] ?></h1>
                <p>voici la liste des utilisateur</p><br>
                <form action="" method="post" id="formadmin">
                    <input type="submit" name="exit" value="Logout">
                </form>
                
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Login</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php   
                                while ($row = mysqli_fetch_array($users)) {
                                    echo "<tr><td>$row[id]</td>";
                                    echo "<td>$row[login]</td>";
                                    echo "<td>$row[nom]</td>";
                                    echo "<td>$row[prenom]</td>";
                                    echo "<td>$row[password]</td>";}
                            ?>
                    </tbody>
                </table>
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