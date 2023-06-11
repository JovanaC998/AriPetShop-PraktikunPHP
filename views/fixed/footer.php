<?php
include_once "setup/konekcija.php";
$upit = "SELECT * FROM informacija";
$rezultat = $konekcija->query($upit);

$upitM = "SELECT * FROM meni";
$rezultatM = $konekcija->query($upitM);

echo "<div class='container-fluid bg-light mt-5 py-5'>
        <div class='container pt-5'><div class='row g-5'>
        <div class='col-lg-3 col-md-6'>
        <h5 class='text-uppercase border-start border-5 border-primary ps-3 mb-4'>Get In Touch</h5>
        <p class='mb-2'><i class='bi bi-geo-alt text-primary me-2'></i>123 Street, New York, USA</p>
        <p class='mb-2'><i class='bi bi-envelope-open text-primary me-2'></i>infopetshop@gmail.com</p>
        <p class='mb-0'><i class='bi bi-telephone text-primary me-2'></i>+012 345 67890</p>
        </div>
        <div class='col-lg-3 col-md-6'>
        <h5 class='text-uppercase border-start border-5 border-primary ps-3 mb-4'>Quick Links</h5>
        <div class='d-flex flex-column justify-content-start' id='footer'>";
        foreach($rezultatM as $re){
            echo "<a href='index.php?page=$re->href' class='nav-item nav-link listMenu'>$re->naziv</a>";
        }
        echo"</div>
        </div>
        <div class='col-lg-3 col-md-6'>
        <h5 class='text-uppercase border-start border-5 border-primary ps-3 mb-4'>Newsletter</h5>
        <form>
            <div class='input-group'>
                <input type='email' id='mailNL' class='form-control bg-light px-4' placeholder='Your email' style='height: 55px;'/>
                <p class='show-validated'></p>
                <input type='button' class='btn btn-primary' id='btnMailNL' value='Sing Up'/>
            </div>
        </form>
        </div>
        <div class='col-lg-3 col-md-6'>
        <h5 class='text-uppercase border-start border-5 border-primary ps-3 mb-4'>Follow us</h5>
        <div class='d-flex' id='information'>";
        foreach($rezultat as $rez){
            echo "<a class='btn btn-outline-primary btn-square me-2' target='_blank' href='$rez->putanja'><i class='bi bi-$rez->naziv'></i></a>";
        };
        echo"</div>
        </div>
    </div></div>
    </div>
    <div class='container-fluid bg-dark text-white-50 py-4'>
       <div class='container'>
          <div class='row g-5'>
             <div class='col-md-6 text-center text-md-start'>
                <p class='mb-md-0'>&copy; <a class='text-white' href='#'>Jovana Ciric</a>. All Rights Reserved.</p>
             </div>
          </div>
       </div>
    </div>
    ";
                       