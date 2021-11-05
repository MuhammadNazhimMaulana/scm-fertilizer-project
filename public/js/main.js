// Select Elemen
var toggle_btn;
var big_wrapper;
var hamburger_menu;

function deklarasi(){
    toggle_btn = document.querySelector(".toggle-btn");
    big_wrapper = document.querySelector(".big-wrapper");
    hamburger_menu = document.querySelector(".hamburger-menu");
}

const main = document.querySelector("main");

deklarasi();

let dark = false;

function toggleAnimation(){
   // Clone wrapper
   dark = !dark;
   let clone = big_wrapper.cloneNode(true);
   if(dark){
       clone.classList.remove("light");
       clone.classList.add("dark");
    }else{
       clone.classList.remove("dark");
       clone.classList.add("light");
   }
   clone.classList.add("copy");
   main.appendChild(clone);

   document.body.classList.add("stop-scroll");

   clone.addEventListener("animationend", () => {
       document.body.classList.remove("stop-scroll");
       big_wrapper.remove();
       clone.classList.remove("copy");
       //Reset Var
       deklarasi();    
       events();
   });
}

function events(){
    toggle_btn.addEventListener('click', toggleAnimation);
    hamburger_menu.addEventListener('click', () =>{
        big_wrapper.classList.toggle("active");
    });
}

events();