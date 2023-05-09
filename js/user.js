import {pagesToElement} from "../js/page.js";
doFirst("");
function doFirst(role){
var xhr = new XMLHttpRequest();
xhr.open("POST", "user.php", true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.onload = function () {
  if (xhr.status == 200) {
    var data = JSON.parse(xhr.responseText);
    let DpP = 6; //amountOfDataPerPage
    var fun;
    pagesToElement(data.length, DpP,document.querySelector(".list_page"),function myFunc(num) {
        var s = `<table><tr><th>Tên tài khoản</th><th>Tên người dùng</th><th>Quyền hạn</th><th class="table-btn-zone">Hành động</th><th     style="width: 250px;">Trạng thái</th></tr>`;
        var p = document.querySelector(".oder-page");
        for (let i = 0; i <DpP && (DpP*(num-1) + i)< data.length; i++) {
            var page = DpP*(num-1) + i;
            s += '<tr class ="data-row" data-uname="'+data[page].username+'" data-role="'+data[page].role+'"><td><a style="text-transform: none;" >'+data[page].username+'</a></td><td><a style="text-transform: none;" >'+data[page].fullname+'</a></td><td><p style="text-transform: none; '
            + ((data[page].role == "admin")?' color: red;"':'"')  + '>'
            + data[page].role+'</p></td><td><button class="edit-btn">chỉnh sửa</button><button class= "delete-btn">xoá</button></td><td>' + ((data[page].role == "admin")?'':((data[page].disabled == 0?`bình thường  <button class="disable-btn">Khóa`:`Đã khóa  <button class="enable-btn">Mở khóa`)+'</button>'))+'</td></tr>';
        }
        p.innerHTML = s +"</table>";
        document.querySelectorAll(".data-row").forEach(function (item) {
            var deleteData;
            var deleteBtn = item.querySelector(".delete-btn");
            function editData(e){
                e.preventDefault();
                var retn = item.outerHTML;
                var info = item.querySelectorAll("td");
                
                console.log(info[0].innerText +": " +info[1].innerText+": " +info[2].innerText);
                var newE = document.createElement("tr");
                var t = '<td><a style="margin:0%;text-transform: none;">'+info[0].innerText+'</a></td>'
                 + '<td><input style="margin:0%; text-transform: none;" type="text" id="fullname" value="'+info[1].innerText+'"></td>'
                +'<td><input style="margin:0%; text-transform: none;" type="text" id="role" value="'+info[2].innerText+'"></td>';
                var e1 = document.createElement("td");
                e1.innerHTML = '<button class="confirm-btn">lưu</button><button class="cancel-btn">hủy</button>';
                item.innerHTML = t;
                item.insertAdjacentElement("beforeend",e1);
                item.querySelector(".cancel-btn").addEventListener("click",(e)=>{
                    e.preventDefault();
                    item.innerHTML = retn;
                    item.querySelector(".delete-btn").addEventListener("click",deleteData);
                    var deleteBtn = item.querySelector(".delete-btn");
                    if(item.dataset.role == "admin")    
                        deleteBtn.classList.add("disabled-btn");
                    item.querySelector(".edit-btn").addEventListener("click",editData);
                 })
                
                item.querySelector(".confirm-btn").addEventListener("click",(e)=>{
                    e.preventDefault();
                    var fname = item.querySelector("#fullname").value;
                    var r = item.querySelector("#role").value;
                    
                    var data = {
                        username:info[0].innerText,
                        ...((info[1].innerText != fname && fname != "") && {
                            fullname: fname}),
                        ...((info[2].innerText != r && r != "") && {
                            role: r})
                    }
                    if(Object.keys(data).length>1){
                        data.action = "edit";
                        queryRequest(data);}
                    else {
                        item.innerHTML = retn;
                        item.querySelector(".edit-btn").addEventListener("click",editData);
                    }
                    })
        }
            item.querySelector(".edit-btn").addEventListener("click",editData);
            if(item.dataset.role == "admin")    
                deleteBtn.classList.add("disabled-btn");
            deleteBtn.addEventListener("click",deleteData = function deleteData(e){
                e.preventDefault();   
                var deleteBtn = item.querySelector(".delete-btn"); //deq uy lai khong truy xuat dc element chua no, dinh nghia lai            
                var retn = item.outerHTML;
                var e1 = deleteBtn.parentElement;
                console.log(e1);
                e1.innerHTML = '<button class="confirm-del-btn">&#215; xóa</button><button class="cancel-btn">hủy</button>';
                
                console.log(e1);
                item.querySelector(".cancel-btn").addEventListener("click",()=>{
                    item.innerHTML = retn;
                    console.log(item.querySelector(".delete-btn"));  
                    item.querySelector(".delete-btn").addEventListener("click",deleteData);
                    item.querySelector(".edit-btn").addEventListener("click",editData);
                 })
                item.querySelector(".confirm-del-btn").addEventListener("click",(e)=>{
                    e.preventDefault();
                    var data = {username:item.dataset.uname,
                                action:"delete"}; 
                    queryRequest(data);
                })
                    })
                    
              
            })
            disableFunc();
            enableFunc();
            function disableFunc(){
                document.querySelectorAll(".disable-btn").forEach((element)=>{
                    
                element.addEventListener("click",(e)=>{

                   
                console.log(element.parentElement.parentElement); 
                    // e.target.parentElement.innerHTML = ((data[page].disabled == 0?`bình thường  <button class="disable-btn">Khóa`:`Đã khóa  <button class="enable-btn">Mở khóa`)+'</button>');
                    if (confirm("Xác nhận khóa tài khoản "+element.parentElement.parentElement.dataset.uname+" ?")) {
                        var data = {
                            username:element.parentElement.parentElement.dataset.uname,
                            action:"disable",
                            disable_value:1
                        }
                        if(queryRequest(data))
                        e.target.parentElement.innerHTML = (`bình thường  <button class="disable-btn">Khóa</button>`);
                        enableFunc();
                      } 
                })
            })
            
            }
            function enableFunc(element){
                document.querySelectorAll(".enable-btn").forEach((element)=>{
                    element.addEventListener("click",(e)=>{
                    if (confirm("Xác nhận mở khóa cho tài khoản "+element.parentElement.parentElement.dataset.uname+" ?")) {
                        var data = {
                            username:element.parentElement.parentElement.dataset.uname,
                            action:"disable",
                            disable_value:0
                        }
                        if(queryRequest(data))
                            e.target.parentElement.innerHTML = (`Đã khóa  <button class="enable-btn">Mở khóa</button>`);
                        disableFunc();
                      } 
                })
                })
            }

            
 })
    }}
    xhr.send('role='+role);
}

import alert from "../js/alert.js";
function queryRequest(data){
    var xhr1 = new XMLHttpRequest();
    xhr1.open("POST", "./controlUser.php", true);
    xhr1.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhr1.onload = function () {
        if (this.status == 200) {
            var text = xhr1.responseText;
            console.log(text)
            if(text == "Updated" || text == "Deleted" || text == "Disabled updated"){
                alert("Notice: " +xhr1.responseText,"\u2714", "green",doFirst(document.querySelector(".select-role").value));
                return true;
            }
        //  deleteBut.addEventListener("click",(e)=>{e.preventDefault();})
            else {
                alert(text,"&#215;", "red",{});
                return false;
            }
        }
}
xhr1.send(JSON.stringify(data))
}
document.querySelector(".select-role").addEventListener("change",(e)=>{
    e.preventDefault();
    doFirst(e.target.value);
})
//   function queryRequest(data) {
//   var xhr1 = new XMLHttpRequest();
//   var queryString = Object.keys(data).map(function(key) {
//     return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
//   }).join('&');
//   xhr1.open('GET', './controlUser.php?' + queryString, true);
//   xhr1.onload = function() {
//     if (xhr1.readyState === 4 && xhr1.status === 200) {
//       console.log('Dữ liệu trả về: ' + xhr1.responseText);
//       // deleteBut.addEventListener("click",(e)=>{e.preventDefault();})
//     }
//   };
//   xhr1.send();
// }




