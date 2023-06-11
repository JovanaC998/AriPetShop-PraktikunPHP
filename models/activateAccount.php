<?php
include_once "../setup/konekcija.php";

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "update korisnik set verifikovan='1' where token=:token";
    $priprema=$konekcija->prepare($query);
    $priprema->bindParam(":token", $token);
    $rezultat = $priprema->execute();
    if($rezultat){
        echo"<p>Account Activated!</p>
        <a href='https://aripetshop.000webhostapp.com/index.php?page=login'
		   style='text-decoration: none; padding: 10px 20px; background-color: #006FD1; color: white; border-radius: 5px;'>Go back to log in.</a>";
        exit();
    }
}

?>