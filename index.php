<?php
    session_start();

    require_once "setup/konekcija.php";

    include "views/fixed/head.php";
    include "views/fixed/topBar.php";
    include "views/fixed/nav.php";

    if(isset($_GET['page'])){
        $strana = $_GET['page'];
        switch($strana){
            case 'home':
                include "views/pages/home.php";
                break;
            case 'service':
                include "views/pages/service.php";
                break;
            case 'product':
                include "views/pages/product.php";
                break;
            case 'contact':
                include "views/pages/contact.php";
                break;
            case 'about':
                include "views/pages/about.php";
                break;
            case 'login':
                include "views/pages/login.php";
                break;
            case 'register':
                include "views/pages/login.php";
                break;
            case 'admin':
                include "views/pages/admin.php";
                break;
            case 'price':
                include "views/pages/price.php";
                break;
            case 'details':
                include "views/pages/details.php";
                break;
            case 'cart':
                include "views/pages/cart.php";
                break;
            case 'izmeni':
                if (!isset($_SESSION["korisnik"])) {
                header("Location: index.php?page=home");
                } else {
                if ($_SESSION["korisnik"]->id_uloga == 1) {
                    header("Location: index.php?page=home");
                }
            }
                include "views/pages/izmeni.php";
                break;
            
            default:
                include "views/pages/home.php";
                break;
        }
    } else {
        include "views/pages/home.php";
    }

    include "views/fixed/footer.php";
?>
