
   <body>
      <div class="container-fluid pt-5">
         <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
               <h6 class="text-primary text-uppercase">Contact Us</h6>
               <h1 class="display-5 text-uppercase mb-0">Please Feel Free To Contact Us</h1>
            </div>
            <div class="row g-5">
               <div class="col-lg-7">
                  <form action="#" method="post" class="contact-form" id="form" role="form" data-aos="fade-up">
                     <div class="row">
                        <div class="col-lg-12 col-12 formDesigneTitle">
                           <label class="form-label">Full Name <sup class="text-danger">*</sup></label>
                           <input type="text" name="name" id="name"  class="form-control bg-light border-0 px-4" placeholder="Your Name" style="height: 55px;" required />
                           <p class="show-validated"></p>
                        </div>
                        <div class="col-lg-6 col-6 formDesigneTitle">
                           <label class="form-label">Email <sup class="text-danger">*</sup></label>
                           <input type="email" name="email" id="email" class="form-control bg-light border-0 px-4" placeholder="Your mail" style="height: 55px;" required />
                           <p class="show-validated"></p>
                        </div>
                        <div class="col-lg-6 col-6 formDesigneTitle">
                           <label class="form-label">Mobile Phone<sup class="text-danger">*</sup></label>
                           <input type="text" name="phone" id="phone"  class="form-control bg-light border-0 px-4" placeholder="Your Mobile Phone" style="height: 55px;" required />
                           <p class="show-validated"></p>
                        </div>
                        <div class="col-12 my-4 formDesigneTitle">
                           <label class="form-label">How can we help?</label>
                           <textarea name="message" rows="2" id="message" class="form-control bg-light border-0 px-4 py-3" placeholder="Message" required></textarea>
                           <p class="show-validated"></p>
                        </div>
                        <div class="col-lg-12 col-12 formDesigneTitle">
                           <label class="form-label">What type of pet do you have?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-lg-12 col-12 formDesigneTitle" id="ddlTypeStyle">
                        <select id="ddlType">
                        <option value="0">Choose..</option>
                        <?php
                           $upit = "SELECT * FROM tip";
                           $rezultat = $konekcija->query($upit);
                           foreach($rezultat as $rez){
                              echo"<option value='$rez->id'>$rez->naziv</option>";
                           }
                        ?>
                        </select>
                        <p class="show-validated"></p>
                        </div>
                     </div>
                     <div class="col-lg-5 col-12 mx-auto mt-5">
                        <input type="button" id="btnSend"  class="btn btn-primary w-100 py-3" value="Send Message" />
                     </div>
                  </form>
                  <p id="success"></p>
               </div>
               <?php
                  if(isset($_SESSION["korisnik"])){
                     include "views/pomocni/survey.php";
                  } else{
                     echo "<div class='col-lg-5' >
                     <div class='bg-light mb-5 p-5'>
                        <div class='d-flex align-items-center mb-2'>
                           <i class='bi bi-geo-alt fs-1 text-primary me-3'></i>
                           <div class='text-start'>
                              <h6 class='text-uppercase mb-1'>Our Office</h6>
                              <span>123 Street, New York, USA</span>
                           </div>
                        </div>
                        <div class='d-flex align-items-center mb-2'>
                           <i class='bi bi-envelope-open fs-1 text-primary me-3'></i>
                           <div class='text-start'>
                              <h6 class='text-uppercase mb-1'>Email Us</h6>
                              <span>infopetshop@gmail.com</span>
                           </div>
                        </div>
                        <div class='d-flex align-items-center mb-4'>
                           <i class='bi bi-phone-vibrate fs-1 text-primary me-3'></i>
                           <div class='text-start'>
                              <h6 class='text-uppercase mb-1'>Call Us</h6>
                              <span>+012 345 6789</span>
                           </div>
                        </div>
                        <div>
                           <iframe class='position-relative w-100'
                              src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd'
                              frameborder='0' style='height: 205px; border:0;' allowfullscreen='' aria-hidden='false'
                              tabindex='0'></iframe>
                        </div><br/>
                        <div class='text-start'>
                           <h6 class='text-uppercase mb-1'><a href='index.php?page=login'>Log In</a> to take a survey.</h6>
                        </div>
                     </div>
                  </div>";
                  }
               ?>
               
            </div>
         </div>
      </div>
      <!-- Contact End -->
     
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
      <script src="js/contact.js"></script>
   </body>
</html>