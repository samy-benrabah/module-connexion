

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div>
        <h1><a href="index.php">VIBES</a></h1>
        </div>
    </header>
    <main>
    <?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Refresh: 3; url=connexion.php");
    echo "<p>Tu dois te connecter pour accéder à ton profil.</p><br><p>Redirection en cours, retour à la page d'accueil...</p>";
    exit();
}
$login = $_SESSION['login'];
$sql = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

var_dump($_SESSION['login']);

if (!$sql) {
    echo "Erreur connexion";
    exit(0);
} else {
    echo "<h1>Bienvenue sur ton profil $login</h1><br>";
}

$req = mysqli_query($sql, "SELECT * FROM utilisateurs WHERE login='$login'");
$info = mysqli_fetch_assoc($req);
$prenom = $info['prenom'];
$nom = $info['nom'];
$password = $info['password'];
$modification = '';
$formNewLogin = '';
$formNewNom = '';
$formNewPrenom = '';
$formNewPass = '';
$same = '';
$existe = '';
$valide = '';
$vide = '';
$wrong = '';
$delete = '';
$newNom = '';
echo "Ton login est: $login<br>";
echo "Ton Prénom est: $prenom<br>";
echo "Ton Nom est: $nom<br>";
echo "Ton Mot de passe est: $password<br>";

if (isset($_POST['modifier'])) {
    $modification = "Pour modifier le Login cliquer <input type=\"submit\" name=\"modifierlogin\" value=\"ici\"><br>
                            Pour modifier le Nom cliquer <input type=\"submit\" name=\"modifiernom\" value=\"ici\"><br>
                            Pour modifier le Prénom cliquer <input type=\"submit\" name=\"modifierprenom\" value=\"ici\"><br>
                            Pour modifier le Mot de passe cliquer <input type=\"submit\" name=\"modifierpass\" value=\"ici\"><br>



        ";
}

// Début de chagement de l'ancien login
if (isset($_POST['modifierlogin'])) { // si l'utilisateurs appuis sur modifier le Login ca affichera le fomulaire pour changer le Login
    $formNewLogin = "
            <form method=\"post\">
            <input type=\"text\" name=\"newlogin\" id=\"login\" placeholder=\"Entrer un nouveau login\">
            <input type=\"submit\" name=\"submitnewlogin\" value=\"valider\">
            </form>";
}

// j'écris dans l'input new login je click submit

if (isset($_POST['submitnewlogin'])) {

    // ici c'est l'ancien login
    $checklogin = $_SESSION['login'];

    var_dump($checklogin);
    $newLogin = $_POST['newlogin'];

    if (!empty(trim(($newLogin)))) {

        // si le formulaire est vide s'affichera un message erreur
        $query = "UPDATE utilisateurs SET login='" . htmlentities(trim($_POST['newlogin'])) . "' WHERE login='$login'";

        var_dump($query);
        if ($login == $newLogin) {
            $same = "utiliser un login différent que $login !!<br>";
        } elseif (mysqli_num_rows($checklogin) === 0) {
            $existe = "Le login que vous avez saisi est déjà utilisé par un autre utilisateur<br>veuillez indiquer un autre Login :)";
        } elseif (mysqli_query($sql, $query)) {
            $valide = "vous avez bien modifié '$login' à '$newLogin' <br>";
            header('Location:profil.php');
            $_SESSION['login'] = $newLogin;

        }

    } else {
        $vide = "Remplissez le formulaire SVP !!<br>";
    }
}
// Fin de chagement de l'ancien login

/////////////////////////////////////////
/////////////////////////////////////////

// Début de chagement de l'ancien Nom

if (isset($_POST['modifiernom'])) { // si l'utilisateurs appuis sur modifier le Nom s'affichera le fomulaire pour changer le Nom
    $formNewNom = '
            <form method="post">
            <input type="text" name="newnom" id="nom" placeholder="Entrer un nouveau Nom">
            <input type="submit" name="submitnewnom" value="valider">
            </form>';
    $newNom = $_POST['newnom'];
}

if (isset($_POST['submitnewnom'])) { // si l'utilisateur appuis sur valider (submitnewnom)
    $newNom = $_POST['newnom'];

    if (!empty($newNom)) { // si le formulaire est vide s'affichera un message erreur
        $query = "UPDATE utilisateurs SET nom='" . htmlentities($_POST['newnom']) . "' WHERE login='$login'";

        if (mysqli_query($sql, $query)) {
            $valide = "vous avez bien modifier votre nom($nom) à ($newNom)";
            header("Refresh:3");
        }

    } else {
        $vide = "Remplissez le formulaire SVP !!<br>";
    }
}
// Fin de chagement de l'ancien Nom

