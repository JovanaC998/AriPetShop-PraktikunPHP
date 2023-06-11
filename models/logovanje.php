<?php
session_start();
if(isset($_SESSION["korisnik"])){
	header("location: ../index.php");
}
include "../setup/konekcija.php";
include "functions.php";
if(isset($_POST['send'])){
	$email = $_POST["email"];
	$sifra = $_POST["lozinka"];
	$siframd5 = md5($sifra);
	$reLozinka = '/^[a-zA-Z0-9!\.@#_\-\[\]\{\}\(\)<>?,\+~;\'|":\$%\^&\*]{7,15}$/';

	$validno = true;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$validno = false; 
	}
	if(!preg_match($reLozinka,$sifra)){
		$validno = false;
	}
	if($validno){
		$upit=logovanje(); 
		$priprema = $konekcija->prepare($upit);
		$priprema->bindParam(":email", $email);
		$priprema->bindParam(":sifra", $siframd5);
		$rezultat = $priprema->execute();
		$korisnik=$priprema->fetch();

		if($rezultat){
			if($priprema->rowCount()==1){
				if($korisnik->verifikovan == 1 && $korisnik->blokiran == 0) {
					$date = date("Y-m-d H:i:s", time());
					updateVremeLogogvanja($date, $korisnik->id);
					$_SESSION['korisnik']=$korisnik;
					http_response_code(200);
				} else {
					http_response_code(403);
				}
			} else {
				
				http_response_code(404);
			}
		}
	} else {
		http_response_code(400);
	}
	$provera = proveriNeuspesnePokusaje($email, $konekcija);
    if (!$provera) {
        http_response_code(401);
    }
}
?>