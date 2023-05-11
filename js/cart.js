var select = document.getElementById("mySelect");
var link = document.getElementById("myLink");

select.addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var selectedValue = selectedOption.value;
    link.href = 'editlocationForm.php?id=' + selectedValue;
});

function checkOnlyOne1(checkbox) {
    var checkxh = document.getElementsByName('xungho');
    checkxh.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

function checkOnlyOne2(checkbox) {
    var checkxh = document.getElementsByName('pay');
    checkxh.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

var link1 = document.getElementById("add-address-link");
var link2 = document.getElementById("mySelect");


var checkbox3 = document.getElementById("onl");
var checkbox4 = document.getElementById("cod");
var link4 = document.getElementById("bank");

checkbox3.addEventListener('change', function() {
    link4.style.display = checkbox3.checked ? 'inline' : 'none';
    checkOnlyOne2(this);
});

checkbox4.addEventListener('change', function() {
    if (this.checked && !checkbox3.checked) {
        link4.style.display = "none";
    }
    checkOnlyOne2(this);
});

function validateForm() {
    var name = document.forms["form"]["hoten"].value;
    var sdt = document.forms["form"]["sdt"].value;
    var pay = document.forms["form"]["bank"].value;
    if (name == "" || sdt == "" || (checkbox3.checked && pay == "" )|| (!checkbox3.checked && !checkbox4.checked)) {
        alert("Vui lòng điền đủ thông tin.");
        return false;
    }
    if(document.getElementById("mySelect").value == -1){
        alert("Vui lòng điền đủ thông tin.");
        return false;
    }
}

const productContainer = document.getElementById('formtt');
const myForm = document.getElementById("my-form");
if(productContainer.innerHTML === 'Giỏ hàng của bạn đang trống'){
    myForm.style.display = "none";
}else{
    myForm.style.display = "block";
}
