<?php
include_once "setup/konekcija.php";

$upit = "SELECT * FROM service";
$rezultat = $konekcija->query($upit);

    foreach($rezultat as $rez){
         echo "<div class='col-md-6'>
         <div class='service-item bg-light d-flex p-4'>
             <i class='flaticon-$rez->icon display-1 text-primary me-4'></i>
             <div>
                   <h5 class='text-uppercase mb-3'>$rez->title</h5>
                   <p>$rez->text</p>
               </div>
       </div>
    </div>";
    };
                       