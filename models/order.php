<?php
session_start();
require_once "../setup/konekcija.php";

if (isset($_SESSION['cart'])) {
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $products = array();
    
    $korisnik_id = $_SESSION['korisnik']->id;
    
    
    $totalAmount = 0.00;


    $sql = "INSERT INTO porudzbina (ukupan_iznos) VALUES (?)";
    $stmt = $konekcija->prepare($sql);
    $stmt->execute([$totalAmount]);
    $id_porudzbine = $konekcija->lastInsertId();

    if ($products_in_cart) {
        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
        $stmt = $konekcija->prepare('SELECT * FROM proizvodi WHERE id IN (' . $array_to_question_marks . ')');
        $stmt->execute(array_keys($products_in_cart));
        $products = $stmt->fetchAll();
        
        foreach ($products as $product) {
            $proizvodId = $product->id;
            $proizvodCena = $product->cena;
            $kolicina = $products_in_cart[$proizvodId];
    
            $subtotal = $proizvodCena * $kolicina;
            $totalAmount += $subtotal;
    
            $sqlDetails = "INSERT INTO detalji_porudzbine (korisnik_id, proizvod_id, id_porudzbine, cena_proizvoda, kolicina) VALUES (?,?, ?, ?, ?)";
            $stmtDetails = $konekcija->prepare($sqlDetails);
            $stmtDetails->execute([$korisnik_id, $proizvodId, $id_porudzbine, $proizvodCena, $kolicina]);
        }
    }
    
    $sqlUpdateAmount = "UPDATE porudzbina SET ukupan_iznos = ? WHERE id = ?";
    $stmtUpdateAmount = $konekcija->prepare($sqlUpdateAmount);
    $stmtUpdateAmount->execute([$totalAmount, $id_porudzbine]);
    

    unset($_SESSION['cart']);

    exit();
} else {
    http_response_code(400);
    exit();
}

?>
