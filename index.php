<?php
require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

// lister les "friends"

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();
// var_dump($friends);

if (count($friends) > 0) {
    echo '<ul>';
    //  liste friends
    foreach ($friends as $friend) {
        echo '<li>';
        echo '<strong>Firstname:</strong> ' .($friend["firstname"]) . '<br>';
        echo '<strong>Lastname:</strong> ' .($friend["lastname"]) . '<br>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo 'la liste est vide .';
}

// insérer un nouveau personnage dans "freind"

// $firstname = $_POST["firstname"];
// $lastname = $_POST["lastname"];
$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";

$insert = $pdo->prepare("INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)");
$insert->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$insert->bindParam(':lastname', $lastname, PDO::PARAM_STR);
$insert->execute();
// header("Location: index.php");
// exit();


$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form>

<form action="index.php" method="post">
  <label for="firtsname" style=color:blue>First name:</label><br>
  <input type="text" id="firstname" name="firstname" ><br>
  <label for="lastname"style=color:blue >Last name:</label><br>
  <input type="text" id="lastname" name="lastname" ><br><br>
  <input style=color:blue type="submit" value="Submit">
</form> 

<?php

if ($insert->errorCode() != 0) {
    $errors = $insert->errorInfo();
    echo "SQL error: " . $errors[2];
} else {
    echo "Insertion réussie!";
}if (count($friends) > 0) {
    echo '<ul>';
   
    
}


?>


</body>
</html>



