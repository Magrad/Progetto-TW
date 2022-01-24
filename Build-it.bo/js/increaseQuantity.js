const ELEMENTS = 2;
const increase = document.getElementById("increase");
const decrease = document.getElementById("decrease");
const quantity = document.getElementById("quantita-articolo");

let changeValue = function() {
    quantity.value = quantity.value == "" ? 0 : quantity.value;

    if(parseInt(quantity.value) != NaN) {
        let value = parseInt(quantity.value);
        if(this.id == "decrease" && value >= 1) value--; 
        if(this.id == "increase") value++;
        quantity.value = "" + value;
    }
}

increase.addEventListener('click', changeValue, false);
decrease.addEventListener('click', changeValue, false);