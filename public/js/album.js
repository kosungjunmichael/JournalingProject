let album = document.querySelector("album");
let html = document.querySelector("html");
let overlay = document.querySelector(".overlay");
let modal = document.querySelector(".modal");
let modalContainer = document.querySelector(".modal-container");
modal.classList.add("slideshow-container");




const openModal = pathsStr => { // use type to know which input to add the data to
    // let dotDiv = document.createElement("div");
    let paths = pathsStr.split(',');
    // console.log(paths);
    modal.innerHTML = "";
    for(let i=0; i<paths.length; i++)
    {   
        let carouselDiv = document.createElement("div");
        let image = document.createElement("img");
        image.setAttribute("src", `./${paths[i]}`);
        image.setAttribute("title", `Image ${i}`);
        image.classList.add("modal-image","slide");
        carouselDiv.appendChild(image);
        carouselDiv.classList.add("mySlides", "fade");
        modal.appendChild(carouselDiv);

        // //dots 

        // let dot = document.createElement("span");
        // dot.classList.add("dot");
        // modal.appendChild(dot);
        // dot.setAttribute("onclick", `currentSlide(${i})`);
        // dot.style.textAlign = "center";
        // let dots = document.getElementsByClassName("dot");

        // for (i = 0; i < dots.length; i++) {
        //     dots[i].className = dots[i].className.replace(" active", "");
        // }
        // dots[slideIndex-1].className += " active";

    }

    // Carousel
    let arrowRight = document.createElement("a");
    arrowRight.classList.add("nav-arrow","next", "right");
    arrowRight.setAttribute("onclick", "plusSlides(1)");


    let arrowLeft = document.createElement("a");
    arrowLeft.classList.add("nav-arrow","previous", "left");
    arrowLeft.setAttribute("onclick", "plusSlides(-1)");

    if (paths.length > 1){
    modal.appendChild(arrowLeft);
    modal.appendChild(arrowRight);
    }


    
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

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    // let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    // for (i = 0; i < dots.length; i++) {
    //     dots[i].className = dots[i].className.replace(" active", "");
    // }
    slides[slideIndex-1].style.display = "block";
    // dots[slideIndex-1].className += " active";
}

