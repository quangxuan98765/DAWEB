     
    var thispage=1;
    import {pagesToElement} from "../js/page.js";
    let DpP = 5; //amountOfDataPerPage

    var xhr2 = new XMLHttpRequest();
    xhr2.open("GET", "mHistorycart.php", true);
    xhr2.onload = function () {
        
    if (xhr2.status == 200) {
    
    var data = JSON.parse(xhr2.responseText);
    
    var products = data.data_sp;
    var sp_1st = data.id_1st_sp;
    var dh_cost = data.dh_cost;
     pagesToElement(products.length, DpP,document.querySelector(".list_page"),function myFunc(num) {
            thispage=num;
            var productContainer = document.getElementById('boxajax');
            var productHtml = "";
            if(products.length === 0) {
                productContainer.innerHTML = `<div class="container" style="text-align:center;"><img src="img/no-products.png" alt=""><p class="overlay" id="formtt"> Không có lịch sử mua hàng</p></div>`;
            }
            else{
                productHtml = '<table><tr style=\"background-color: hsl(189.87deg 94% 68% / 50%);\"><th></th><th>Sản phẩm</th><th>Số lượng</th><th>giá</th><th>ngày đặt mua</th><th class="status-confirm">trạng thái</th></tr>';
                for (let i = 0; i <DpP && (DpP*(num-1) + i)< products.length; i++) {
                    var page = DpP*(num-1) + i;
                    if(products[page].id_sp == sp_1st[products[page].id_dh])
                        productHtml += "<tr style=\"background-color: yellow;\"><th>#"+products[page].id_dh+"</th><th></th><th></th><th>"+parseInt(dh_cost[products[page].id_dh]).toLocaleString('vi-VN') + "₫</th><th></th><th  ><button class='btn-huydon' name='huydon' data-iddh='"+products[page].id_dh+"'>Hủy đơn</button><p>"+ (products[page].trangthai == "waiting"?"Đang xử lý":"Đã xử lý") +"</p></th></tr>";
                    productHtml += `<tr><td></  td><td>`;
                    productHtml += `<div class="cart-info"><img src="` + products[page].HinhSP + `"><div>`;
                    productHtml += `<h3>` + products[page].TenSP + ` (`+ products[page].MaSP + `)</h3>`;
                    productHtml += `<small>` + products[page].MoTaSP +`</small><br>`;
                    productHtml += `<a class="link-text" href="product.php?MaSP=` + products[page].MaSP + `">Xem chi tiết</a></div></div></td>`;
                    var gia = parseInt(products[page].GiaSP) * parseInt(products[page].soluong);
                    productHtml += `<td><a>`+ products[page].soluong +`</a></td><td>` + gia.toLocaleString('vi-VN') + `₫</td>`;
                    productHtml += `<td>`+ products[page].date +`</td><td></td></tr>`;
                }
                console.log(productHtml);
                productContainer.innerHTML = productHtml;
                productContainer.querySelectorAll(".btn-huydon").forEach(function(item){
                    item.addEventListener("click",()=>{
                        deleteCart(item.dataset.iddh)
                        location.reload();
                    });
                })
            }

    })
}
    }
    xhr2.send();
    
    function deleteCart(iddh) {
        // Tạo đối tượng XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "thanhtoan.php?id_dh="+iddh+"&huydon=1", true);
        xhr.onload = function() {
            }
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send();
    }
