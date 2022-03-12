let quantity = document.getElementById("quantity");
let totalPriceElement = document.getElementById("totalPrice");
let selectStorageItemElement = document.getElementById('storageItem_id');

quantity.oninput = function () {
    try {
        if (quantity.value === "") {
            totalPriceElement.innerHTML = "0.00 lv."
            return;
        }

        let price = selectStorageItemElement.options[selectStorageItemElement.selectedIndex].getAttribute("price");

        if (isNaN(price) || price.indexOf('.') == -1) {
            totalPriceElement.innerHTML = "0.00 lv."
            return;
        }

        let quantityValue = quantity.value;

        if (isNaN(quantityValue)) {
            totalPriceElement.innerHTML = "0.00 lv."
            return;
        }

        totalPriceElement.innerText = (Math.round(parseFloat(price) * parseFloat(quantityValue) * 100) / 100).toFixed(2);;
        totalPriceElement.innerHTML += " lv.";
    }
    catch (error) { console.log(error); }
}

selectStorageItemElement.onchange = quantity.oninput;