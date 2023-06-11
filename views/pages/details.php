<?php
    if(isset($_SESSION["korisnik"])){
echo"<body>
      <!-- Navbar End -->
      <!-- about Start -->
      <div class='container py-5'>
         <div class='row authorSection'>";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $upit="SELECT * from proizvodi where id=$id";
                    $rezultat = $konekcija->query($upit);
                    $rez = $rezultat->fetch();
    
                    echo "
                    
                    <div class='container-fluid py-5'>
         <div class='container'>
            <div class='row gx-5'>
               <div class='col-lg-5 mb-5 mb-lg-0' style='min-height: 500px;'>
                  <div class='position-relative h-100'>
                     <img class='position-absolute w-100 h-100 rounded' src='$rez->slika' style='object-fit: cover;' alt='$rez->alt'>
                  </div>
               </div>
               <div class='col-lg-7'>
                  <div class='border-start border-5 border-primary ps-5 mb-5'>
                    <h6 class='text-primary text-uppercase'>More Details About Product</h6>
                    <h1 class='display-5 text-uppercase mb-0'>About Product</h1>
                  </div>
                  <h3 class='text-body mb-4'>$rez->naziv</h3>
                  <h4 class='text-body mb-4'>Price: $$rez->cena</h4>
                  <form action='#' method='POST'>
                     <input type='hidden' name='proizvod_id' id='proizvod_id' value='$rez->id'>
                     <input type='number' class='mb-2' style='width:15%;border-radius: 0px;' name='kolicina' id='kolicina' value='1' min='1'>
                     <input type='button' class='btn btn-primary' id='korpa' value='Add to cart' name='dodaj_u_korpu'>
                  </form>
                  <div class='bg-light p-4'>
                     <div class='tab-content' id='pills-tabContent'>
                        <div class='tab-pane fade show active' id='pills-1' role='tabpanel' aria-labelledby='pills-1-tab'>
                           <p class='mb-0'>$rez->opis</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>";
}}
else{
   echo "<h4 class='text-body m-4'>To access the page, you need to<a href='index.php?page=login'> log in.</a></h4>";
}
?>
         </div>
      </div>
      <!-- about End -->
      
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
      <!-- Template Javascript -->
      <script src="js/main.js"></script>
   </body>
</html>