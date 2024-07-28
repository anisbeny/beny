// désactiver le lien tel pour les formats tablette et desktop

var calls = document.querySelectorAll("a[href^='tel']");
if (window.matchMedia("(min-width: 768px)").matches){
    for(let call of calls){
        call.removeAttribute('href');
    }
}



