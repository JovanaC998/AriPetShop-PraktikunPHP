<?php
require_once "../setup/konekcija.php";
require_once "functions.php";

header("Location: ../index.php?page=contact");
    if(isset($_POST['btnAnketa'])){
        $answer=$_POST['answer'];
        $idKorisnika=$_POST['idK'];
        echo $answer;
        echo $idKorisnika;
        if($answer==""){
        header("Location: ../index.php?page=contact");
        }

    $upit=upisiOdgovorAnkete();
    $stmt=$konekcija->prepare($upit);
    $stmt->bindParam(":idK",$idKorisnika);
    $stmt->bindParam(":idO",$answer);
    $stmt->execute();
    if($stmt->rowCount()){
        echo "Uspesan unos";
    }
}
?>