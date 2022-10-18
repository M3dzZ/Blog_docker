<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=index.css">

    <title>Document</title>
</head>

<body>


    <form action="" method="POST">
        <input type="text" name="comment" requirer="requirer" placeholder="Ecrire un post">
        <input type="submit" value="Publier">
        <a href="login.php">Déconnexion</a>
    </form>


    <?php
    $servername = "db";
    $dbname = "data";
    $name = "root";
    $mdp = "password";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $name, $mdp);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $comments = $conn->query('SELECT username,comments FROM posts INNER JOIN authentification ON posts.user_id = authentification.id');
    // echo print_r($query, true);

    while ($row = $comments->fetch()) { ?>
        <p> <?php echo $row['username'] ?>:
            <?php echo $row['comments'] ?></p>
    <?php
    }

    if (!empty($_POST['comment'])) {

        $post = $_POST['comment'];
        $user_id = $_SESSION['user_id'];
        $requete = "INSERT INTO posts (comments,user_id) VALUES('$post','$user_id')";
        $resultat = $conn->query($requete);
        $message = 'Votre publication a bien ete poste';
    } else {
        echo ("Vous n'avez rien ecrit");
    }

    ?>

</body>

</html>