<?php
if(isset($_SESSION["korisnik"])){
	header("location: index.php");
}
include_once "../setup/konekcija.php";
include_once "functions.php";
global $konekcija;
function isUnique($email){
	
	global $konekcija;
    $query = "select * from korisnik where email=:email";
	$priprema=$konekcija->prepare($query);
    $priprema->bindParam(":email", $email);
    $rezultat = $priprema->execute();
    
    if($priprema->rowCount() > 0){
        return false;
    }
    else return true;
    
}

if(isset($_POST["send"])) {
	$ime = $_POST["ime"];
	$prezime = $_POST["prezime"];
	$email = $_POST["email"];
	$sifra = $_POST["sifra"];

	$token = bin2hex(openssl_random_pseudo_bytes(32));
	$vremeReg = date("Y-m-d H:i:s", time());
	$siframd5 = md5($sifra);

	$reIme =  "/^[A-ZŠĐČĆŽ][a-zšđčćž]{1,11}$/u";
	$rePrezime =  "/^[A-ZŽĆČŠĐ][a-zđžćčš]{1,19}(\s[A-ZŽĆČŠĐ][a-zđžćčš]{1,19})*$/u";
	$reLozinka = '/^[a-zA-Z0-9!\.@#_\-\[\]\{\}\(\)<>?,\+~;\'|":\$%\^&\*]{7,15}$/';
	$reEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
	$validno = true;

	
	if(!preg_match($reIme, $ime)){
		$validno = false;
	}
	if(!preg_match($rePrezime, $prezime)){
		$validno = false;
	}
	if(!preg_match($reEmail, $email)){
		$validno = false; 
	}

	if(!isUnique($email)) {
		http_response_code(409);
		exit();
	}

	if(!preg_match($reLozinka,$sifra)){
		$validno = false;
	}

	if($validno){
		registracija($ime, $prezime, $email, $siframd5, $vremeReg, $token);		

		$subject = "Confirm Mail";
		$message = "<div style='font-family:Helvetica,Arial,sans-serif;font-size:large;max-width: 560px;width: 100%;margin: 20px ;'>
		<h1>Confirm your email</h1>
		<p>Hi, $ime</p>
		<p>Thank you for registering. Please click on the link below to activate your account:</p>
		<br>
		<a href='https://aripetshop.000webhostapp.com/models/activateAccount.php?token=$token'
		   style='text-decoration: none; padding: 10px 20px; background-color: #006FD1; color: white; border-radius: 5px;'>Activate
			Now</a>
		<br>
		</div>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <jovanaciric701@gmail.com>' . "\r\n";
		ini_set("SMTP", "ssl://smtp.gmail.com");
		ini_set("smtp_port", "465");

		mail($email,$subject,$message,$headers);

		http_response_code(200);
	} else{
		http_response_code(400);
	}
}
?>