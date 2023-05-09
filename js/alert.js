export default function Alert(msg, signtext, color,func) {
    var sign = document.querySelector(".alert-sign");
    var alertBox = document.querySelector('.alert-box');
    var alertMsg = document.querySelector('.alert-msg');
    sign.innerHTML = signtext;
    alertMsg.style.color = color;
    sign.style.color = color;
    sign.style.textAlign = "center";
    alertMsg.innerText = msg;
    alertBox.classList.add('show');
    func;
    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 2000);
}

