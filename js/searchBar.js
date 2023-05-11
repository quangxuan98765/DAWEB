import { pagesToElement } from "../js/page.js";
firstFunc();
export function firstFunc() {
  document.querySelector(".search-btn").addEventListener("click", (e) => {
    var searchBox = document.querySelector(".search-box");
    var inputValue = searchBox.value;
    if (inputValue.trim() == "" || inputValue.trim() == " ") {
    } else {
      const params = new URLSearchParams({ searchValue: inputValue });
      const url = "searchFilter.php?" + params.toString();
      window.location.href = url;
      window.addEventListener("DOMContentLoaded", function () {
        newFunc();
      });
    }
  });
}
 export function newFunc() {
  const searchValue = new URLSearchParams(window.location.search).get(
    "searchValue"
  );
  document.querySelector(".search-box").value = searchValue;
  if (searchValue != null)
    document.querySelector(".product-category").innerText =
      "Tìm kiếm cho '" + searchValue + "'";
  document.querySelectorAll(".select-combo").forEach((e) => {
    e.addEventListener("change", () => {
      newFunc();
    });
  });
  // var e = document.querySelector(".list_page");
  var p = document.querySelector(".products-container");
  var getIdBrand = document.getElementById("select-brand").value;
  var getIdCategory = document.getElementById("select-category").value;
  var getCost = document.getElementById("select-cost").value;
  var getSort = document.getElementById("select-sort").value;
  var getSearch = document.querySelector(".search-box");
  let obj = {
    ...(getSearch.value.trim() != "" &&
      getSearch.value.trim() != " " && {
        searchValue: getSearch.value,
      }),
    ...(getIdBrand !== "" && {
      brand_id: getIdBrand,
    }),
    ...(getIdCategory !== "" && {
      category_id: getIdCategory,
    }),
    ...(getCost !== "" && {
      GiaSP: getCost,
    }),
    ...(getSort !== "" && {
      sort: getSort,
    }),
  };
  console.log(JSON.stringify(obj));

  var xhr_login = new XMLHttpRequest();
  xhr_login.open("GET", "lib_login_sesison(forAjax).php", true);
  xhr_login.onload = function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "searchFilQuery.php?data=" + JSON.stringify(obj));
    xhr.onload = function () {
      if (xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        console.log(data);

        var DpP = 9;
        pagesToElement(
          data.length,
          DpP,
          document.querySelector(".list_page"),
          (num) => {
            var p = document.querySelector(".order-page");
            var s = "";

            for (let i = 0; i < DpP && DpP * (num - 1) + i < data.length; i++) {
              if (i % 3 == 0) s += '<div class="product-container">';
              var page = DpP * (num - 1) + i;
              s +='<div class="product-card"><div class="product-image">';
              s += '<a href="product.php?MaSP=' + data[page].MaSP + '">';
              console.log(xhr_login.responseText);
              if(xhr_login.responseText == 1){
                s += '<img src="' + data[page].HinhSP + '" class="product-thumb"> <button class="card-btn">mua ngay</button>';
                s += '<a href="editProduct.php?id=' +  data[page].id + '"><button class="card-action-btn edit-btn">Sửa</button></a>';
                s += '<a href="manageProduct.php?del=1&id=' + data[page].id + '" onclick="return confirm(\'Are you sure?\');"><button class="card-action-btn delete-popup-btn">Xóa</button></a>';
              }
              else
                s += '<img src="'+ data[page].HinhSP +'" class="product-thumb"><button class="card-btn">mua ngay</button>';
              s += '</a></div><div class="product-info"><h2 class="product-brand">' + data[page].TenSP + '(' + data[page].MaSP + ')</h2>';
              s += '<p class="product-short-des">' + data[page].MoTaSP +'</p>';
              var gia = parseInt(data[page].GiaSP);
              s += '<span class="price">' + gia.toLocaleString('vi-VN') + ' vnđ</span></div></div>';
              if ((i % 3 == 2 && i != 0) || page == data.length) s += "</div>";
            }
            p.innerHTML = s;
          }
        );
      }
    };
    xhr.send();
  }
  xhr_login.send();
}
