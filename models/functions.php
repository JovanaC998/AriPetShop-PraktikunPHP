<?php

function upisiOdgovorAnkete(){
    return "INSERT INTO korisnik_odgovor(id_korisnika,id_odgovora) VALUES(:idK,:idO);";
}
function izbrisiProizvod($id){
    global $konekcija;
    $upit ="DELETE FROM proizvodi where id=:id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $id);
    $rezultat = $priprema->execute();
}



function izbrisiKorisnike($id){
    global $konekcija;
    $upit ="DELETE FROM korisnik where id=:id";
    $priprema = $konekcija->prepare($upit);    
    $priprema->bindParam(":id", $id);    
    $rezultat = $priprema->execute();
}

function izbrisiKategije($id){
    global $konekcija;
    $upit ="DELETE FROM kategorija where id=:id";
    $priprema = $konekcija->prepare($upit); 
    $priprema->bindParam(":id", $id);       
    $rezultat = $priprema->execute();
}

function izbrisiTip($id){
    global $konekcija;
    $upit ="DELETE FROM tip where id=:id";
    $priprema = $konekcija->prepare($upit); 
    $priprema->bindParam(":id", $id);       
    $rezultat = $priprema->execute();
}

function unesiKategorijuTip($tabela,$naziv){
    global $konekcija;
    $upit = "INSERT INTO $tabela (naziv) VALUES(:naziv)" ;
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":naziv",$naziv);
    $rezultat = $priprema->execute();
}
function registracija($ime, $prezime, $email, $siframd5, $vremeReg, $token)		
{
    global $konekcija;
    $upit="INSERT INTO korisnik (ime, prezime, email, lozinka, datum_registracije, token, id_uloga)
    VALUES (:ime, :prezime, :email, :sifra, :datum_registracije, :token, '1')";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(':ime', $ime);
    $priprema->bindParam(':prezime', $prezime);
    $priprema->bindParam(':email', $email);
    $priprema->bindParam(':sifra', $siframd5);
    $priprema->bindParam(':datum_registracije', $vremeReg);
    $priprema->bindParam(':token', $token);
    $rezultat = $priprema->execute();
}

function logovanje(){
    return "SELECT * from korisnik where email=:email and lozinka=:sifra";
}

echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/dist/css/alertify.min.css" />';
echo '<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/dist/alertify.min.js"></script>';

function proveriNeuspesnePokusaje($email, $konekcija) {
    $neuspesni_pokusaji = isset($_SESSION['neuspesni_pokusaji']) ? $_SESSION['neuspesni_pokusaji'] : 0;
    $vreme_poslednjeg_pokusaja = isset($_SESSION['vreme_poslednjeg_pokusaja']) ? $_SESSION['vreme_poslednjeg_pokusaja'] : 0;
    $trenutno_vreme = time();

    if ($trenutno_vreme - $vreme_poslednjeg_pokusaja > 300) {
        $neuspesni_pokusaji = 0;
    }

    $neuspesni_pokusaji++;

    if ($neuspesni_pokusaji >= 3) {
        zakljucajNalog($email, $konekcija);
        posaljiMejl($email);
        $_SESSION['neuspesni_pokusaji'] = 0; 
        return false;
    } else {
        $_SESSION['neuspesni_pokusaji'] = $neuspesni_pokusaji;
        $_SESSION['vreme_poslednjeg_pokusaja'] = $trenutno_vreme;
        return true;
    }
}

function zakljucajNalog($email, $konekcija) {
    $upit = $konekcija->prepare("UPDATE korisnik SET blokiran = 1 WHERE email = :email");
    $upit->bindParam(":email", $email);
    $upit->execute();
}


function posaljiMejl($email) {

    $subject = "Account Blocked";
		$message = "We regret to inform you that your user account has been temporarily locked due to multiple consecutive failed login attempts. To regain access to your account, please contact our administrator.";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <jovanaciric701@gmail.com>' . "\r\n";
		ini_set("SMTP", "ssl://smtp.gmail.com");
		ini_set("smtp_port", "465");

		mail($email,$subject,$message,$headers);
}


function odblokirajKorisnika($id){
    global $konekcija;
    $upit = "update korisnik set blokiran='0' where id=:id";
    $priprema = $konekcija->prepare($upit);    
    $priprema->bindParam(":id", $id);    
    $rezultat = $priprema->execute();
}


function brojProizvoda() {
    global $konekcija;
    $brojPoStrani = 10;
    $countUpit = "SELECT COUNT(*) AS brojProizvoda from proizvodi";
    $rezultatCount = $konekcija->query($countUpit)->fetch();
    $brojRez = $rezultatCount->brojProizvoda;
    return ceil($brojRez / $brojPoStrani);
}

function updateVremeLogogvanja($date, $id) {
    global $konekcija;
    $upit = "update korisnik set vreme_logovanja=:date where id=:id";
    $priprema = $konekcija->prepare($upit);    
    $priprema->bindParam(":id", $id);  
    $priprema->bindParam(":date", $date);    
    $rezultat = $priprema->execute();
}

function brojUlogovanihKorisnikaUPoslednjih24h(){
    global $konekcija;
    $upit = "SELECT COUNT(*) AS broj FROM korisnik WHERE vreme_logovanja >= NOW() - INTERVAL 1 DAY";
    $rezultat = $konekcija->query($upit);
    $broj = $rezultat->fetchColumn();
    return $broj;
}