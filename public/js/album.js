let album = document.querySelector("album");
let html = document.querySelector("html");
let overlay = document.querySelector(".overlay");
let modal = document.querySelector(".modal");
let modalContainer = document.querySelector(".modal-container");

const openModal = type => { // use type to know which input to add the data to
    currentlyModifying = type;
    overlay.classList.toggle("display-none");
    modal.classList.toggle("display-none");
    modalContainer.classList.toggle("display-none");
    html.style.overflow = "hidden";
}

const closeModal = function(){
    overlay.classList.toggle("display-none");
    modal.classList.toggle("display-none");
    modalContainer.classList.toggle("display-none");
    html.style.overflow = "visible";
}


// carousel
