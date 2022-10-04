let album = document.querySelector("album");
let html = document.querySelector("html");
let overlay = document.querySelector(".overlay");
let modal = document.querySelector(".modal");
let modalContainer = document.querySelector(".modal-container");
modal.classList.add("slideshow-container");
let dotContainer = document.createElement("div");


let slideIndex = 2;

const openModal = pathsStr => { // use type to know which input to add the data to
    let paths = pathsStr.split(',');
    modal.innerHTML = "";
    for(let i=0; i<paths.length; i++){   
        dotContainer.innerHTML = "";
        let carouselDiv = document.createElement("div");
        let image = document.createElement("img");
        image.setAttribute("src", `./public/images/uploaded/${paths[i]}`);
        image.setAttribute("title", `Image ${i}`);
        image.classList.add("modal-image","slide");
        carouselDiv.appendChild(image);
        carouselDiv.classList.add("mySlides", "fade");
        modal.appendChild(carouselDiv);
        showSlides(slideIndex);
    }
    dotContainer.classList.add("dotContainer");
    modal.appendChild(dotContainer);

    for(let i=0; i<paths.length; i++){
        if(paths.length > 1 ){
            let dot = document.createElement("span");
            dot.classList.add("dot");
            // let dots = document.getElementsByClassName("dot");
            dotContainer.appendChild(dot);
            dot.setAttribute("onclick", `currentSlide(${i})`);
            showSlides(slideIndex);
        }
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

    // MODAL
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


// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);    
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n+1);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
        dots[slideIndex-1].classList.add("active");
    }
    slides[slideIndex-1].style.display = "block";
}
