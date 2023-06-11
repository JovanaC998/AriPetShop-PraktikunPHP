
<body>
      <!-- Navbar End -->
      <!-- Hero Start -->
      <div class="container-fluid bg-primary py-5 mb-5 hero-header">
         <div class="container py-5">
            <div class="row justify-content-start">
               <div class="col-lg-8 text-center text-lg-start">
                  <h1 class="display-1 text-uppercase text-dark mb-lg-4">Pet Shop Ari</h1>
                  <h1 class="text-uppercase text-white mb-lg-4">Make Your Pets Happy</h1>
                  <p class="fs-4 text-white mb-lg-4">Pure & natural holistic pet foods for a long and healthy life.</p>
                  <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                     <a href="#about" class="btn btn-outline-light border-2 py-md-3 px-md-5 me-5">Read More</a>
                     <button type="button" class="btn-play" data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                     <span></span>
                     </button>
                     <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Hero End -->
      <!-- Video Modal Start -->
      <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content rounded-0">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="ratio ratio-16x9">
                     <iframe width="560" height="315" src="https://www.youtube.com/embed/ncyqXudOyrc" 
                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Video Modal End -->
      <!-- About Start -->
      <div class="container-fluid py-5" id="about">
         <div class="container">
            <div class="row gx-5">
               <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                  <div class="position-relative h-100">
                     <img class="position-absolute w-100 h-100 rounded" src="img/about.jpg" style="object-fit: cover;">
                  </div>
               </div>
               <div class="col-lg-7">
                  <div class="border-start border-5 border-primary ps-5 mb-5">
                     <h6 class="text-primary text-uppercase">About Us</h6>
                     <h1 class="display-5 text-uppercase mb-0">We Keep Your Pets Happy All Time</h1>
                  </div>
                  <h4 class="text-body mb-4">"Dogs are not our whole life, but they make our lives whole."</h4>
                  <div class="bg-light p-4">
                     <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                           <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                              aria-selected="true">Our Mission</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                           <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                              aria-selected="false">Our Vission</button>
                        </li>
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                           <p class="mb-0">Our mission is to provide innovative, high-quality, consistent, value-for-money, pet friendly health care that will make your pet want to come back again…and again, to provide a range of products and services that help pet owners to care for their pets and to create a safe, happy, and healthy environment for animals.</p>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                           <p class="mb-0">Our vision for our pet shop is to create a community of passionate and knowledgeable pet owners who share our commitment to providing a safe, healthy, and happy environment for animals. We strive to be the go-to destination for all pet-related needs and to be recognized for our exceptional customer service and dedication to animal welfare.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- About End -->
      
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

      <!-- Template Javascript -->
      <script src="js/main.js"></script>
   </body>
</html>