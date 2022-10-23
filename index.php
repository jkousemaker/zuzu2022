<?php
    session_start();


include_once 'includes/head.php';
include_once 'includes/jumbotron.php';

if(!$_SESSION["sushiNames"]) {
    $_SESSION["sushiNames"] = [];
}

if(!$_SESSION["page"]) {
    $_SESSION["page"] = "home";
}


switch ($_SESSION["page"]) {
    case "home" :
        include_once 'includes/home.php';
        var_dump(1);
        break;
    case "order" :
        include_once 'order.php';
        var_dump(2);
        break;
    case "overview" :
        include_once 'overview.php';
        var_dump(3);
        break;
    default :
        include_once 'includes/home.php';
        var_dump(4);
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