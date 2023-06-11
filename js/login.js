window.onload = function () {
  document
    .getElementById("registracija")
    .addEventListener("click", proveraRegistracija);
  document.getElementById("btnLogin").addEventListener("click", proveraLogin);
};
var reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var reLozinka = /^[a-zA-Z0-9!\.@#_\-\[\]\{\}\(\)<>?,+~;'|":$%^&*]{7,15}$/;

function proveraLogin(e) {
  e.preventDefault();
  var emailLogin = document.getElementById("tbLoginEmail");
  var lozinkaLogin = document.getElementById("tbLoginPass");

  var validan = true;

  if (!reEmail.test(emailLogin.value)) {
    emailLogin.style.border = "3px solid red";
    validan = false;
  } else {
    emailLogin.style.border = "3px solid green";
  }
  if (!reLozinka.test(lozinkaLogin.value)) {
    lozinkaLogin.style.border = "3px solid red";
    validan = false;
  } else {
    lozinkaLogin.style.border = "3px solid green";
  }
  if (validan) {
    $.ajax({
      url: "models/logovanje.php",
      method: "POST",
      data: {
        email: emailLogin.value,
        lozinka: lozinkaLogin.value,
        send: true,
      },
      success: function (data, xhr, status) {
        if (status.status === 200) {
          alertify
            .alert("Succsessfully log in!", function () {
              window.location.href = "index.php?page=home";
            })
            .set({ title: "Success" });
        }
      },
      error: function (xhr, status, error) {
        console.log(error.status);
        switch (xhr.status) {
          case 400:
            alertify
              .alert("Your email or password is not valid.")
              .set({ title: "Validation Exception" });
            break;
          case 401:
            alertify
              .alert("Your account has been blocked. Please contact the administrator for assistance.")
              .set({ title: "Blocked account Exception" });
            break;
          case 403:
            alertify
              .alert("The user account is not verified.")
              .set({ title: "Verification Exception" });
            break;
          case 404:
            alertify
              .alert("There is no user with specified email/password.")
              .set({ title: "User not found Exception" });
            break;
          case 500:
            alertify
              .alert("Something went wrong, try again!")
              .set({ title: "Server Exception" });
            break;
        }
      },
    });
  } else {
    e.preventDefault();
  }
}

function proveraRegistracija(e) {
  e.preventDefault();
  var nameRegistracija = document.getElementById("tbIme");
  var prezimeRegistracija = document.getElementById("tbPrezime");
  var mailRegistracija = document.getElementById("tbFormaMail");
  var lozinkaRegistracija = document.getElementById("tbFormaLozinka");

  var reName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{1,11}$/;
  var rePrezime = /^[A-ZŽĆČŠĐ][a-zđžćčš]{1,19}(\s[A-ZŽĆČŠĐ][a-zđžćčš]{1,19})*$/;
  var validan = true;

  if (!reName.test(nameRegistracija.value)) {
    nameRegistracija.style.border = "3px solid red";
    document.getElementById("greskaName").style.visibility = "visible";
    validan = false;
  } else {
    nameRegistracija.style.border = "3px solid green";
    document.getElementById("greskaName").style.visibility = "hidden";
  }

  if (!rePrezime.test(prezimeRegistracija.value)) {
    prezimeRegistracija.style.border = "3px solid red";
    document.getElementById("greskaPrezime").style.visibility = "visible";
    validan = false;
  } else {
    prezimeRegistracija.style.border = "3px solid green";
    document.getElementById("greskaPrezime").style.visibility = "hidden";
  }

  if (!reEmail.test(mailRegistracija.value)) {
    mailRegistracija.style.border = "3px solid red";
    document.getElementById("greskaMail").style.visibility = "visible";
    validan = false;
  } else {
    mailRegistracija.style.border = "3px solid green";
    document.getElementById("greskaMail").style.visibility = "hidden";
  }
  if (!reLozinka.test(lozinkaRegistracija.value)) {
    lozinkaRegistracija.style.border = "3px solid red";
    document.getElementById("greskaSifra").style.visibility = "visible";
    validan = false;
  } else {
    lozinkaRegistracija.style.border = "3px solid green";
    document.getElementById("greskaSifra").style.visibility = "hidden";
  }
  if (validan) {
    let divSuccess = document.querySelector("#successRegister");
    divSuccess.setAttribute("class", "alert alert-success mt-4");
    divSuccess.innerHTML = `Thanks ${nameRegistracija.value}, we are checking your data, if everything is ok the verification email will be sent!`;
    $.ajax({
      url: "models/registracija.php",
      method: "post",
      data: {
        ime: nameRegistracija.value,
        prezime: prezimeRegistracija.value,
        email: mailRegistracija.value,
        sifra: lozinkaRegistracija.value,
        send: true,
      },
      success: function (xhr, status) {
        console.log(xhr);
        if (status === "success") {
          alertify
            .alert("Verification Email Sent!", function () {
              window.location.href = "index.php";
            })
            .set({ title: "Success" });
        }
      },
      error: function (error, xhr, status) {
        console.log(error.status);
        switch (error.status) {
          case 400:
            alertify
              .alert("Your data is not valid.")
              .set({ title: "Validation Exception" });
            break;
          case 409:
            alertify
              .alert("Email already exists.")
              .set({ title: "Conflict Exception" });
            break;
          case 500:
            alertify
              .alert("Something went wrong, try again!")
              .set({ title: "Server Exception" });
            break;
        }
      },
    });
  }
}
