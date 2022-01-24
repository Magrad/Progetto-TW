const input = document.getElementById('upload');
const btn = document.getElementById("upload-btn");
const text = document.getElementById("text");
const upload_input = document.getElementById("upload-input");

input.addEventListener('change', () => {
    const path = input.value.split('\\');
    const filename = path[path.length - 1];

    text.innerText = filename ? filename : "Seleziona file";

    if(filename) {
        btn.classList.add("chosen");
        upload_input.style.display = "block";
    } else {
        btn.classList.remove("chosen");
        upload_input.style.display = "none";
    } 
})