<?php
session_start();
$sushiName = $_POST['addSushi'];
$sushiNames = $_SESSION["sushiNames"];
$sushiNameCount = count($sushiNames);

if(isset($sushiName)) {
    $duplicate = false;
    if(!$sushiNameCount) {
        array_push($_SESSION["sushiNames"], $sushiName);
    } else {
        for($i = 0; $i < $sushiNameCount; $i++) {
            if($sushiNames[$i] === $_POST['addSushi']) {
                $_SESSION["msg"] = "You already added this sushi!";
                $duplicate = true;
            }
        }
        if(!$duplicate) {
            array_push($_SESSION["sushiNames"], $sushiName);
        }
    }
}

header('location: ../index.php');
