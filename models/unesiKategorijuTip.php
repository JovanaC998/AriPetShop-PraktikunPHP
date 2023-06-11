<?php
session_start();
require_once "../setup/konekcija.php";
require_once "functions.php";


if (isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->id_uloga == 2) {
    if (isset($_POST["unesiKategoriju"])) {
        $naziv    = $_POST["nazivKategorija"];
        $tabela = "kategorija";
        $poruka = "Category";
    }
    else if(isset($_POST["unesiTip"])) {
        $naziv    = $_POST["nazivTip"];
        $tabela = "tip";
        $poruka = "Type";
    }

        $reNaziv = "/^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$/";
        $validno = true;
        if(!preg_match($reNaziv,$naziv)){
            $validno = false;
        }
        if($validno){
            unesiKategorijuTip($tabela,$naziv);
            header('Location: ../index.php?page=admin');
            $_SESSION['alert_message'] = "Successfully Added $poruka.";
        }
        else{
            header('Location: ../index.php?page=admin');
            $_SESSION['alert_message'] = 'Name Of Category is not valid.';

            exit;
        }
    }

?>