// theme toggle event listener
let themeToggle = document.querySelector(".theme-toggle-pill");
let themeInner = document.querySelector(".theme-toggle-inner");
let themeInput = document.querySelector("#theme-toggle-input");
let hamInput = document.querySelector("#ham-toggle-input");

// get and set theme
const theme = localStorage.getItem("dear_diary_theme");
// console.log(theme);
if (theme === null) {
    // set data-theme to light as default
    document.body.setAttribute("data-theme", "light");
} else if (theme !== null) {
    document.body.setAttribute("data-theme", theme);
    // move toggle if checked
    // if (themeInput.getAttribute('checked')) {
    if (theme === "dark") {
        themeInput.setAttribute("checked", true);
        themeInner.classList.toggle("toggle-to-right");
    }
}


const themeChangeListener = () => {
    // move (translate) theme-toggle-inner
    themeInner.classList.toggle("toggle-to-right");
    const currentTheme = document.body.getAttribute("data-theme");
    // set theme in localStorage
    // set data-theme attribute of HTML body element
    if (currentTheme === "light") {
        localStorage.setItem("dear_diary_theme", "dark");
        document.body.setAttribute("data-theme", "dark");
    } else if (currentTheme === "dark") {
        localStorage.setItem("dear_diary_theme", "light");
        document.body.setAttribute("data-theme", "light");
    }
}

themeInput.addEventListener("change", themeChangeListener);
hamInput.addEventListener("change", themeChangeListener);
