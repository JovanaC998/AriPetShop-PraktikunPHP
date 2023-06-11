
<body>
      <div class="py-5">
         <div class="">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
               <h6 class="text-primary text-uppercase">Products</h6>
               <h1 class="display-5 text-uppercase mb-0">Special prices</h1>
            </div>
            <div class="owl-carousel product-carousel" id="owlContainer"> 
               <?php
                  include "views/pomocni/specialProducts.php"
               ?>
            </div>
         </div>
      </div>
      <!-- Products End -->
      <!-- All Product Start -->
      <div>
         <div id="products">
            <div class="border-start border-5 border-primary ps-5 mb-5">
               <h6 class="text-primary text-uppercase">Products</h6>
               <h1 class="display-5 text-uppercase mb-0">All Products</h1>
            </div>
            <div  id="sort">
               <select name="selectedProduct" id="selectedProduct">
                  <option value="">Sort</option>
                  <option value="1">Price:Low To Hight</option>
                  <option value="2">Price:Hight To Low</option>
                  <option value="3">Name: A-Z</option>
                  <option value="4">Namw: Z-A</option>
               </select>
            </div>
            <div id="categoriesFlex">
               <div>
                  <div class="mb-5 ">
                     <div class="input-field">
                        <h6 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Search</h6>
                        <input type="text" id="search" placeholder="e.g. Cat Snack">
                     </div>
                  </div>
                  <div id="categories"  class="mb-5">
                     <h6 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Filter By Categories</h6>
                     <?php
                        include "views/pomocni/categories.php";
                     ?>
                  </div>
                  <button id="reset" class="btn">Clear All Filters</button>
               </div>
               <div id="allProducts">
               <?php
               ?>
               </div>
            </div>
         </div>
      </div>
      <div id="paginacija">
      </div>
      <!-- All Product End -->
      
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



      <!-- Template Javascript -->
      <script src="js/main.js"></script>
      <script src="js/product.js"></script>
   </body>
</html>`