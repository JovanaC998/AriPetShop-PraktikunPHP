<?php
include_once "setup/konekcija.php";

$upit = "SELECT * FROM proizvodi WHERE prethodna_cena IS NOT NULL";
$rezultat = $konekcija->query($upit);

    foreach($rezultat as $rez){
             echo "
    <div class='pb-5 ' data-id='$rez->id'>
        <div class='product-item position-relative bg-light d-flex flex-column text-center'>
             <img class='img-fluid mb-4' src='$rez->slika'>
             <h6 class='text-uppercase'>Pet Food $rez->naziv</h6>
             <h5 class='text-primary mb-0'><s>$$rez->prethodna_cena</s></h5>
             <h5 class='text-primary mb-0'>$rez->cena</h5>
            <div class='btn-action d-flex justify-content-center'>
                 <a class='btn btn-primary py-2 px-3' href='index.php?page=details&id=$rez->id'>Show More</a>
            </div>
        </div>
    </div>";
    };                       