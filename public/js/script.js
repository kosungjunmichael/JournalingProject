// theme toggle event listener
let themeToggle = document.querySelector('#theme-toggle-pill');
let themeInner = document.querySelector('#theme-toggle-inner');
let themeInput = document.querySelector('#theme-toggle-input');
let img_count = 0;

// get and set theme
const theme = localStorage.getItem("dear_diary_theme");
console.log(theme);
if (theme === null) {
    // set data-theme to light as default
    document.body.setAttribute('data-theme', 'light');
} else if (theme !== null) {
    document.body.setAttribute('data-theme', theme);
    // move toggle if checked
    // if (themeInput.getAttribute('checked')) {
    if (theme === 'dark') {
        themeInput.setAttribute('checked', true);
        themeInner.classList.toggle('toggle-to-right');
    }
}

const themeChangeListener = () => {
    // move (translate) theme-toggle-inner
    themeInner.classList.toggle('toggle-to-right');
    const currentTheme = document.body.getAttribute('data-theme');
    // set theme in localStorage
    // set data-theme attribute of HTML body element
    if (currentTheme === 'light') {
        localStorage.setItem("dear_diary_theme", 'dark')
        document.body.setAttribute('data-theme', 'dark');

    } else if (currentTheme === 'dark') {
        localStorage.setItem("dear_diary_theme", 'light')
        document.body.setAttribute('data-theme', 'light');
    }
}

themeInput.addEventListener('change', themeChangeListener);

// display the selected image

function handleImageSelect() {
    const reader = new FileReader();
    reader.addEventListener('load',()=>{
        console.log('reader');
        const uploaded_image = reader.result;

        const img = document.createElement('div');
        img_container.appendChild(img);
        img.className = "chosenImg";
        img.style.backgroundImage = `url(${uploaded_image})`;

        img_count++;
        const new_name = "imgUpload" + img_count;
        const clone_input = image_input.cloneNode(true);
        clone_input.value = "";
        clone_input.id = new_name;
        clone_input.setAttribute("name",new_name);
        clone_input.addEventListener("change", handleImageSelect);
        image_label.appendChild(clone_input);
        // image_label.setAttribute("onclick",`document.getElementById(${new_name}).click();`);
        image_label.onclick = function() {
            document.getElementById(new_name).click();
        }
        // document.querySelector('.entry-photo')

    });
    reader.readAsDataURL(this.files[0]);
}

const img_container = document.querySelector(".entry-upload-photo");
const image_input = document.querySelector("#imgUpload");
const image_label = document.querySelector(".entry-photo");
image_input.addEventListener("change", handleImageSelect);




