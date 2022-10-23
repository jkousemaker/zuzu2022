<?php
session_start();

if(isset($_POST["delete"])) {
    array_pop($_SESSION["sushiNames"]);
}

header('location: ../index.php');