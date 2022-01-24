const hide = document.getElementsByClassName("hide-error");
const div = document.getElementById('global-alert');

let hideGlobalAllerts = function() {
    div.style.display = "none";
}

for(let i=0; i<hide.length;i++) {
    hide[i].addEventListener('click', hideGlobalAllerts, false);
}