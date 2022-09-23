// TODO: create a way to delete tags
let addedTags = [];

let destroyTags = document.querySelectorAll('.fa-solid.fa-x');
// queryselector for the + button in the tag input
let entryTagBtn = document.querySelector('#create-entry-tag-btn');
// queryselector for the text input of tag to be submitted
// query selector for the div containing all the displayed tags
let entryTagContainer = document.querySelector('#entry-tag-cont');
let tagInput = document.querySelector('.entry-tag-input');

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
  
    entryTagContainer.appendChild(tagDisplay);
  }
  // format of the hidden input value
  //      seoul,delicious food,nice day
  tagInput.value = addedTags.join(",");
}

function handleAddTag() {
  let entryTagInput = document.querySelector('#create-entry-tag-input');
  // array to check if the tags already exist
  let val = entryTagInput.value;
  if (val !== "" && !val.includes(",") && !addedTags.includes(val)){
    addedTags.push(entryTagInput.value);
    removeTags();
    createTags();
  }

}

entryTagBtn.addEventListener('click',()=>{
  handleAddTag();
})
// TODO: add eventListener for Enter key "13" on the text input
entryTagBtn.addEventListener('keydown',()=>{
  handleAddTag();
})




