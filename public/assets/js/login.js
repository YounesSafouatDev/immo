const btn = document.getElementById('btn_form');
var message_email = document.getElementById('message_email');
var message_password = document.getElementById('message_password');

btn.addEventListener('click',(e)=>{
    var email = document.getElementById('email').value;
    var passowrd = document.getElementById('password').value;
    let pass = true;
    let em = true;
    if( email.length == 0 ) {
        message_email.innerText = "Email was empty";
        em = false;
    }
    if(passowrd.length == 0){
        message_password.innerText = "Password was empty ";
        pass = false;
    }
    if(em == false && pass == false){
        e.preventDefault();
    }
})
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.getElementById('section_message').style.display = 'none';
    }, 20000); 
});