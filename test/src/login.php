<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>

    <h2>Login</h2>
    <p>Si vous n'avez pas de compte :
        <a href="register.php">Cliquez ici pour en creer un !</a>
    </p>

    <form action="login.php" method="POST">
        <label for="">Username</label>
        <input type="text" name="login" requirer="requirer" placeholder="Bobby1234">

        <label for="">Password</label>
        <input type="text" name="pass" required="required" placeholder="**********">

        <input type="submit" name="submit" value="Connexion">
    </form>

    <?php
    $servername = "db";
    $dbname = "data";
    $name = "root";
    $mdp = "password";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $name, $mdp);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST['login']) && !empty($_POST['pass'])) {

        $username = $_POST['login'];
        $password = $_POST['pass'];

        $requete = "SELECT * from authentification where username =:username";
        $query = $conn->prepare($requete);

        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();


        if ($query->rowCount() > 0) {

            if (($_POST['pass'] === $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
    ?>
                <script>
                    window.location = "posts.php";
                </script>
            <?php
            } else { ?>

                <span>Mot de passe incorrect <?php print($username) ?></span><br>
            <?php

            }
        } else { ?>
            <span>Username inconnu</span><br>
            <a href="register.php">Pour vous register cliquez ici !</a>
    <?php

        }
    }

    ?>

</body>

</html>