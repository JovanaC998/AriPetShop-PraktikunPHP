<?php
include_once "setup/konekcija.php";

$upit = "SELECT * FROM kategorija";
$rezultat = $konekcija->query($upit);
echo "<ul>";
    foreach($rezultat as $rez){
         echo "<li class = 'cat'>
         <input type='radio' name='categories' value='$rez->id'/>
         <label>
         <span>$rez->naziv</span>
         </label>
       </li>";
};
echo "</ul>";