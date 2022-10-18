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
        <input type="text" name="passW" required="required" placeholder="**********">

        <input type="submit" name="submit" value="Connexion">

    </form>

    <?php

    $servername = "db";
    $dbname = "data";
    $name = "root";
    $mdp = "password";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $name, $mdp);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_POST['name'])) {

        $username = $_POST['name'];
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

        ?>
            <script>
                window.location = "posts.php";
            </script>
    <?php

        }
    }
    ?>

</body>

</html>