/////////////////////////////////////////
/////////////////////////////////////////

// Début de chagement de l'ancien Prénom

if (isset($_POST['modifierprenom'])) { // si l'utilisateurs appuis sur modifier le Prénom ca affichera le fomulaire pour changer le Prénom
    $formNewPrenom = "
            <form method=\"post\">
            <input type=\"text\" name=\"newprenom\" id=\"nom\" placeholder=\"Entrer un nouveau Prénom\">
            <input type=\"submit\" name=\"submitnewprenom\" value=\"valider\">
            </form>
        ";
}

if (isset($_POST['submitnewprenom'])) { // si l'utilisateur appuis sur valider (submitnewprenom)
    $newPrenom = trim($_POST['newprenom']);

    if (!empty($newPrenom)) { // si le formulaire est vide s'affichera un message erreur
        $query = "UPDATE utilisateurs SET prenom='" . htmlentities($newPrenom) . "' WHERE login='$login'";

        if (mysqli_query($sql, $query)) {
            $valide = "vous avez bien modifier votre prénom($prenom) à ($newPrenom)";
            header("Refresh:3");
        }

    } else {
        $vide = "Remplissez le formulaire SVP !!<br>";
    }
}
// Fin de chagement de l'ancien Prénom

/////////////////////////////////////////
/////////////////////////////////////////

// Début de chagement de l'ancien Mot de passe

if (isset($_POST['modifierpass'])) { // si l'utilisateurs appuis sur modifier le Password ca affichera le fomulaire pour changer le Password
    $formNewPass = "
            <form method=\"post\">
            <input type=\"text\" name=\"pass\" id=\"nom\" placeholder=\"Entrer l'ancien Password\"><br>
            <input type=\"text\" name=\"newpass\" id=\"nom\" placeholder=\"Entrer un nouveau Password\"><br>
            <input type=\"text\" name=\"confirmnewpass\" id=\"nom\" placeholder=\"Confirmer le nouveau Password\"><br>
            <input type=\"submit\" name=\"submitnewpass\" value=\"valider\">
            </form>
        ";
}

if (isset($_POST['submitnewpass'])) {
    $newpassword = trim($_POST['newpass']);
    $confirm_password = trim($_POST['confirmnewpass']);

    if (!empty($_POST['pass']) && !empty($newpassword) && !empty($confirm_password)) {
        $query = "UPDATE utilisateurs SET password='" . htmlentities($newpassword) . "' WHERE login='$login'";
        if ($_POST['pass'] == $password) {
            if ($newpassword != $confirm_password) {
                $same = "le mot de passe n'est pas le même !!<br>";
            } elseif (mysqli_query($sql, $query)) {
                echo "Le mot de passe a bien été changé";
                header("Refresh:3");
            }
        } else {
            $wrong = "Le mot de passe que vous avez inseré n'est pas correct";
        }

    } else {
        $wrong = "Le mot de passe que vous avez inseré n'est pas correct";
    }

}
// Fin de chagement de l'ancien Mot de passe
/////////////////////////////////////////
/////////////////////////////////////////

// Pour se déconnecter de la session
if (isset($_POST['deconnecter'])) {
    session_unset();
    header("Location: connexion.php");
}

if (isset($_POST['supprimer'])) {
    $delete = 'êtes-vous sûr de vouloir supprimer votre compte définitivement?<br>
                    <form method="post">
                    <input type="submit" name="oui" value="oui">
                    <input type="submit" name="non" value="non">
                    </form>
                    ';
}

if (isset($_POST['oui'])) {

    (mysqli_query($sql, "DELETE FROM utilisateurs WHERE login = '$login'"));
    session_unset();
    $oui = "Votre compte a bien été supprimé";
    header("Refresh:2");

}

?>
        <form action="" method="post">
        <p>Modifier tes information ici <input type="submit" name="modifier" value="Modifier"></p>
        <p><?php echo $modification ?></p>
        <p><?php echo $formNewLogin ?></p>
        <p><?php echo $formNewNom ?></p>
        <p><?php echo $formNewPrenom ?></p>
        <p><?php echo $formNewPass ?></p>
        <p><?php echo $same ?></p>
        <p><?php echo $existe ?></p>
        <p><?php echo $valide ?></p>
        <p><?php echo $vide ?></p>
        <p><?php echo $wrong ?></p>
        </form>
        <form action="" method="post">
        <input type="submit" name="deconnecter" value="Logout">
        <input type="submit" name="supprimer" value="Supprimer">
        </form>
        <p><?php echo $delete ?></p>
        <p><?php echo $oui ?></p>
    </main>
    <footer>
        <div>
            <p>Copyright 2020 All rights reserved - Samy & Morad</p>
        </div>
    </footer>
</body>
</html>



