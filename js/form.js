const loader = document.querySelector('.loader');


//select input
const submitBtn = document.querySelector('.submit-btn');
const name = document.querySelector('#name');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const number = document.querySelector('#number');
const tac = document.querySelector('#term-and-cond');
const notification = document.querySelector('#notidication');

/*sua chua code tai day*/
submitBtn.addEventListener('click', () =>{
    if(name!=null){// sign up page
        if(name.value.length <3){
            showAlert('Tên không hợp lệ');
        } else if(!email.value.length){
            showAlert('Vui lòng nhập mail');
        }else if(password.value.length <8){
            showAlert('mật khẩu phải dài hơn 8 kí tự');
        } else if(!number.value.length){
            showAlert('Vui lòng nhập số điện thoại');
        } else if(!Number(number.value)|| number.value.length <10){
            showAlert('Số điện thoại lỗi. Nhập lại');
        } else if(!tac.checked){
            showAlert('Bạn phải đồng ý điều khoản và dịch vụ của chúng tôi');
        } else{
            //submit form
            loader.style.display = 'block';
        }  
    }else{//ranh thi sua lai o cho nay cho day du giong ben tren
        //login page
        if(!email.value.length|| !password.value.length){
            showAlert('Vui lòng điền đủ thông tin ');
        } else if(password.value.length<8){
            showAlert('mật khẩu phải hơn 8 ký tự');
        } else{
            //submit form
            loader.style.display = 'block';
            if(email.value=="admin" && password.value=="admin1234"){
                location.href = "admin.html"
            } 
            else{
                location.href="index.html";
            }
        }  
    }
})

//send data funcion
//cai nay chua hoc nen cung chua can den

////alert function
const showAlert = (msg) =>{
    let alertBox = document.querySelector('.alert-box');
    let alertMsg = document.querySelector('.alert-msg');
    alertMsg.innerHTML = msg;
    alertBox.classList.add('show');
    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 3000);
}
