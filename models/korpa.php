<?php
session_start();
require_once "../setup/konekcija.php";
require_once "functions.php";

if (isset($_SESSION["korisnik"])) {

    if (isset($_POST["send"])) {
        $proizvodId = $_POST["proizvod_id"];
        $kolicina = $_POST["kolicina"];
        $upit = $konekcija->prepare('SELECT * FROM proizvodi WHERE id = ?');
        $upit->execute([$proizvodId]); 
        $product = $upit->fetch(); 

        if ($product && $kolicina > 0) { 
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($proizvodId, $_SESSION['cart'])) {
                    $_SESSION['cart'][$proizvodId] += $kolicina;
                } else {
                    $_SESSION['cart'][$proizvodId] = $kolicina;
                }
            } else {
                $_SESSION['cart'] = array($proizvodId => $kolicina);
            }
        }
    }
} else {
    header('location: ../index.php?page=home');
    exit;
}
?>
