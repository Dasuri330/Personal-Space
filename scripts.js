const form = document.querySelector('form');

function sendEmail() {
    Email.send({
        Host : "smtp.elasticemail.com",
        Username : "aishteru2314@gmail.com",
        Password : "9CDFA8E83BC09419B1EA840F85163A89ED24",
        To : 'aishteru2314@gmail.com"',
        From : "you@isp.com",
        Subject : "This is the subject",
        Body : "And this is the body"
    }).then(
      message => alert(message)
    );
}

form.addEventListener("submit", (e) =>{
    e.preventDefault();

    sendEmail(); //To be continued:
})