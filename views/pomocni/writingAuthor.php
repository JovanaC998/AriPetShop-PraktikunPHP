<?php
include_once "setup/konekcija.php";

$upit = "SELECT * FROM autor";
$rezultat = $konekcija->query($upit)->fetch();

         echo "<div class='col-lg-6 col-md-12' id='authorImg'>
         <img src='$rezultat->slika' alt='Author' />
      </div>
      <div class='col-lg-4 col-md-12' id='authorText' data-aos='fade-up'>
         <h4>$rezultat->ime_prezime</h4>
         <h4>Index: $rezultat->indeks</h4>
         <h4>Check out my <a href='$rezultat->href' target='_blank'>Portfolio</a></h4>
      </div>";
?>