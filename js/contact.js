var flag = true;

$(document).ready(function() {
    document.getElementById("btnSend").addEventListener("click", formValidate);
    document.getElementById("btnSend").addEventListener("click", function() {
        flag = true
    });
})
function formValidate() {
    var nameContact = document.getElementById("name");
    var email = document.getElementById("email");
    var phoneContact = document.getElementById("phone");
    var textArea = document.getElementById("message");
    var type = document.getElementById("ddlType");
    
    var reText = /^[A-ZŠĐČĆŽa-zšđčćž0-9\.,?!\s]{3,}$/;
    var reName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{1,11}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{1,11})+$/;
    var reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var rePhone = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

    var messageFullName = "You didn't enter Full Name correctly! Example: John Doe.";
    var messageEmail = "You didn't enter Email correctly! Example: john.doe@gmail.com";
    var messagePhone = "You didn't enter Phone correctly! Example: 0631234567";
    var messageText = "You didn't enter Message correctly! Example: Hello World!";
    var messageType = "You have to choose one of the pet!"


    checkRegex(reName, nameContact, messageFullName);
    checkRegex(reEmail, email, messageEmail);
    checkRegex(rePhone, phoneContact, messagePhone);
    checkRegex(reText, textArea, messageText);

    checkType(type, messageType);


    if (flag) {
        $.ajax({
            url:"models/sendMessage.php",
            method:"POST",
            data:{
                fullName:nameContact.value,
                email:email.value,
                phone:phoneContact.value,
                textArea:textArea.value,
                type:type.value,
                send:true
            },
            success: function(xhr,status){
                if (status === "success") {
                    let divSuccess = document.querySelector("#success");
                    divSuccess.setAttribute("class", "alert alert-success mt-4");
                    divSuccess.innerHTML = `Thanks ${nameContact.value}, we will reach You as soon as possible!`;
                    document.getElementById("form").reset();
                }
            },
            error: function(error, xhr, status){
                switch(error.status) {
                    case 400 :
                    alertify.alert("Your data is not valid.").set({title:"Validation Exception"});
                    break;
                    case 401 :
                    alertify.alert("You need to be Logged In First.").set({title:"Authentication Exception"});
                    break;
                    case 500 : 
                    alertify.alert("Something went wrong, try again!").set({title:"Server Exception"});
                    break
                }
            }

        })
    }
}
function serviceChecks(checkedElements, array, message) {
    if (checkedElements == "") {
        array[array.length - 1].parentElement.nextElementSibling.classList.remove("hide");
        array[array.length - 1].parentElement.nextElementSibling.innerHTML = message;
        flag=false;
    } else {
        array[array.length - 1].parentElement.nextElementSibling.classList.add("hide");
    }
}

function checkRegex(regex, object, message) {
    if (!regex.test(object.value)) {
        object.nextElementSibling.classList.remove("hide");
        object.nextElementSibling.innerHTML = message;
        flag = false;
    } else {
        object.nextElementSibling.classList.add("hide");
    }
}

function checkType(object, message) {
    if (object.value == 0) {
        object.nextElementSibling.classList.remove("hide");
        object.nextElementSibling.innerHTML = message;
        flag = false;
    } else {
        object.nextElementSibling.classList.add("hide");
    }
}
