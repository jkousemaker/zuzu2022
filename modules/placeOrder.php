<?php
session_start();
global $pdo;
$pdo = new PDO('mysql:host=localhost;dbname=zuzu', 'root', '');

$_SESSION["yes"] = "yes";

if($_SESSION["sushiNames"]) {
    if(isset($_POST["delete"])) {
        array_pop($_SESSION["sushiNames"]);
    } else if(isset($_POST["submit"])) {
        $arr = $_SESSION["sushiNames"];
        $arrLength = count($arr);
        $inputError = false;

        //stores all form input in variables
        $fname = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phoneNumber"];
        $city = $_POST["city"];
        $postal = $_POST["postalcode"];
        $adress = $_POST["adres"];

        $sushiAmounts = [];
        $sushiStocks = [];
        $stockAlert = false;


        $sql = $pdo->prepare("SELECT amount FROM sushi");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        //get all the stocks from db
        foreach($result as $data) {
            array_push($sushiStocks, $data['amount']);
        }

        $stockCount = count($sushiStocks);



        //gets email out of database if email already exists
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM customer WHERE email = '$email'");
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        //checks if any input fields are empty
        if(empty($result["email"])) {
            if (!empty($fname) && !empty($phone) && !empty($city) && !empty($postal) && !empty($adress)) {
                for ($i = 0; $i < $arrLength; $i++) {

                    array_push($sushiAmounts, $_POST[$arr[$i]]);

                    //checks if email is already in use
                    if (empty($result["email"])) {
                        //checks if any input fields have 0
                        if ($sushiAmounts[$i] != 0) {
                            $inputError = false;
                        } else {
                            $inputError = true;
                            $_SESSION["msg"] = "U heeft niet aangegeven hoeveel sushi u wilt bestellen bij een of meerdere producten";
                        }
                    }



                }
                    for ($i = 0; $i < $arrLength; $i++) {
                        $sushiAmount = $sushiAmounts[$i];
                        //gets stock of current sushi
                        $sql = $pdo->prepare("SELECT amount FROM sushi WHERE name = '$arr[$i]'");
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);

                        $sushiStock = $result["amount"];
                        if ($sushiStock < $sushiAmount) {
                            $_SESSION["msg"] = "Een van de sushi die u heeft geselecteerd heeft niet genoeg voorraad.";
                            $inputError = true;
                        }
                    }
            } else {
                $_SESSION["msg"] = "U moet al uw gegevens invullen";
                $inputError = true;
            }
        } else {
            $inputError = true;
            $_SESSION["msg"] = "Deze email adres is al gebruikt";
        }



        //checks if there were any input errors
        if(!$inputError) {
                global $pdo;
                $pdo = new PDO('mysql:host=localhost;dbname=zuzu', 'root', '');
                //inserts customers information in db
                $sql = $pdo->prepare("INSERT INTO customer (email, phone, fname, address, city, zipcode) VALUES ('$email', '$phone', '$fname', '$adress', '$city', '$postal')");
                $sql->execute();

                //get id of current user
                $sql = $pdo->prepare("SELECT id FROM customer WHERE email = '$email'");
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);

                $id = $result["id"];

                //put user_id in order table
                $sql = $pdo->prepare("INSERT INTO orders (user_id) VALUES ('$id');");
                $sql->execute();

                //get order_id
                $sql = $pdo->prepare("SELECT id FROM orders WHERE user_id = '$id'");
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);

                $orderId = $result["id"];
                $totalPrice = 0;

                for ($i = 0; $i < $arrLength; $i++) {
                    //get current sushi id in for loop
                    $sql = $pdo->prepare("SELECT id FROM sushi WHERE name = '$arr[$i]'");
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);

                    $sushiId = $result["id"];
                    $sushiAmount = $sushiAmounts[$i];

                    //insert an order link that links multiple or single product(s) to order
                    $sql = $pdo->prepare("INSERT INTO orderlink (order_id, product_id, amount) VALUES ('$orderId', '$sushiId', '$sushiAmount');");
                    $sql->execute();

                    //gets price from current sushi
                    $sql = $pdo->prepare("SELECT price FROM sushi WHERE name = '$arr[$i]'");
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);

                    $sushiPrice = $result["price"];


                    $stockInsert = $sushiStock - $sushiAmount;

                    //updates sushi stock
                    $sql = $pdo->prepare("UPDATE sushi SET amount = '$stockInsert' WHERE id = '$sushiId';");
                    $sql->execute();

                    //keeps calculating total price of order till for loop ends
                    $totalProductPrice = $sushiPrice * $sushiAmount;
                    $totalPrice += $totalProductPrice;

                }

                //set total price of order
                $sql = $pdo->prepare("UPDATE orders SET price = '$totalPrice' WHERE id = '$orderId';");
                $sql->execute();

                $_SESSION["page"] = "ordered";
                $_SESSION["sushiNames"] = [];
                $_SESSION["email"] = $email;
                $_SESSION["msg"] = "";
            }
        } else {
            $_SESSION["page"] = "ordered";
        }

} else {
    $_SESSION["msg"] = "U heeft nog geen producten geselecteerd.";
}

header('location: ../index.php');