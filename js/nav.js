const createNav = () => {
    let nav =document.querySelector('.navbar');

    nav.innerHTML = `
        <div class="nav">
            <img src="img/dark-logo.png" class="brand-logo" alt="">
            <div class="nav-items">
                    <div class="search">
                        <input type="text" class="search-box" placeholder="Tìm tên thương hiệu, sản phẩm...">
                        <button class="search-btn">Tìm kiếm</button>                       
                    </div>
                    <a>
                        <img src="img/user.png" id="user-img" alt="">
                        <div class="login-logout-popup hide">
                            <p class="account-info">Đang đăng nhập Group3@gmail</p>
                            <button class="btn" id="user-btn">đăng xuất</button>
                        </div>
                    </a>
                    <a href="historycart.html"><img src="img/history.png"></a>
                    <a href="cart.php"><img src="img/cart.png"></a>
            </div>
        </div>
        <ul class="links-container">
            <li class="link-item"><a href="index.php" class="link"><img src="img/home.png">Trang chủ</li>
            <li class="link-item"><a href="womenarmor.html" class="link">women armor</li>
            <li class="link-item"><a href="menarmor.php" class="link">man armor</li>
            <li class="link-item"><a href="accessories.html" class="link">phụ kiện</li>
            <li class="link-item"><a href="product.html" class="link">sản phẩm</li>
            <li class="link-item"><a href="404.html" class="link">404</li>
        </ul>
    `;
}

createNav();

//nav popup
const userImageButton = document.querySelector('#user-img');
const userPop = document.querySelector('.login-logout-popup');
const popuptext = document.querySelector('.account-info');
const actionBtn = document.querySelector('#user-btn');

userImageButton.addEventListener('click', () =>{
    userPop.classList.toggle('hide');
})

//cho nay se code lay ten tu sever xuong

// search box

const searchBtn = document.querySelector('.search-btn');
const searchBox = document.querySelector('.search-box');
searchBtn.addEventListener('click', () =>{
    if(searchBox.value.length){
        location.href = `search.html?data=${searchBox.value}`
    }
})

const Btn = document.querySelector('.btn');
Btn.addEventListener('click', () =>{
        location.href = `login.html`
})
