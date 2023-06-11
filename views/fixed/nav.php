<?php
require_once "setup/konekcija.php";
echo "<nav class='navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0 mb-5'>
<a href='index.php' class='navbar-brand'>
   <h1 class='m-0 text-uppercase text-dark'><i class='bi bi-shop fs-1 text-primary me-3'></i>Pet Shop Ari</h1>
</a>
<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarCollapse'>
<span class='navbar-toggler-icon'></span>
</button>
<div class='collapse navbar-collapse' id='navbarCollapse'>
   <div class='navbar-nav ms-auto py-0'>
	  <div id='menu'>";
$upit = "SELECT * FROM meni";
$rezultat = $konekcija->query($upit);
foreach($rezultat as $re){
    echo "<a href='index.php?page=$re->href'  class='nav-item nav-link listMenu'>$re->naziv</a>";
}
if(isset($_SESSION['korisnik'])){	
	if($_SESSION['korisnik']->id_uloga == 2){
		echo "<a href='index.php?page=admin' class='nav-item nav-link listMenu'>Admin Panel</a>";
	}
   if($_SESSION['korisnik']->id_uloga == 1){
      echo "<a href='index.php?page=cart'  class='nav-item nav-link listMenu'>Cart</a>";
   }
	echo "<a href='models/logout.php'  class='nav-item nav-link listMenu'>Log out</a>";
}else{
	echo "<a href='index.php?page=login'  class='nav-item nav-link listMenu'>Log in | Registration</a>";	
}
echo "</div>
<div class='nav-item dropdown'>
   <a class='nav-link dropdown-toggle listMenu' data-bs-toggle='dropdown'>Pages</a>
   <div class='dropdown-menu m-0' id='pages'>"; include "views/fixed/pages.php";
   echo "</div>
   </div>
   <a href='index.php?page=contact' class='nav-item nav-link nav-contact bg-primary text-white px-5 listMenu'>Contact <i class='bi bi-arrow-right'></i></a>
   </div>
   </div>
   </nav>"
?>

                 