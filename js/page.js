//count is amount of datas
//n is amount of datas per page
//ex: 20 data, 1page 4 data => count = 5, n = 4
export function pagesToElement(count, amountdpp, element, click) {
  var s =
    '<li class="list_page_item list_page_item--active" data-value="1"><a href="#" class="list_page_item_link link_page">1</a></li>';
  for (var i = 2; i <= Math.ceil(count / amountdpp); i++) {
    s +=
      '<li class="list_page_item" data-value="' +
      i +
      '"><a href="#" class="list_page_item_link link_page">' +
      i +
      "</a></li>";
  }

  element.innerHTML = s;
  click("1");
  const listItems = document.querySelectorAll(".list_page_item");
  if (listItems.length > 1) {
    var allPages = document.querySelectorAll(".link_page");
    var listActive = document.querySelector(".list_page_item--active");
    var curValue = listActive.dataset.value;
    var s1 =
      '<li class="first_page list_sign_item"><a href="" class="list_page_item_link" ><<</a></li>' +
      '<li class="prev_page list_sign_item"><a href="" class="list_page_item_link"><</a></li>' ;
    var s2 = 
      '<li class="next_page list_sign_item"><a href="" class="list_page_item_link">></a></li>' +
      '<li class="last_page list_sign_item"><a href="" class="list_page_item_link" >>></a></li>';

    element.insertAdjacentHTML("afterbegin", s1);
    element.insertAdjacentHTML("beforeend",s2);



    document
      .querySelector(".prev_page")
      .querySelector(".list_page_item_link")
      .addEventListener("click", (e) => {
        e.preventDefault();
    var curValue = document.querySelector(".list_page_item--active").dataset.value;
        if (curValue > 1) activeEvent(allPages[curValue - 2]);
      });
    document
      .querySelector(".next_page")
      .querySelector(".list_page_item_link")
      .addEventListener("click", (e) => {
        e.preventDefault();
    var curValue = document.querySelector(".list_page_item--active").dataset.value;
  
        if (curValue < allPages.length)
          activeEvent(allPages[curValue]);
      });
    document
      .querySelector(".first_page")
      .querySelector(".list_page_item_link")
      .addEventListener("click", (e) => {
        e.preventDefault();
        activeEvent(allPages[0]);
      });
    document
      .querySelector(".last_page")
      .querySelector(".list_page_item_link")
      .addEventListener("click", (e) => {
        e.preventDefault();
        activeEvent(allPages[allPages.length - 1]);
      });
  }
var i=1;
  listItems.forEach(function (Item) {
    var  linkk = Item.querySelector(".list_page_item_link");
    linkk.addEventListener("click",function(e) {
      e.preventDefault();


       listItems.forEach(function (item) {
        item.classList.remove("list_page_item--active");
       });
       Item.classList.add("list_page_item--active");
       click(Item.dataset.value);
    });
  });
  
}
function activeEvent(button) {
  const clickEvent = new Event("click");
  document.querySelectorAll(".list_page_item").forEach(function (item) {
    item.classList.remove("list_page_item--active");
   });
  button.parentElement.classList.add("list_page_item--active");
  button.dispatchEvent(clickEvent);
}
function useClick(element){

  e.preventDefault();

  var listItems = document.querySelectorAll(".list_page_item");
  listItems.forEach(function (item) {
   item.classList.remove("list_page_item--active");
  });
  Item.classList.add("list_page_item--active");

  click(element.dataset.value);
}
export function useFunc(page,func){
  func(page);
  const newListpageItem = document.querySelectorAll(".list_page_item");
  var newItem = newListpageItem[page-1];
    
   
    newListpageItem.forEach(function (item) {
      item.classList.remove("list_page_item--active");
     });
    newItem.classList.add("list_page_item--active");
};