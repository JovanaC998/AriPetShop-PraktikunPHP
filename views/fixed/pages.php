<?php

$upit = "SELECT * FROM pages";
$rezultat = $konekcija->query($upit);
foreach($rezultat as $re){
    echo "<a href='index.php?page=$re->href' class='dropdown-item'>$re->naziv</a>";
}
?>