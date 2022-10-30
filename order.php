<div class="wrapper">
    <?php
    $sushiNames = $_SESSION["sushiNames"];
     $sushiNameCount = count($_SESSION["sushiNames"]);


    $localTime = date("H:i");
    $localHour = date("G");
    $localDate = date("j F, Y");
    $estimatedDeliveryHour = $localHour + 1;

    $errorMsg = "";

    $open = true;
    switch($localHour){
        case $localHour >= 6 && $localHour <= 11:
            $dayPeriod = "morgen";
            $tempMinutes = 12;
            break;
        case $localHour >= 12 && $localHour <= 17:
            $dayPeriod = "middag";
            $tempMinutes = 37;
            break;
        case $localHour >= 18 && $localHour <= 24:
            $dayPeriod = "avond";
            $tempMinutes = 54;
            break;
        case $localHour >= 0 && $localHour <= 5:
            $dayPeriod = "nacht";
            $tempMinutes = 12;
            $open = false;
            break;
        default:
            $dayPeriod = "morgen";
            $tempMinutes = 12;
            break;
    }

    if($open) {

        echo "<div class='order-wrapper'>
                <h1>Goede $dayPeriod!</h1>
                <div class='order'>
                    <div class='day-information'>
                        <div class='current-date'>
                            <h3>Vandaag is het:</h3>
                            <p>$localDate</p>
                        </div>
                        <div class='delivery-times'>
                            <div>
                                <p>Huidige tijd:</p>
                                <p>$localTime</p>
                            </div>
                            <div>
                                <p>Verwachte bezorg tijd:</p>
                                <p>$estimatedDeliveryHour:$tempMinutes</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class='forms'>
                        <form method='POST' action='modules/addSushi.php'>
                                <div class='products-grid'>
                                    ";
                                    global $pdo;
                                    $sql = $pdo->prepare("SELECT * FROM sushi");
                                    $sql->execute();
                                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    $i = 1;

                                    foreach($result as $data) {
                                        echo "    
                                                        <div class='product-underlay'>
                                                                    <div class='product'>
                                                                        <img src='img/$i.jpg' alt='". $data['name'] ."'>
                                                                        <input type='submit' value='". $data['name'] ."' name='addSushi'>
                                                                        <p class='product-price'>". $data['price'] ."€</p>
                                                                        <p class='product-stock'>Voorraad: ". $data['amount'] ."</p>
                                                                    </div>
                                                                </div>
                                                    ";
                                        $i++;
                                    }
                            echo"
                                </div>
                            </form>
                    
                    <div class='order-display'>
                        <form method='POST' action='modules/placeOrder.php'>
                            <div class='user-input'>
                                <input type='text' placeHolder='Volledige naam' name='name'>
                                <input type='text' placeholder='Email' name='email'>
                                <input type='tel' placeholder='Telefoon nummer' name='phoneNumber'>
                                <input type='text' placeholder='Stad' name='city'>
                                <input type='text' placeholder='Postcode' name='postalcode'>
                                <input type='text' placeholder='Adres' name='adres'>
                                <input type='submit' value='submit' name='submit'>
                            </div>
                                
                            <table class='order-overview'>
                                <thead>
                                    <tr>
                                        <th>Soort sushi</th>
                                        <th>Hoeveelheid</th>
                                        <th>Prijs</th>
                                    </tr>
                                </thead>
                                <tbody>
                        ";

                        $temp = $sushiNameCount - 1;
                        for($i = 0; $i < $sushiNameCount; $i++) {
                            $sql = $pdo->prepare("SELECT price FROM sushi WHERE name = '$sushiNames[$i]'");
                            $sql->execute();
                            $result = $sql->fetch(PDO::FETCH_ASSOC);

                            $sushiPrice = $result["price"];
                            echo "<tr>
                                    <td>$sushiNames[$i]</td>
                                    <td><input class='sushi-price-input' value='0' min='0' name='$sushiNames[$i]' type='number'></td>
                                    <td class='sushi-price'>".$sushiPrice." €</td>
                                    ";
                                    if($i === $temp) {
                                        echo "<td class='delete-button'><input type='submit' value='delete' name='delete'></td>";
                                    }
                            echo "     </tr>";
                        }
                   echo"        </tbody>
                            </table>
                        </form>
                    </div>
                    </div>
                </div>
            </div>";
    } else {
        echo "<h1> We zijn op dit moment gesloten!</h1>";
    }

    if(isset($_POST['addSushi'])) {
        $duplicate = false;
        if(!$sushiNameCount) {
            array_push($_SESSION["sushiNames"], $_POST['addSushi']);
        } else {
            for ($i = 0; $i < $sushiNameCount; $i++) {
                if ($sushiNames[$i] === $_POST['addSushi']) {
                    $_SESSION["msg"] = "U heeft deze sushi al toegevoegd!";
                    $duplicate = true;
                }
            }
            if (!$duplicate) {
                array_push($_SESSION["sushiNames"], $_POST['addSushi']);
            }
        }
    }

    if(isset($_POST['delete'])) {
        for($i = 0; $i < $sushiNameCount; $i++) {
            if($sushiNames[$i] === $_POST['delete']) {
                echo "<br>";
                unset($sushiNames[$i]);
                $_SESSION['sushiNames'] = $sushiNames;



                $_SESSION["msg"] = "Sushi deleted!";
            }
        }
    }

    ?>


