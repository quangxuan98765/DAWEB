import {pagesToElement} from "../js/page.js";
doFirst("ASC");
var lastsort;
function doFirst(sort){
  lastsort = sort;
  if(sort == "DESC"|| sort == "ASC"){
    var data ={action : "sortDate",
              sort : sort}
  }else if(sort.action == "searchDate"){
    document.querySelector(".select-order").selectedIndex = 0;
    var data = sort;
  }else{
    var data ={action : "sortStatus",
    status : sort}
  }  
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
      s += '<tr class="data-row" data-id="'+ data[page].id+'"><td><a>'+ (i+1) + '</a><td><p class="see-full" onclick="' + 'location.href="orderdetail.html"'
        +'">'+ data[page].id +'</p><td><p>'+data[page].tentaikhoan +'</p></td><td><a>'+data[page].date+'</a></td><td><a>'
        +data[page].cost + '</a></td><td><a>'+data[page].payment+ '</a></td><td>'+data[page].city+'</td><td><a>' 
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
     });
    
    }
    
}
xhr.send(JSON.stringify(data));
  }


document.querySelector(".select-order").addEventListener("change",(e)=>{doFirst(e.target.value);})
var fdate = document.querySelector(".date-search");
fdate.querySelector(".btn.btn-search-date").addEventListener("click",()=>{
  var data ={ action:"searchDate",
    fromDate:fdate.querySelector(".from-date").value,
    toDate:fdate.querySelector(".to-date").value
  }
  doFirst(data);
})

function queryRequest(data){
  var xhr1 = new XMLHttpRequest();
  xhr1.open("POST", "./mOrder.php", true);
  xhr1.setRequestHeader('Content-type', 'application/json; charset=utf-8');
  xhr1.onload = function () {
    console.log(xhr1.responseText);
      if (this.status == 200) {
        doFirst(lastsort);
      }
}
xhr1.send(JSON.stringify(data))
}