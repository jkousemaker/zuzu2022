<?php
    session_start();
    $email = $_POST["email"];

    global $pdo;
    $pdo = new PDO('mysql:host=localhost;dbname=zuzu', 'root', '');
    $sql = $pdo->prepare("SELECT * FROM customer WHERE email = '$email'");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    //checks if email exists
    if(empty($result["email"])) {
        $_SESSION["msg"] = "Er is geen bestelling geplaats met dit email adres!";
    } else {
        $_SESSION["email"] = $result["email"];
        $_SESSION["msg"] = "Order gevonden!";
    }

    header('location: ../index.php');