<?php
include_once "setup/konekcija.php";

$upit = "SELECT * FROM tip";
$rezultat = $konekcija->query($upit);
echo "<ul>";
    foreach($rezultat as $rez){
         echo "<li class = 'cat'>
         <input type='checkbox' name='types' value='$rez->id'/>
         <label>
         <span>$rez->naziv</span>
         </label>
       </li>";
};
echo "</ul>";