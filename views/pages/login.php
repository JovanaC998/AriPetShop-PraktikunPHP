<?php
   if(isset($_SESSION["korisnik"])){
    echo "<h4 class='text-body m-4'>You are alredy logged in.</h4>";
  } else {
   ?>
   <body>
    <!-- about Start -->
    <div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-6">
            <div class="contact_info">
                <h3 class="m-0 text-uppercase text-dark">Log In</h3>
            </div>
            <div>
                <form action="#" method="POST" class="contact-form">
                <div class="col-lg-12 col-12 formDesigneTitle">
                    <label class="form-label">E-mail<sup class="text-danger">*</sup></label>
                    <input type="text" value="" id="tbLoginEmail" name="tbLoginEmail" style="height: 55px;" class="form-control bg-light px-4" placeholder="Enter Your E-mail.." />
                </div>
                <div class="col-lg-12 col-12 formDesigneTitle">
                    <label class="form-label">Password<sup class="text-danger">*</sup>
                    </label>
                    <input type="password" value="" id="tbLoginPass" name="tbLoginPass" style="height: 55px;" class="form-control bg-light px-4" placeholder="Enter Your Password.." />
                </div>
                <div id="center" class="col-lg-6 col-6">
                    <input type="submit" value="Log in" id="btnLogin" name="btnLogin" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-form">
            <h3 class="m-0 text-uppercase text-dark">Register</h3>
            <form action="#" method="post" class="contact-form">
              <div>
                  <label class="form-label">First Name<sup class="text-danger">*</sup></label>
                  <input type="text" value="" id="tbIme" name="tbIme" style="height: 55px;" class="form-control bg-light px-4" placeholder="Enter Your First Name..">
                <label id="greskaName">Example : John</label>
              </div>
              <div>
                  <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                  <input type="text" value="" id="tbPrezime" name="tbPrezime" style="height: 55px;" class="form-control bg-light px-4" placeholder="Enter Your Last Name..">
                <label id="greskaPrezime">Example : Doe</label>
              </div>
              <div>
                  <label class="form-label">E-mail<sup class="text-danger">*</sup></label>
                  <input type="text" value="" id="tbFormaMail" name="tbFormaMail" style="height: 55px;" class="form-control bg-light px-4" placeholder="Enter Your Email..">
                <label id="greskaMail">Example : example@gmail.com</label>
              </div>
              <div>
                  <label class="form-label">Password<sup class="text-danger">*</sup></label>
                  <input type="password" value="" id="tbFormaLozinka" name="tbFormaLozinka" style="height: 55px;" class="form-control bg-light px-4" placeholder="Enter Your Password..">
                <label id="greskaSifra">Password must contain atleast one upper and lower letter, nubmer, special character and minimum length of 7</label>
                <div>
                    <input type="submit" value="Register" id="registracija" name="registracija" class="btn btn-primary">
                </div>
               </div>
            </form>
            <p id="successRegister"></p>
          </div>
        </div>
      </div>
    </div>

      <!-- about End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-primary py-3 fs-4 back-to-top">
        <i class="bi bi-arrow-up"></i>
      </a>
  
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
      <!-- Template Javascript -->
      <script src="js/main.js"></script>
      <script src="js/login.js" type="text/javascript"></script>

  </body>
</html>
<?php
}
?>