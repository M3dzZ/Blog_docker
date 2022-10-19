<?php
require_once './connect.php';

session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit();
}



$comments = $conn->query('SELECT username,comments FROM posts INNER JOIN authentification ON posts.user_id = authentification.id');


if (!empty($_POST['comment'])) {

    $post = $_POST['comment'];
    $user_id = $_SESSION['user_id'];
    $requete = "INSERT INTO posts (comments,user_id) VALUES('$post','$user_id')";
    $resultat = $conn->query($requete);
    $message = 'Votre publication a bien ete poste';
    header("Refresh:0");
    exit();
} else {
    echo ("Vous n'avez rien ecrit");
}

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
        <a href="logout.php">Déconnexion</a>
    </form>

    <?php while ($row = $comments->fetch()) { ?>
        <p> <?php echo $row['username'] ?>:
            <?php echo $row['comments'] ?></p>
    <?php
    } ?>
</body>

</html>