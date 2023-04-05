const loader = document.querySelector('.loader');
const productListing = document.querySelector('.product-listing');
const card=document.querySelector('.product-card');

const deleteProduct= document.querySelector('.delete-popup-btn');
deleteProduct.addEventListener('click', () => {
    if (confirm('Bạn có chắc là muốn xoá sản phẩm này không?')) {
    showAlert('Đã xoá thành công');
    card.classList.add('hide');
    let emtyBG=document.querySelector('.no-product-image');
    setTimeout(() => {
        emtyBG.classList.remove('hide');
      }, 1200);}
    else{
        showAlert('Xoá thất bại');
    }
})

//alert
const showAlert = (msg) =>{
    let alertBox = document.querySelector('.alert-box');
    let alertMsg = document.querySelector('.alert-msg');
    alertMsg.innerHTML = msg;
    alertBox.classList.add('show');
    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 3000);
}
