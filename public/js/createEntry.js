// TODO: create a way to delete tags
let addedTags = [];

let destroyTags = document.querySelectorAll('.fa-solid.fa-x');

// queryselectors for tag creation
let createTagBtn = document.querySelector('#create-tag-btn');
let createTagInput = document.querySelector('#create-tag-input');

// queryselectors for display and submitted tags
let tagContainer = document.querySelector('#tag-cont');
let submitTagInput = document.querySelector('.submitted-tags-input');


function removeTags() {
  let allTags = document.querySelectorAll('.entry-tag');
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




