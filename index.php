<?php
    session_start();
include_once 'includes/db.php';
include_once 'includes/head.php';
if(!empty($_SESSION["msg"])) {
    include_once 'includes/warning.php';
}
include_once 'includes/jumbotron.php';

if(!isset($_SESSION["sushiNames"])) {
    $_SESSION["sushiNames"] = [];
}

if(!isset($_SESSION["page"])) {
    $_SESSION["page"] = "home";
}

if(!isset($_SESSION["msg"])) {
    $_SESSION["msg"] = "";
}


switch ($_SESSION["page"]) {
    case "home" :
        include_once 'includes/home.php';
        break;
    case "order" :
        include_once 'order.php';
        break;
    case "overview" :
        include_once 'overview.php';
        break;
    case "ordered" :
        include_once 'ordered.php';
        break;
    default :
        include_once 'includes/home.php';
        break;
}

include_once 'includes/footer.php';

if(isset($_POST["submit"])) {
    switch ($_POST["submit"]) {
        case "Home" :
            $_SESSION["page"] = "home";
            break;
        case "Overzicht" :
            $_SESSION["page"] = "overview";
            break;
        case "Bestellen" :
            $_SESSION["page"] = "order";
            break;
    }
    header('location: index.php');
}

$_SESSION["msg"] = "";

