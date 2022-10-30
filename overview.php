<?php
global $pdo;

if(isset($_SESSION['email'])) {
    $mail = $_SESSION['email'];

    $sql = $pdo->prepare("SELECT * FROM customer WHERE email =  '$mail'");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    $name = $result["fname"];
    $phone = $result["phone"];
    $city = $result["city"];
    $postal = $result["zipcode"];
    $address = $result["address"];
    $id = $result["id"];
    $totalprice = 0;

    echo"
        <div class='wrapper'>
            <h1>Bedankt voor uw bestelling!</h1>
            <h3>Wilt u een andere bestelling zoeken?</h3>
            <form action='modules/searchOrder.php' class='search' method='POST'>
                <input placeholder='Email adres' name='email' type='text'>
                <input type='submit' value='Zoeken' name='submit'>
            </form>
            <div class='display-wrapper'>
                <div class='display-cards kaka'>
                    <table class='order-overview info last'>
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Telefoon Nummer</th>
                            <th>Email</th>
                            <th>Stad</th>
                            <th>Postcode</th>
                            <th>Adres</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>";
    
                            echo "  <td>$name</td>
                                        <td>$phone</td>
                                        <td>$mail</td>
                                        <td>$city</td>
                                        <td>$postal</td>
                                        <td>$address</td>";
    
                            echo"
        
                        </tr>
                        </tbody>
                    </table>
                    <table class='order-overview last'>
                       
                            <thead>
                            <tr>
                                <th>Soort sushi</th>
                                <th>Hoeveelheid</th>
                                <th>Prijs</th>
                            </tr>
                            </thead>
                            <tbody>
                            ";
    
                            global $pdo;
                            $sql = $pdo->prepare("SELECT id FROM orders WHERE user_id = '$id'");
                            $sql->execute();
                            $result = $sql->fetch(PDO::FETCH_ASSOC);
                            $orderId = $result["id"];
    
    
                            global $pdo;
                            $sql = $pdo->prepare("SELECT * FROM orderlink WHERE order_id = '$orderId'");
                            $sql->execute();
                            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
                            foreach($result as $data) {
                                global $pdo;
                                $sushiId = $data["product_id"];
                                $sushiAmount = $data["amount"];
                                $sql = $pdo->prepare("SELECT * FROM sushi WHERE id = $sushiId");
                                $sql->execute();
                                $result = $sql->fetch(PDO::FETCH_ASSOC);
                                $sushiName = $result["name"];
                                $sushiPrice = $result["price"];
                                $sushiTotal = $sushiPrice * $sushiAmount;
    
                                $totalprice += $sushiTotal;
                                echo "<tr>
                                            <th>$sushiName</th>
                                            <th>$sushiAmount</th>
                                            <th>$sushiAmount x $sushiPrice € = $sushiTotal €</th>
                                          </tr>
                                          ";
                            }
    
                            echo "<tr class='total-price'>
                                            <th></th>
                                            <th>Totale prijs:</th>
                                           <th>$totalprice €</th>
                                        </tr>
                                    ";
                            echo "
                            </tbody>
                    
                     
        
                    </table>
                </div>
                
            </div>
    
        </div>
    ";
} else {
    echo"
        <div class='wrapper'>
            <h1>Order overzicht</h1>
            <h3>Zoek hier uw bestelling op.</h3>
            <form action='modules/searchOrder.php' class='search' method='POST'>
                <input placeholder='Email adres' name='email' type='text'>
                <input type='submit' name='submit'>
            </form>
        </div>";
}