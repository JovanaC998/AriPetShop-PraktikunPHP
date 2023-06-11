<?php
session_start();
require_once "../setup/konekcija.php";
if (isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->id_uloga == 2) {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if (isset($_POST["izmeni"])) {
            $validno = true;
    
            $naziv = $_POST["naziv"];
            $cena = floatval($_POST["cena"]);
            $opis = $_POST["opis"];
            $katId = $_POST["listaKategorija"];
            $istaknut = $_POST["istaknut"];
            $cenaPrethodna = $_POST["prethodnaCena"];
    
            $regexNaziv = "/^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$/";
    
            if (!preg_match($regexNaziv, $naziv)) {
                $validno = false;
            }
            
            if ($cena <= 0) {
                $validno = false;
            }
    
            if ($opis != strip_tags($opis)) {
                $validno = false;
            }
    
            if ($istaknut != 0 && $istaknut != 1) {
                $validno = false;
            }
    
            if ($istaknut == 1) {
                if ($cenaPrethodna == '' || floatval($cenaPrethodna) <= 0 || floatval($cenaPrethodna) < $cena) {
                    $validno = false;
                }
            }
            $upitkat = "SELECT id FROM kategorija WHERE id=:katId";
            $pripremakat = $konekcija->prepare($upitkat);
            $pripremakat->bindParam(":katId", $katId);
    
            $rezultatkat = $pripremakat->execute();
            if (!$rezultatkat) {
                $validno = false;
            }
    
            if (isset($_FILES["slika"]) && ($_FILES['slika']['error'] == 0)) {
    
                $slikaName = $_FILES["slika"]["name"];
                $slikaTmpName = $_FILES["slika"]["tmp_name"];;
                $slikaSize = $_FILES["slika"]["size"];
                $slikaError = $_FILES["slika"]["error"];
                $slikaType = $_FILES["slika"]["type"];;
    
                $slikaExp = explode('.', $slikaName);
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
                        if ($istaknut == 1) {
                            $upit = "UPDATE proizvodi SET naziv=:naziv, slika=:slika, alt=:alt, cena=:cena, 
                            prethodna_cena=:prethodnaCena, istaknut=1, opis=:opis, id_kategorija=:katId WHERE id=:id";
    
                            $priprema = $konekcija->prepare($upit);
                            $priprema->bindParam(':naziv', $naziv);
                            $priprema->bindParam(':slika', $slikaFolder);
                            $priprema->bindParam(':alt', $naziv);
                            $priprema->bindParam(':cena', $cena);
                            $priprema->bindParam(':prethodnaCena', $cenaPrethodna);
                            $priprema->bindParam(':opis', $opis);
                            $priprema->bindParam(':katId', $katId);
                            $priprema->bindParam(':id', $id);
                        } else {
                            $upit = "UPDATE proizvodi SET naziv=:naziv, slika=:slika, alt=:alt, cena=:cena, 
                            istaknut=0, opis=:opis, id_kategorija=:katId WHERE id=:id";
    
    
                            $priprema = $konekcija->prepare($upit);
                            $priprema->bindParam(':naziv', $naziv);
                            $priprema->bindParam(':slika', $slikaFolder);
                            $priprema->bindParam(':alt', $naziv);
                            $priprema->bindParam(':cena', $cena);
                            $priprema->bindParam(':opis', $opis);
                            $priprema->bindParam(':katId', $katId);
                            $priprema->bindParam(':id', $id);
                        }
                        $rezultat = $priprema->execute();
                        header('Location: ../index.php?page=admin');
                        $_SESSION['alert_message'] = "Successfully Updated Product.";
                    }
                } else {
                    header("Location: izmeni.php?id=$id");
                    $_SESSION['alert_message'] = 'Data is not valid.';
                }
            } else {
                if ($validno){
                    if ($istaknut == 1) {
                        $upit = "UPDATE proizvodi SET naziv=:naziv, cena=:cena, prethodna_cena=:prethodnaCena, 
                        istaknut=1, opis=:opis, id_kategorija=:katId WHERE id=:id";
    
                        $priprema = $konekcija->prepare($upit);
                        $priprema->bindParam(':naziv', $naziv);
                        $priprema->bindParam(':cena', $cena);
                        $priprema->bindParam(':prethodnaCena', $cenaPrethodna);
                        $priprema->bindParam(':opis', $opis);
                        $priprema->bindParam(':katId', $katId);
                        $priprema->bindParam(':id', $id);
                    } else {
    
                        $upit = "UPDATE proizvodi SET naziv=:naziv, cena=:cena, istaknut=0, opis=:opis, 
                        id_kategorija=:katId WHERE id=:id";
    
                        $priprema = $konekcija->prepare($upit);
                        $priprema->bindParam(':naziv', $naziv);
                        $priprema->bindParam(':cena', $cena);
                        $priprema->bindParam(':opis', $opis);
                        $priprema->bindParam(':katId', $katId);
                        $priprema->bindParam(':id', $id);
                    }
                    $rezultat = $priprema->execute();
                    header('Location: ../index.php?page=admin');
                    $_SESSION['alert_message'] = "Successfully Updated Product.";
                } else {
                    header("Location: izmeni.php?id=$id");
                    $_SESSION['alert_message'] = 'Data is not valid.';
                }
            }
        }
    }
    
    
} else {
    header("Location: index.php");
}
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>