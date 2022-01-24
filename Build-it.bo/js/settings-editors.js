const change = document.getElementsByClassName("change")
const form_name = "-editor";

let showAndHide = function() {
    let curr_div = document.getElementsByClassName(this.id)[0];
    let hidden_form = document.getElementById(this.id + "" + form_name);

    if(curr_div.hasAttribute('style') && curr_div.style.display != "none") {
        curr_div.style.display = "block";
        hidden_form.style.display = "none";
    } else {
        curr_div.style.display = "none";
        hidden_form.style.display = "flex";
    }
}

for(let i=0; i<change.length;i++) {
    change[i].addEventListener('click', showAndHide, false);
}