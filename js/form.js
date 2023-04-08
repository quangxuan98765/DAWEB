const loader = document.querySelector('.loader');


//select input
const submitBtn = document.querySelector('.submit-btn');
const name = document.querySelector('#name');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const uname = document.querySelector('#username');
// const phone = document.querySelector('#phone');
const tac = document.querySelector('#term-and-cond');
const notification = document.querySelector('#notidication');

submitBtn.addEventListener('click', () =>{
    if(name){ // Trang đăng ký
        if(name.value.trim().length < 3){
            showAlert('Tên không hợp lệ');
        } else if(!email.value.trim()){
            showAlert('Vui lòng nhập email');
        } else if(!/^\S+@\S+\.\S+$/.test(email.value.trim())){
            showAlert('Email không hợp lệ');
        } else if(uname.value.indexOf(" ") !== -1){
            showAlert('Tên đăng nhập không được chứa khoảng trắng!');
        } else if(password.value.trim().length < 8){
            showAlert('Mật khẩu phải có ít nhất 8 kí tự');
        } else if(!phone.value.trim()){
            showAlert('Vui lòng nhập số điện thoại');
        // } else if(!/^\d+$/.test(phone.value.trim())){
        //     showAlert('Số điện thoại không hợp lệ');
        } else if(!tac.checked){
            showAlert('Bạn phải đồng ý với các điều khoản và dịch vụ của chúng tôi');
        } else{
            // Nếu form hợp lệ, có thể submit form
            loader.style.display = 'block';
        }  
    }
})

// Hàm hiển thị thông báo
const showAlert = (msg) =>{
    let alertBox = document.querySelector('.alert-box');
    let alertMsg = document.querySelector('.alert-msg');
    alertMsg.innerHTML = msg;
    alertBox.classList.add('show');
    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 900);
}

