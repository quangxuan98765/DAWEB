//price inputs
const acctualPrice = document.querySelector('#actual-price');
const discountPercentage = document.querySelector('#discount');
const sellingPrice = document.querySelector('#selling-price');

discountPercentage.addEventListener('input', () => {
    if(discountPercentage.value >100){
        discountPercentage.value = 90;
    }
    else{
        let discount = acctualPrice.value * discountPercentage.value /100;
        sellingPrice.value=acctualPrice.value - discount;
    }
})



