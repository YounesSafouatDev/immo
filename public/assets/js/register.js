var form = document.querySelector(".up_form");
var fname = document.querySelector("#fname");
var lname = document.querySelector("#lname");
var password = document.getElementById('password');
var confirmP = document.getElementById('confirm_pass');
var phone = document.querySelector("#phone");
var checkbox = document.getElementById("accept");
var messagef = document.getElementById('message_first');
var messagel = document.getElementById('message_last');
var messagep = document.getElementById('message_phone');
var messagec = document.getElementById('message_confirm');
var messagea = document.getElementById('message_accept');
var regexChar = /^[A-Za-z]+$/;
var regexPhone = /^(06|07)\d{8}$/;

function checkInput(test){
    return test.match(regexChar);
}
function checkPhoneNumber(phoneNumber) {
    return phoneNumber.match(regexPhone);
}
function checkConfirm(confirPass){
    return confirPass == password.value ;
}
form.addEventListener('submit', (event)=>{
    var isFnameValid = checkInput(fname.value);
    var isLnameValid = checkInput(lname.value);
    var isPhoneNumberValid = checkPhoneNumber(phone.value);
    var isCheckConfirm = checkConfirm(confirmP.value);
    if (!isFnameValid) {
        event.preventDefault();
       messagef.innerHTML = "Seulement l'alphabet"
    }
    if (!isLnameValid) {
        event.preventDefault();
        messagel.innerHTML = "Seulement l'alphabet"
    }
    if (!isPhoneNumberValid) {
        event.preventDefault();
        messagep.innerHTML = 'min 10 Les nombres commencent par 06|07'
    }
    if(!isCheckConfirm){
        event.preventDefault();
        messagec.innerHTML = "Le mot de passe et la confirmation ne sont pas les mêmes"
    }
    if (!checkbox.checked) {
        event.preventDefault();
        messagea.innerHTML = "Acceptez les termes et autorisations s'il vous plaît"
    }
});
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.getElementById('section_message').style.display = 'none';
    }, 20000); 
});