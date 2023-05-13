import {pagesToElement} from "../js/page.js";
doFirst();
function doFirst(){
  
  // if(sort == "DESC"|| sort == "ASC"){
  //   var data ={action : "sortDate",
  //             sort : sort}
  // }else if(sort.action == "searchDate"){
  //   document.querySelector(".select-order").selectedIndex = 0;
  //   document.querySelector(".select-location").selectedIndex = 0;
  //   var data = sort;
  // }else{
  //   var data ={action : "sortStatus",
  //   status : sort}
  // }  
  var getSort = document.querySelector(".select-order").value;
  var sortT;
  sortT = (getSort == "DESC"|| getSort == "ASC")?"sortDate": "sortStatus";
var getLocation = document.querySelector(".select-location").value;
var fdate = document.querySelector(".date-search");
  let data = {
      action:"sort",
    ...(getLocation !== "" && {
      location: getLocation,
    }),
    ...( (fdate.querySelector(".from-date").value!= "" || fdate.querySelector(".to-date").value!= "") && {
      searchDate:"1",
      fromDate:fdate.querySelector(".from-date").value,
      toDate:fdate.querySelector(".to-date").value,
    }),
    ...(getSort !== "" && {
      sortType:sortT,
      sort: getSort,
    }),
  };
console.log(data);
  document.querySelector(".date-search");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "mOrder.php", true);
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhr.onload = function () {
    if (xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      
    console.log(data);
     let DpP = 8; //amountOfDataPerPage
     pagesToElement(data.length, DpP,document.querySelector(".list_page"),function myFunc(num) {
    
      var p = document.querySelector(".oder-page1").querySelector("table");
    var s = '<tr><th>#</th><th>Mã đơn hàng</th><th>Khách Hàng</th><th>Thời gian</th><th>Thành tiền</th> <th>Hình thức thanh toán</th><th>địa chỉ</th><th>Tình trạng đơn</th><th>Hành động</th></tr>';
    for (let i = 0; i <DpP && (DpP*(num-1) + i)< data.length; i++) {
      var page = DpP*(num-1) + i;
      s += '<tr class="data-row" data-id="'+ data[page].id+'"><td><p style="color:black">'+ (i+1) + `</p><td><a class="see-full" data-id="${data[page].id}"`
        +'">'+ data[page].id +'</a><td><p>'+data[page].tentaikhoan +'</p></td><td><a>'+data[page].date+'</a></td><td><a>'
        +parseInt(data[page].cost).toLocaleString('vi-VN') + ' vnd</a></td><td><a>'+data[page].payment+ '</a></td><td>'+data[page].city+'</td><td><a>' 
        + (data[page].trangthai == "waiting"
        ?'Đang đợi xác nhận</a></td><td class="wait-btn"><button class="cancel-btn">Huỷ</button><button class="confirm-btn">Xác nhận</button>'
        :(data[page].trangthai=="cancelled"? 'Đã huỷ</a></td><td><button class="canceled-btn">Đã huỷ</button>'
        :'Đã xác nhận</a></td><td><button class="confirmed-btn">Đã xác nhận</button>'))
        + '</td></tr>';
      }
      p.innerHTML = s;
       document.querySelectorAll(".wait-btn").forEach(function (item) {
      item.querySelector(".cancel-btn").addEventListener("click",()=>{
        var data1 = {action:"changeStatus",
                    status:"cancelled",
                    id:item.parentElement.dataset.id
                  };
        queryRequest(data1);
       
      });
      
      item.querySelector(".confirm-btn").addEventListener("click",()=>{
        var data2 = {action:"changeStatus",
                    status:"confirmed",
                    id:item.parentElement.dataset.id
                  };
        queryRequest(data2);
        
      });
   
   
    })
    document.querySelectorAll(".see-full").forEach(function(element){
      element.addEventListener("click",(e)=>{
        e.preventDefault();
          const params = new URLSearchParams({ id: element.dataset.id});
          const url = "orderdetail.php?" + params.toString();
          window.location.href = url;
      })
    })
    }
    
    )
     };
    
    }
    
xhr.send(JSON.stringify(data));
}
  


document.querySelector(".select-order").addEventListener("change",(e)=>{doFirst();})
document.querySelector(".select-location").addEventListener("change",(e)=>{doFirst();})
var fdate = document.querySelector(".date-search");
fdate.querySelector(".btn.btn-search-date").addEventListener("click",()=>{
  document.querySelector(".select-order").selectedIndex = 0;
  document.querySelector(".select-location").selectedIndex = 0;

  // var data ={ action:"searchDate",
  //   fromDate:fdate.querySelector(".from-date").value,
  //   toDate:fdate.querySelector(".to-date").value
  // }
  doFirst();
})

function queryRequest(data){
  var xhr1 = new XMLHttpRequest();
  xhr1.open("POST", "./mOrder.php", true);
  xhr1.setRequestHeader('Content-type', 'application/json; charset=utf-8');
  xhr1.onload = function () {
    console.log(xhr1.responseText);
      if (this.status == 200) {
        doFirst();
      }
}
xhr1.send(JSON.stringify(data))
}
