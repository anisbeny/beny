//navigation
const nav = document.querySelector("header");
let btn = document.querySelector(".burger");
btn.addEventListener("click", ()=>{
    nav.classList.toggle("show-nav");
})
// menu actif
var pageurl = location.href;
const links = document.querySelectorAll(".nav-link")
for (let link of links){
    if(link.href == pageurl){
        if (window.matchMedia("(min-width: 1024px)").matches) {
        link.style.borderBottom = "3px solid #E6CF4C";
        link.style.paddingBottom = "5px";
        }
    }  
}

