let change = document.getElementsByClassName("show-more")
let processed = "-1";
let shipped = "-2";
let enroute = "-3";
let arrived = "-4";
let div_name = "track-";

let showAndHide = function() {
    if(this.classList.contains('180deg')) {
        this.classList.remove('180deg');
    } else { 
        this.classList.add('180deg');
    }

    this.style.transform = `rotate(${ this.classList.contains('180deg') ? 180 : 0 }deg)`;

    let hidden_div = document.getElementById(div_name + "" + this.id);
    
    let processed_tick = document.getElementById(this.id + "" + processed);
    let shipped_tick = document.getElementById(this.id + "" + shipped);
    let enroute_tick = document.getElementById(this.id + "" + enroute);
    let arrived_tick = document.getElementById(this.id + "" + arrived);

    let delivery = new Date(document.getElementById("delivery-" + "" + this.id).textContent).getTime();
    let buy = new Date(document.getElementById("bought-" + "" + this.id).textContent).getTime();

    let curr_date = new Date().getTime();

    if(curr_date < delivery) {
        function refresh() {
            activate(buy, delivery, processed_tick, shipped_tick, enroute_tick, arrived_tick);
        }

        setInterval(function() {
            refresh()
        }, 5000); //5 seconds
    } else {
        activate(buy, delivery, processed_tick, shipped_tick, enroute_tick, arrived_tick);
    }

    if(hidden_div.hasAttribute('style') && hidden_div.style.display != "none") {
        hidden_div.style.display = "none";
    } else {
        hidden_div.style.display = "block";
    }
}

let activate = function(start, end, div1, div2, div3, div4) {
    let curr = new Date().getTime();

    let percent = (curr - start) / (end - start);

    if(div4.className != "active") {
        if(curr > end) {
            div1.classList.add("active");
            div2.classList.add("active");
            div3.classList.add("active");
            div4.classList.add("active");
        } else if(percent >= 0.1 && div1.className != "active") {
            div1.classList.add("active");
        } else if(percent >= 0.3 && div2.className != "active") {
            div2.classList.add("active");
        } else if(percent >= 0.4 && div3.className != "active") {
            div3.classList.add("active");
        }     
    }
}

for(let i=0; i<change.length;i++) {
    change[i].addEventListener('click', showAndHide, false);
}