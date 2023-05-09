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
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "searchFilQuery.php?data=" + JSON.stringify(obj));
  xhr.onload = function () {
    if (xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      console.log(data);

      var DpP = 6;
      pagesToElement(
        data.length,
        DpP,
        document.querySelector(".list_page"),
        (num) => {
          var p = document.querySelector(".order-page");

          console.log(p);
          var s = "";
          console.log(p);
          for (let i = 0; i < DpP && DpP * (num - 1) + i < data.length; i++) {
            if (i % 3 == 0) s += '<div class="product-container">';
            var page = DpP * (num - 1) + i;
            s +=
              '<div class="product-card"><div class="product-image">' +
              '<span class="discount-tag">' +
              data[page].product_sell +
              "</span>" +
              '<img src="' +
              data[page].HinhSP +
              '" class="product-thumb" alt="' +
              data[page].TenSP +
              '"> <button class="card-btn">thêm vào giỏ hàng</button></div>' +
              '<div class="product-info"><h2 class="product-brand">' +
              data[page].TenSP +
              '</h2><p class="product-short-des">Loại</p>' +
              '<span class="price">' +
              data[page].GiaSP +
              '</span><span class="actual-price"></span></div></div>';
            if ((i % 3 == 2 && i != 0) || page == data.length) s += "</div>";
          }
          p.innerHTML = s;
        }
      );
    }
  };
  xhr.send();
}
