// TODO: create a way to delete tags
let addedTags = [];

// To remove tags
let destroyTags = document.querySelectorAll('.fa-solid.fa-x');

// queryselectors for tag creation
let createTagBtn = document.querySelector('#create-tag-btn');
let createTagInput = document.querySelector('#create-tag-input');

// tag display "through a div container" and submit input
let tagContainer = document.querySelector('#tag-cont');
let submitTagInput = document.querySelector('.submitted-tags-input');


function removeTags() {
    let allTags = document.querySelectorAll(".entry-tag");
    for (let tag of allTags) {
        tag.remove();
    }
}

function createTags() {
  for (let i =0; i<addedTags.length; i++) {
    let text = addedTags[i];
    let tagDisplay = document.createElement('div');
    let destroyTag = document.createElement('i');
    destroyTag.className = 'fa-solid fa-x';
    destroyTag.onclick = () => {
      addedTags.splice(i,1);
      removeTags();
      createTags();
    };
    
    tagDisplay.textContent = text;
    tagDisplay.classList.add("entry-tag");
    tagDisplay.prepend(destroyTag);
  
    tagContainer.appendChild(tagDisplay);
  }
  // format of the hidden input value
  //      seoul,delicious food,nice day
  submitTagInput.value = addedTags.join(",");
}

function handleAddTag() {
  let entryTagInput = document.querySelector('#create-tag-input');
  // array to check if the tags already exist
  let val = entryTagInput.value;
  if (val !== "" && !val.includes(",") && !addedTags.includes(val)){
    addedTags.push(entryTagInput.value);
    removeTags();
    createTags();
  }
  createTagInput.value = "";
}

createTagBtn.addEventListener('click',()=>{
  handleAddTag();
})

// TODO: add eventListener for Enter key "13" on the text input
createTagInput.addEventListener('keydown',(e)=>{
  if (e.key === "Enter"){
    e.preventDefault();
    handleAddTag();
  };
})


// display the selected image

const img_container = document.querySelector("#entry-upload-photo");
const image_input = document.querySelector("#imgUpload");
const image_label = document.querySelector(".entry-photo");

function handleImageSelect() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        // console.log("reader");
        const uploaded_image = reader.result;

        img_count++;
        if (img_count === 5) {
            image_label.remove();
        }
        if (img_count <= 5) {
            const img = document.createElement("div");
            img_container.appendChild(img);
            img.className = "chosenImg";
            img.style.backgroundImage = `url(${uploaded_image})`;
            const new_name = "imgUpload" + img_count;
            const clone_input = image_input.cloneNode(true);
            clone_input.value = "";
            clone_input.id = new_name;
            clone_input.setAttribute("name", new_name);
            clone_input.addEventListener("change", handleImageSelect);
            image_label.appendChild(clone_input);
            image_label.onclick = function () {
                document.getElementById(new_name).click();
            };
        } else {
            alert("reached max");
            return;
        }
    });
    reader.readAsDataURL(this.files[0]);
}

image_input.addEventListener("change", handleImageSelect);
