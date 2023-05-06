     

import {pagesToElement,useFunc} from "../js/page.js"; 
doFirst();
function doFirst(){
    let DpP = 5; //amountOfDataPerPage
    var xhr2 = new XMLHttpRequest();
    xhr2.open("GET", "mHistorycart.php", true);
    
    xhr2.onload = function () {
        
    if (xhr2.status == 200) {
        
    var data = JSON.parse(xhr2.responseText);
    
    var products = data.data_sp;
    var sp_1st = data.id_1st_sp;
     
     function myFunc(num) {
        console.log(num);
            var productContainer = document.getElementById('boxajax');
            var productHtml = "";
            if(products.length === 0) {
                productContainer.innerHTML = `Bạn chưa mua gì`;
            }
            else{
                productHtml = '<table><tr><th></th><th>Sản phẩm</th><th>Số lượng</th><th>giá</th><th>ngày đặt mua</th><th class="status-confirm">trạng thái</th></tr>';
                for (let i = 0; i <DpP && (DpP*(num-1) + i)< products.length; i++) {
                    var page = DpP*(num-1) + i;
                    if(products[page].id_sp == sp_1st[products[page].id_dh])
                        productHtml += "<tr><th>#"+products[page].id_dh+"</th><th class='th-white'></th><th class='th-white'></th><th class='th-white'></th><th class='th-white'></th><th class='th-white' class='status-confirm'></th></tr>";
                    productHtml += `<tr><td></td><td>`;
                    productHtml += `<div class="cart-info"><img src="` + products[page].HinhSP + `"><div>`;
                    productHtml += `<h3>` + products[page].TenSP + ` (`+ products[page].MaSP + `)</h3>`;
                    productHtml += `<small>` + products[page].MoTaSP +`</small><br>`;
                    productHtml += `<a class="link-text" href="products[page].php?MaSP=` + products[page].masp + `">Xem chi tiết</a></div></div></td>`;
                    var gia = parseInt(products[page].GiaSP) * parseInt(products[page].soluong);
                    productHtml += `<td><a>`+ products[page].soluong +`</a></td><td>` + gia.toLocaleString('vi-VN') + `₫</td>`;
                    productHtml += `<td>`+ products[page].date +`</td><td><button class="btn-huydon" name="huydon" data-idsp=` + products[page].id_sp+ " data-iddh="+products[page].id_dh+`>Hủy đơn</button><p>`+ (products[page].trangthai == "waiting"?"Đang xử lý":"Đã xử lý") +`</p></td></tr>`;
                }
                productContainer.innerHTML = productHtml;
            }
            document.querySelectorAll(".btn-huydon").forEach(function(item){
                item.addEventListener("click",(e)=>{
                    deleteCart(item.dataset.idsp,item.dataset.iddh);
                    doFirst();
                });
            })
    }
pagesToElement(products.length, DpP,document.querySelector(".list_page"),myFunc);  
}
}
xhr2.send();
 
    }
function deleteCart(idsp,iddh) {
        // Tạo đối tượng XMLHttpRequest
        
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "thanhtoan.php?id_sp=" + idsp + "&id_dh="+iddh+"&huydon=1", true);
        xhr.onload = function () {
            
            if (xhr.status == 200) {
            }
        
        
        };
        xhr.send();
    }
    
