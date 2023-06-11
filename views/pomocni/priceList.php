<?php
include_once "setup/konekcija.php";
$upit = "SELECT * FROM price_plan";
$rezultat = $konekcija->query($upit);
foreach ($rezultat as $rez) {
    echo "
            <div class='col-lg-4'>
                <div class='bg-light text-center pt-5 mt-lg-5'>
                    <h2 class='text-uppercase'>$rez->title</h2>
                    <h6 class='text-body mb-5'>$rez->subtitle</h6>
                    <div class='text-center bg-primary p-4 mb-2'>
                        <h1 class='display-4 text-white mb-0'>
                            <small class='align-top'
                                style='font-size: 22px; line-height: 45px;'>$</small>$rez->price<small
                                class='align-bottom' style='font-size: 16px; line-height: 40px;'>/
                                Mo</small>
                        </h1>
                    </div>
                    <div class='text-center p-4'>";
    
        $upitS = "SELECT s.title FROM service as s INNER JOIN service_price as sp on s.id = sp.id_service INNER JOIN price_plan as p ON sp.id_plan=p.id WHERE p.id=$rez->id";
        $rezultatS = $konekcija->query($upitS);
        foreach ($rezultatS as $rezS) {
            echo "<div class='d-flex align-items-center justify-content-between mb-1'>
                        <span>$rezS->title</span><i class='bi bi-check2 fs-4 text-primary'></i>
                </div>";
        }
    echo "</div>
        </div>
        </div>";
};
