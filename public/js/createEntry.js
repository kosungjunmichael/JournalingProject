// TODO: create a way to delete tags
// let addedTags = [];
//
// // To remove tags
// let destroyTags = document.querySelectorAll(".fa-solid.fa-x");
//
// // queryselectors for tag creation
// let createTagBtn = document.querySelector("#create-tag-btn");
// let createTagInput = document.querySelector("#create-tag-input");
//
// // tag display "through a div container" and submit input
// let tagContainer = document.querySelector("#tag-cont");
// let submitTagInput = document.querySelector(".submitted-tags-input");
//
// // -----------------------------------------------------------------------------
// // --------------------------------TAGS-----------------------------------------
// // -----------------------------------------------------------------------------
//
// const removeTags = () => {
// 	let allTags = document.querySelectorAll(".entry-tag");
// 	for (let tag of allTags) {
// 		tag.remove();
// 	}
// };
//
// const createTags = () => {
// 	for (let i = 0; i < addedTags.length; i++) {
// 		let text = addedTags[i];
// 		let tagDisplay = document.createElement("div");
// 		let destroyTag = document.createElement("i");
// 		destroyTag.className = "fa-solid fa-x";
// 		destroyTag.onclick = () => {
// 			addedTags.splice(i, 1);
// 			removeTags();
// 			createTags();
// 		};
//
// 		tagDisplay.textContent = text;
// 		tagDisplay.classList.add("entry-tag");
// 		tagDisplay.prepend(destroyTag);
//
// 		tagContainer.appendChild(tagDisplay);
// 	}
// 	// format of the hidden input value
// 	//      seoul,delicious food,nice day
// 	submitTagInput.value = addedTags.join(",");
// };
//
// const handleAddTag = () => {
// 	let entryTagInput = document.querySelector("#create-tag-input");
// 	// array to check if the tags already exist
// 	let val = entryTagInput.value;
// 	if (val !== "" && !val.includes(",") && !addedTags.includes(val)) {
// 		addedTags.push(entryTagInput.value);
// 		removeTags();
// 		createTags();
// 	}
// 	createTagInput.value = "";
// };
//
// createTagBtn.addEventListener("click", () => {
// 	handleAddTag();
// });
//
// // TODO: add eventListener for Enter key "13" on the text input
// createTagInput.addEventListener("keydown", (e) => {
// 	if (e.key === "Enter") {
// 		e.preventDefault();
// 		handleAddTag();
// 	}
// });

const ul = document.querySelector("#create-entry-tag-input-ul"),
	input = document.querySelector("#create-entry-tag-input"),
	tagNum = document.querySelector("#create-entry-tag-details #create-entry-tag-details-tagnum"),
	hiddenInput = document.querySelector("#create-entry-tags-hidden");
let maxTags = 5,
	tags = [];
countTags();
createTag();

function countTags(){
	tagNum.innerText = maxTags - tags.length;
}

function createTag(){
	// remove all tags
	ul.querySelectorAll("li").forEach(li => li.remove());
	// recreate tags
	tags.slice().reverse().forEach(tag =>{
		let liTag = `
        <li>${tag}
            <svg class="create-entry-tag-close" onclick="remove(this, '${tag}')" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="#000000" viewBox="0 0 256 256">
                <rect width="256" height="256" fill="none"></rect>
                <circle class="close-svg-circle" cx="128" cy="128" r="96" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="16"></circle>
                <line class="close-svg-line" x1="160" y1="96" x2="96" y2="160" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                <line class="close-svg-line" x1="160" y1="160" x2="96" y2="96" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
            </svg>
        </li>`;
		// insert tag
		ul.insertAdjacentHTML("afterbegin", liTag);
        // ul.appendChild(liTag);
	});
	// count tags
	countTags();
}

// remove single tag
function remove(element, tag){
	// get index of tag in tags array
	let index  = tags.indexOf(tag);
	// update tags array
	tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    // tags.splice(index, 1); // *NOTE essentially the same as the line above
	// remove tag
	element.parentElement.remove();
	// update tags hidden input value
	const tagsVal = tags.join(',');
	hiddenInput.value = tagsVal;
	// count tags
	countTags();
}

function addTag(e){
	// on "Enter", push to tags array and create hmtl Tag element
	if(e.key === "Enter"){
		// handle white spacing, multiple to one
		let tag = e.target.value.replace(/\s+/g, ' ');
		if(tag.length > 1 && !tags.includes(tag)){
			if(tags.length < 5){
				tag.split(',').forEach(tag => {
					// add tag to tags array
					tags.push(tag);
					// create the html tag
					createTag();
					// update tags hidden input value
					const tagsVal = tags.join(',');
					hiddenInput.value = tagsVal;
					console.log(hiddenInput.value);
				});
			}
		}
		// reset input value to blank
		e.target.value = "";
	}
}

// add tag on keyup (enter)
input.addEventListener("keyup", addTag);

// remove all tags on button click,
const removeBtn = document.querySelector("#create-entry-tag-details #tag-remove-btn");
removeBtn.addEventListener("click", () =>{
	tags.length = 0;
	ul.querySelectorAll("li").forEach(li => li.remove());
	// update count
	countTags();
});

// prevent form submit on 'Enter' key, for inputs and selects
const inputs = document.querySelectorAll('input');
const select = document.querySelector('select');

for (let input of inputs) {
	input.addEventListener('keydown', (e) => {
		if(e.key === 'Enter'){
			e.preventDefault();
			return false;
		}
	})
}

