<?php
session_start();
require_once "../setup/konekcija.php";
require_once "functions.php";

if(isset($_SESSION["korisnik"]) AND $_SESSION["korisnik"]->id_uloga == 2 ){
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        izbrisiTip($id);
        
        header('Location: ../index.php?page=admin');
        $_SESSION['alert_message'] = 'Successfully Deleted Type.';
    }
}
else{
    header("Location: ../index.php");
}