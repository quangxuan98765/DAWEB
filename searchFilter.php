<!DOCTYPE html>
<html lang="vi">
<?php
require_once('lib_login_session.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/searchIndex.css">
    <link rel="stylesheet" href="css/page.css">
</head>

<body>
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
                <?php
                    if(isLogged() == 0 || isLogged() == 1) {
                        echo "<p class='account-info'>Xin chào, " . $_SESSION['current_username'] . "!</p>";
                        echo ('<button class="btn" id="user-btn">đăng xuất</button>');?>
                        <script>
                            var logoutBtn = document.getElementById("user-btn");

                            logoutBtn.addEventListener("click", function() {
                                var xhr1 = new XMLHttpRequest();
                                xhr1.open('POST', 'unset_lib_login_session.php', true);

                                xhr1.onload = function() {
                                    //var response = JSON.parse(this.responseText);
                                    if (this.responseText === 'ok') {
                                        window.location.reload();
                                    }
                                };

                                xhr1.send();
                            });
                        </script>
                <?php
                    }
                    else {
                        echo "<p class='account-info'>bạn chưa đăng nhập</p>";
                        echo ('<button class="btn" id="user-btn">đăng nhập</button>');?>
                        <script>
                            document.getElementById("user-btn").addEventListener("click", function() {
                                window.location.href = "login.html";
                            });
                        </script>
                <?php
                    }
				?>
                </div>
            </a>
            <?php
                if(isLogged() == 1 || isLogged() == 0){
                    echo '<a href="historycart.php"><img src="img/history.png"></a><a href="cart.php"><img src="img/cart.png"></a>';
                }
            ?>
    </div>
    </div>
    <ul class="links-container">
    <li class="link-item"><a href="index.php" class="link"><img src="img/home.png">Trang chủ</li>
    <li class="link-item"><a href="laptopProduct.php" class="link">Laptop</li>
    <li class="link-item"><a href="acceProduct.php" class="link">Phụ Kiện</li></a>
    <?php
        if(isLogged() == 1){
            echo '<li class="link-item"><a href="addProduct.html" class="link">Thêm sản phẩm</li>';
            echo '<li class="link-item"><a href="order.php" class="link">Quản lý Shop</li></a>';
        }
    ?>
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
                <option value="`%s`<7000000">dưới 7 triệu</option>
                <option value="`%s`>=5000000 AND `%s`<15000000">từ 5 tới 15 triệu</option>
                <option value="`%s`>=15000000 AND `%s`< 30000000">từ 15 tới 30 triệu</option>
                <option value="`%s`>=30000000">trên 30 triệu</option>
            </select>
        </div>
        <div class="box">
            <select id="select-sort" class="select select-combo">
                <option value="">Xếp theo: Nổi bật</option>
                <option value="ASC">Giá từ thấp đến cao</option>
                <option value="DESC">Giá từ cao đến thấp</option>
            </select>
        </div>
    </div>
        <h2 class="product-category">Sản phẩm</h2>
        <div class="order-page"></div>

        <ul class="list_page">
        </ul>
    </section>
    
    <footer></footer>
    
    <script type="module" src="js/searchBar.js"></script>
    <script type="module"> 
        import { newFunc } from "./js/searchBar.js";
        newFunc();
    </script>
    <script src="js/footer.js"></script>
    <script src="js/search.js"></script>

</body>

</html>