select.addEventListener('keydown', (e) => {
    if(e.key === 'Enter'){
        e.preventDefault();
		return false;
	}
})

// -----------------------------------------------------------------------------
// --------------------------------IMAGES---------------------------------------
// -----------------------------------------------------------------------------

const img_container = document.querySelector("#entry-upload-photo");
const image_input = document.querySelector("#imgUpload");
const image_label = document.querySelector(".entry-photo");
let img_count = 0;
let countUp = 0;

function handleImageSelect() {
	const reader = new FileReader();
	reader.addEventListener("load", () => {
		const uploaded_image = reader.result;

		img_count++;
		if (img_count <= 5) {
			const img = document.createElement("div");
			img_container.appendChild(img);
			img.style.backgroundImage = `url(${uploaded_image})`;
			const old_name = countUp === 0 ? "imgUpload" : "imgUpload" + countUp;
			countUp++;
			const new_name = "imgUpload" + countUp;
			img.className = `chosenImg ${new_name}`;
			const clone_input = image_input.cloneNode(true);
			clone_input.value = "";
			clone_input.id = new_name;
			clone_input.setAttribute("name", new_name);
			clone_input.addEventListener("change", handleImageSelect);
			image_label.appendChild(clone_input);
			image_label.onclick = function () {
				document.getElementById(new_name).click();
			};
			let remove = document.createElement("i");
			remove.className = "fa-solid fa-x";
			remove.onclick = () => {
				document.getElementById(old_name).remove();
				document.querySelector(`.${new_name}`).remove();
				img_count--;
				if (img_count < 5) {
					image_label.style.display = "block";
				}
			}
			img.appendChild(remove);
		}

		if (img_count === 5) {
			image_label.style.display = "none";
		}
	});
	reader.readAsDataURL(this.files[0]);
}

image_input.addEventListener("change", handleImageSelect);

// -----------------------------------------------------------------------------
// --------------------------------EDIT TOOLBAR---------------------------------
// -----------------------------------------------------------------------------

let optionsButtons = document.querySelectorAll(".option-button");
let advancedOptionButton = document.querySelectorAll(".adv-option-button");
let fontName = document.getElementById("fontName");
let fontSizeRef = document.getElementById("fontSize");
let writingArea = document.getElementById("text-input");
let alignButtons = document.querySelectorAll(".align");
let spacingButtons = document.querySelectorAll(".spacing");
let formatButtons = document.querySelectorAll(".format");

//List of fontlist
let fontList = [
  "Arial",
  "Verdana",
  "Times New Roman",
  "Garamond",
  "Georgia",
  "Courier New",
  "cursive",
];

//Initial Settings
const initializer = () => {
  //function calls for highlighting buttons
  //No highlights for lists since they are one time operations
  highlighter(alignButtons, true);
  highlighter(spacingButtons, true);
  highlighter(formatButtons, false);

  //create options for font names
  fontList.map((value) => {
    let option = document.createElement("option");
    option.value = value;
    option.innerHTML = value;
    fontName.appendChild(option);
  });

  //fontSize allows only till 7
  for (let i = 1; i <= 7; i++) {
    let option = document.createElement("option");
    option.value = i;
    option.innerHTML = i;
    fontSizeRef.appendChild(option);
  }

  //default size
  fontSizeRef.value = 3;
};

//main logic
const modifyText = (command, defaultUi, value) => {
  //execCommand executes command on selected text
  document.execCommand(command, defaultUi, value);
};

//For basic operations which don't need value parameter
optionsButtons.forEach((button) => {
  button.addEventListener("click", () => {
    modifyText(button.id, false, null);
  });
});

//options that require value parameter (e.g colors, fonts)
advancedOptionButton.forEach((button) => {
  button.addEventListener("change", () => {
    modifyText(button.id, false, button.value);
  });
});

//Highlight clicked button
const highlighter = (className, needsRemoval) => {
  className.forEach((button) => {
    button.addEventListener("click", () => {
      //needsRemoval = true means only one button should be highlight and other would be normal
      if (needsRemoval) {
        let alreadyActive = false;

        //If currently clicked button is already active
        if (button.classList.contains("active")) {
          alreadyActive = true;
        }

        //Remove highlight from other buttons
        highlighterRemover(className);
        if (!alreadyActive) {
          //highlight clicked button
          button.classList.add("active");
        }
      } else {
        //if other buttons can be highlighted
        button.classList.toggle("active");
      }
    });
  });
};

const highlighterRemover = (className) => {
  className.forEach((button) => {
    button.classList.remove("active");
  });
};

window.onload = initializer();

let submit = document.getElementById('submit');
let input_text = document.getElementById('input-text');
let hidden_text = document.getElementById('text-content-textarea');

submit.addEventListener('click', (e) => {	
  hidden_text.value = input_text.innerHTML;
  console.log(hidden_text.value);
})

// -----------------------------------------------------------------------------
// --------------------------------SUBMIT---------------------------------
// -----------------------------------------------------------------------------

// Prevents the form to be refreshed if the title or entry is missing
let title = document.getElementById('create-entry-title-input');
let form = document.getElementById('create-entry-form');

form.addEventListener('submit', e => {
	if (title.value === '' || title.value === null ) {
		e.preventDefault();
		alert('Please enter a title.');
	} else if(hidden_text.value === '' || hidden_text.value === null) {
		e.preventDefault();
		// alert('Please write an entry.');
	
	} else {
		return true;
	}
});