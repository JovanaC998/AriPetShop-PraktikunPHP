<?php
include_once "../setup/konekcija.php";
session_start();

if(isset($_SESSION['korisnik'])){
    if(isset($_POST["send"])){
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["textArea"];
        $petType = $_POST["type"];
    
        $idKorisnik = $_SESSION['korisnik']->id;
    
        $timeMessage = date("Y-m-d H:i:s", time());
    
        $reText = "/^[A-ZŠĐČĆŽa-zšđčćž0-9\.,?!\s]{3,}$/u";
        $reName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{1,11}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{1,11})+$/u";
        $reEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        $rePhone = "/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/";
    
        $validno = true;
    
        if (!preg_match($reName, $fullName)) {
            $validno = false;
        }
    
        if (!preg_match($reEmail, $email)) {
            $validno = false;
        }
    
        if (!preg_match($rePhone, $phone)) {
            $validno = false;
        }
    
        if (!preg_match($reText, $message) && $message != strip_tags($message)) {
            $validno = false;
        }
    
        if ($petType == 0) {
            $validno = false;
        }

        if ($validno) {
            $upit="INSERT INTO poruka (ime_prezime, email, telefon, tekst_poruke, datum_poruke, id_tip, id_korisnik)
                    VALUES (:ime_prezime, :email, :telefon, :tekst_poruke, :datum_poruke, :id_tip, :id_korisnik)";
        
            $priprema = $konekcija->prepare($upit);

            $priprema->bindParam(':ime_prezime', $fullName);
            $priprema->bindParam(':email', $email);
            $priprema->bindParam(':telefon', $phone);
            $priprema->bindParam(':tekst_poruke', $message);
            $priprema->bindParam(':datum_poruke', $timeMessage);
            $priprema->bindParam(':id_tip', $petType);
            $priprema->bindParam(':id_korisnik', $idKorisnik);

            $rezultat = $priprema->execute();

            http_response_code(200);

        } else {
            http_response_code(400);
        }
        
    }
} else {
    http_response_code(401);
}
?>