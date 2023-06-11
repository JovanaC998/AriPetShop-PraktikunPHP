<?php
session_start();
require_once "../setup/konekcija.php";
if (isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->id_uloga == 2) {
    if (isset($_POST["unesi"])) {
        $validno = true;

        $naziv    = $_POST["naziv"];
        $cena   = floatval($_POST["cena"]);
        $opis     = $_POST["opis"];
        $katId    = $_POST["listaKategorija"];
        $istaknut = intval($_POST["istaknut"]);
        $cenaPrethodna = $_POST["prethpdnaCena"];

        $regexNaziv="/^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$/";

        if(!preg_match($regexNaziv, $naziv)){
            $validno = false;
        }
        if($cena <= 0){
            $validno = false;
        }
        if ($opis != strip_tags($opis)) {
            $validno = false;
        }
        if ($istaknut != 0 && $istaknut != 1 ) {
            $validno = false;
        }
        if($istaknut == 1){
            if($cenaPrethodna =="" || floatval($cenaPrethodna)<=0 || floatval($cenaPrethodna) < $cena){
                $validno = false;
            }
        }
        $upit = "SELECT id FROM kategorija WHERE id=:katId";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(":katId", $katId);
        
        $rezultat = $priprema->execute();
        if(!$rezultat){
            $validno = false;
        }

        $slika        = $_FILES["slika"];
        $slikaName    = $slika["name"];
        $slikaTmpName = $slika["tmp_name"];
        $slikaSize    = $slika["size"];
        $slikaError   = $_FILES["slika"]["error"];
        $slikaType    = $slika["type"];

        $slikaExp        = explode('.', $slikaName);
        $slikaEkstenzija = strtolower(end($slikaExp));

        $dozvoljeno = array(
            'jpg',
            'jpeg',
            'png'
        );

        if (in_array($slikaEkstenzija, $dozvoljeno) && $validno) {
            if ($slikaError === 0) {
                $slikaFolder = "img/allProducts/" . $slikaName;
                move_uploaded_file($slikaTmpName, $slikaFolder);
                if($istaknut == 1){
                    $upit = "INSERT INTO proizvodi (naziv, slika, alt, cena, prethodna_cena, istaknut, opis, id_kategorija)
                            VALUES (:naziv, :slika, :alt, :cena, :prethodnaCena, 1, :opis, :katId)";

                    $priprema = $konekcija->prepare($upit);
                    $priprema->bindParam(':naziv', $naziv);
                    $priprema->bindParam(':slika', $slikaFolder);
                    $priprema->bindParam(':alt', $naziv);
                    $priprema->bindParam(':cena', $cena);
                    $priprema->bindParam(':prethodnaCena', $cenaPrethodna);
                    $priprema->bindParam(':opis', $opis);
                    $priprema->bindParam(':katId', $katId);
                }else {
                    $upit = "INSERT INTO proizvodi (naziv, slika, alt, cena, istaknut, opis, id_kategorija)
                            VALUES (:naziv, :slika, :alt, :cena, 0, :opis, :katId)";

                    $priprema = $konekcija->prepare($upit);
                    $priprema->bindParam(':naziv', $naziv);
                    $priprema->bindParam(':slika', $slikaFolder);
                    $priprema->bindParam(':alt', $naziv);
                    $priprema->bindParam(':cena', $cena);
                    $priprema->bindParam(':opis', $opis);
                    $priprema->bindParam(':katId', $katId);
                }
                $rezultat = $priprema->execute();
                header('Location: ../index.php?page=admin');
                $_SESSION['alert_message'] = "Successfully Added Product.";
            }
        }else {
            header('Location: ../index.php?page=admin');
            $_SESSION['alert_message'] = 'Data is not valid.';
        }

        
    }
} else {
    header("Location: index.php");

}