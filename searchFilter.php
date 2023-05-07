<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm cho MENARMOR</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">

    <link rel="stylesheet" href="css/page.css">
</head>

<body>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/searchIndex.css">
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
    
    </ul>
    <script>
        const userImageButton = document.getElementById("user-img");
        const userPop = document.querySelector('.login-logout-popup');
        userImageButton.addEventListener('click', () => {
            userPop.classList.toggle('hide');
        })
    </script>
    <section class="search-results">
        <div class="box">
            <a class="titlefilter">Bộ lọc <img src="img/filter.png"></a>
            <?php include_once('addfil.php'); ?>
            <a class="nameselect-combo">Giá</a>
            <select id="select-cost" class="select-combo">
                <option value="">chọn khoảng giá</option>
                <option value="`%s`<2000000">dưới 2 triệu</option>
                <option value="`%s`>=2000000 AND `%s`<4000000">từ 2 tới 4 triệu</option>
                <option value="`%s`>=4000000 AND `%s`<6000000">từ 4 tới 6 triệu</option>
                <option value="`%s`>=6000000">trên 6 triệu</option>
            </select>
        </div>
        <div class="box">
            <select id="select-sort" class="select select-combo">
                <option value="">Xếp theo: Nổi bật</option>
                <option value="ASC">Giá từ thấp đến cao</option>
                <option value="DESC">Giá từ cao đến thấp</option>
            </select>
        </div>
        <h2 class="product-category">Sản phẩm</h2>
        <div class="order-page"></div>

        <ul class="list_page">
        </ul>
    </section>
    <h2 class="read-more">xem thêm</h2>
    
    <footer></footer>
    
    <script type="module" src="js/searchBar.js"></script>
    <script type="module"> 
        import { newFunc } from "./js/searchBar.js";
        newFunc();
    </script>
    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/search.js"></script>

</body>

</html>