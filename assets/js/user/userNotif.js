function sendMail() {
    let params = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
    };

    const serviceID = "service_ux63io4";
    const templateID = "template_t4vw3ql";

    emailjs
        .send(serviceID, templateID, params)
        .then((res) => {
            document.getElementById('name').value = "";
            document.getElementById('email').value = "";
            console.log('res');
            alert('Message Sent Successfully')
        })
        .catch((err) => console.log(err))
}

