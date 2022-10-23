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
        case $localHour == 0 && $localHour <= 5:
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
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/chirashizushi.jpg' alt='chirashizushi'>
                                            <input type='submit' value='Chirashizushi' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/futomaki.jpg' alt='futomaki'>
                                            <input type='submit' value='Futomaki' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/gunkan-maki.jpg' alt='gunkan maki'>
                                            <input type='submit' value='Gunkanmaki' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/hosomaki-rolls.jpg' alt='hosomaki rolls'>
                                            <input type='submit' value='Hosomakirolls' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/nigirizushi.jpg' alt='nigirizushi'>
                                            <input type='submit' value='Nigirizushi' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/salmon-gunkan.jpg' alt='salmon gunkan'>
                                            <input type='submit' value='Salmongunkan' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/temaki.jpg' alt='temaki'>
                                            <input type='submit' value='Temaki' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/temarizushi.jpg' alt='temarizushi'>
                                            <input type='submit' value='Temarizushi' name='addSushi'>
                                        </div>
                                    </div>
                                    <div class='product-underlay'>
                                        <div class='product'>
                                            <img src='img/uramaki.jpg' alt='uramaki'>
                                            <input type='submit' value='Uramaki' name='addSushi'>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    
                    <div class='order-display'>
                        <form method='POST' action='modules/placeOrder.php'>
                            <div class='user-input'>
                                <input type='text' placeHolder='Volledige naam' name='name'>
                                <input type='text' placeholder='Adres' name='adres'>
                                <input type='text' placeholder='Email' name='email'>
                                <input type='tel' placeholder='Telefoon nummer' name='phoneNumber'>
                                <input type='submit' value='submit' name='submit'>
                            </div>
                                
                            <table>
                                <tr>
                                    <th>Soort sushi</th>
                                    <th>Hoeveelheid</th>
                                    <th>Prijs</th>
                                </tr>
                        ";
                        $temp = $sushiNameCount - 1;
                        for($i = 0; $i < $sushiNameCount; $i++) {
                            echo "<tr>
                                    <td>$sushiNames[$i]</td>
                                    <td><input type='number'></td>
                                    <td>15$</td>
                                    ";
                                    if($i === $temp) {
                                        echo "<td><input type='submit' value='delete' name='delete'></td>";
                                    }
                            "     </tr>";
                        }
                   echo"    </table>
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
            for($i = 0; $i < $sushiNameCount; $i++) {
                if($sushiNames[$i] === $_POST['addSushi']) {
                    $errorMsg = "You already added this sushi!";
                    $duplicate = true;
                }
            }
            if(!$duplicate) {
                array_push($_SESSION["sushiNames"], $_POST['addSushi']);
            }
        }
    }

    if(isset($_POST['delete'])) {
        for($i = 0; $i < $sushiNameCount; $i++) {
            if($sushiNames[$i] === $_POST['delete']) {
                var_dump($sushiNames[$i]);
                echo "<br>";
                unset($sushiNames[$i]);
                $_SESSION['sushiNames'] = $sushiNames;



                $errorMsg = "Sushi deleted!";
            }
        }
    }

    echo $errorMsg;

    ?>


