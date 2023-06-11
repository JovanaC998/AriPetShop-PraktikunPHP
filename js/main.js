(function ($) {
  "use strict";
  var currentPage = window.location.href.split("=").pop();
  var page = window.location.href.split("=")[1];

  $(document).ready(function () {
    console.log(page);
    console.log(currentPage);

    function toggleNavbarMethod() {
      if ($(window).width() > 992) {
        $(".navbar .dropdown")
          .on("mouseover", function () {
            $(".dropdown-toggle", this).trigger("click");
          })
          .on("mouseout", function () {
            $(".dropdown-toggle", this).trigger("click").blur();
            var myDiv = document.getElementById("#menu");
          });
      } else {
        $(".navbar .dropdown").off("mouseover").off("mouseout");
      }
    }
    toggleNavbarMethod();
    $(window).resize(toggleNavbarMethod);

    // News Letter Validation
    document
      .getElementById("btnMailNL")
      .addEventListener("click", checkNewLetterEmail);

    function checkNewLetterEmail() {
      let email = document.getElementById("mailNL");
      var reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      console.log(email.value);
      if (!reEmail.test(email.value)) {
        email.style.border = "1px solid red";
      } else {
        email.style.border = "1px solid green";
      }
    }

    if (currentPage == "product") {
      console.log("uso");
      $(owlContainer).owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 45,
        dots: false,
        loop: true,
        nav: true,
        navText: [
          '<i class="bi bi-arrow-left"></i>',
          '<i class="bi bi-arrow-right"></i>',
        ],
        responsive: {
          0: {
            items: 1,
          },
          768: {
            items: 2,
          },
          992: {
            items: 3,
          },
          1200: {
            items: 4,
          },
        },
      });
    }

    if (page == "details&id") {
      document.getElementById("korpa").addEventListener("click", dodajUKorpu);

      function dodajUKorpu() {
        var proizvod_id = document.getElementById("proizvod_id").value;
        var kolicina = document.getElementById("kolicina").value;
        let url = "models/korpa.php";
        $.ajax({
          url: url,
          method: "POST",
          data: {
            proizvod_id: proizvod_id,
            kolicina: kolicina,
            send: true,
          },
          success: function () {
            alertify
              .alert("Product successfully added to cart..", function () {
                window.location.href = "index.php?page=product";
              })
              .set({ title: "Success" });
          },
          error: function (xhr, status, error) {
            console.log(xhr, status, error);
          },
        });
      }
    }
    if (currentPage == "cart") {
      document.getElementById("order").addEventListener("click", order);

      function order() {
        let url = "models/order.php";
        $.ajax({
          url: url,
          method: "POST",
          success: function () {
            alertify
              .alert(
                "Thank you for your order. We'll contact you with any updates.",
                function () {
                  window.location.href = "index.php?page=cart";
                }
              )
              .set({ title: "Success" });
          },
          error: function (xhr, textStatus, errorThrown) {

            switch (xhr.status) {
              case 400:
                alertify
                  .alert("Your cart is empty.")
                  .set({ title: "Empty Cart Exception" });
                break;
            }
          },
        });
      }
    }
  });

  // Sticky Navbar
  $(window).scroll(function () {
    if ($(this).scrollTop() > 40) {
      $(".navbar").addClass("sticky-top");
    } else {
      $(".navbar").removeClass("sticky-top");
    }
  });

  // Modal Video
  $(document).ready(function () {
    var $videoSrc;
    $(".btn-play").click(function () {
      $videoSrc = $(this).data("src");
    });

    $("#videoModal").on("shown.bs.modal", function (e) {
      $("#video").attr(
        "src",
        $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
      );
    });

    $("#videoModal").on("hide.bs.modal", function (e) {
      $("#video").attr("src", $videoSrc);
    });
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1500,
      "easeInOutExpo"
    );
    return false;
  });
})(jQuery);
