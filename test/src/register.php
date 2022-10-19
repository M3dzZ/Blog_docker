<?php

require_once './connect.php';

if (isset($_POST['name'])) {

    $username = $_POST['name'];
    $password = $_POST['pass'];
    $sql = "SELECT username from authentification where username =:username";
    $query = $conn->prepare($sql);

    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();


    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
?>

        <span>Ce nom est deja utilise, veuillez en choisir un nouveau</span>
<?php

    } else {
        $requete = "INSERT INTO authentification (username,password) VALUES('$username','$password')";
        $resultat = $conn->query($requete);
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>
    <h2>Register</h2>

    <form action="register.php" method="POST">
        <label for="">Username</label>
        <input type="text" name="name" requirer="requirer" placeholder="Bobby1234">

        <label for="">Password</label>
        <input type="password" name="pass" required="required" placeholder="**********">

        <input type="submit" name="submit" value="Connexion">

    </form>


</body>

</html>