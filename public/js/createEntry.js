// TODO: create a way to delete tags
let addedTags = [];

// To remove tags
let destroyTags = document.querySelectorAll(".fa-solid.fa-x");

// queryselectors for tag creation
let createTagBtn = document.querySelector("#create-tag-btn");
let createTagInput = document.querySelector("#create-tag-input");

// tag display "through a div container" and submit input
let tagContainer = document.querySelector("#tag-cont");
let submitTagInput = document.querySelector(".submitted-tags-input");

// -----------------------------------------------------------------------------
// --------------------------------TAGS-----------------------------------------
// -----------------------------------------------------------------------------

const removeTags = () => {
	let allTags = document.querySelectorAll(".entry-tag");
	for (let tag of allTags) {
		tag.remove();
	}
};

const createTags = () => {
	for (let i = 0; i < addedTags.length; i++) {
		let text = addedTags[i];
		let tagDisplay = document.createElement("div");
		let destroyTag = document.createElement("i");
		destroyTag.className = "fa-solid fa-x";
		destroyTag.onclick = () => {
			addedTags.splice(i, 1);
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
};

const handleAddTag = () => {
	let entryTagInput = document.querySelector("#create-tag-input");
	// array to check if the tags already exist
	let val = entryTagInput.value;
	if (val !== "" && !val.includes(",") && !addedTags.includes(val)) {
		addedTags.push(entryTagInput.value);
		removeTags();
		createTags();
	}
	createTagInput.value = "";
};

createTagBtn.addEventListener("click", () => {
	handleAddTag();
});

// TODO: add eventListener for Enter key "13" on the text input
createTagInput.addEventListener("keydown", (e) => {
	if (e.key === "Enter") {
		e.preventDefault();
		handleAddTag();
	}
});

// -----------------------------------------------------------------------------
// --------------------------------IMAGES---------------------------------------
// -----------------------------------------------------------------------------

const img_container = document.querySelector("#entry-upload-photo");
const image_input = document.querySelector("#imgUpload");
const image_label = document.querySelector(".entry-photo");
let img_count = 0;

function handleImageSelect() {
	const reader = new FileReader();
	reader.addEventListener("load", () => {
		const uploaded_image = reader.result;

		img_count++;
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
		}

		if (img_count === 5) {
			image_label.style.display = "none";
		}
	});
	reader.readAsDataURL(this.files[0]);
}

image_input.addEventListener("change", handleImageSelect);




// -----------------------------------------------------------------------------
// --------------------------------EDIT TOOLBAR---------------------------------------
// -----------------------------------------------------------------------------

let optionsButtons = document.querySelectorAll(".option-button");
let advancedOptionButton = document.querySelectorAll(".adv-option-button");
let fontName = document.getElementById("fontName");
let fontSizeRef = document.getElementById("fontSize");
let writingArea = document.getElementById("text-input");
// let linkButton = document.getElementById("createLink");
let alignButtons = document.querySelectorAll(".align");
let spacingButtons = document.querySelectorAll(".spacing");
let formatButtons = document.querySelectorAll(".format");
// let scriptButtons = document.querySelectorAll(".script");
let submitButton = document.getElementById("")

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
  //No highlights for link, unlink,lists, undo,redo since they are one time operations
  highlighter(alignButtons, true);
  highlighter(spacingButtons, true);
  highlighter(formatButtons, false);
  // highlighter(scriptButtons, true);

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

// //link
// linkButton.addEventListener("click", () => {
//   let userLink = prompt("Enter a URL");
//   //if link has http then pass directly else add https
//   if (/http/i.test(userLink)) {
//     modifyText(linkButton.id, false, userLink);
//   } else {
//     userLink = "http://" + userLink;
//     modifyText(linkButton.id, false, userLink);
//   }
// });

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
let hidden_text = document.getElementById('hidden-text');

submit.addEventListener('click', (e) => {
  // console.log("hi");
  hidden_text.value = input_text.innerHTML;
  console.log(hidden_text.value);
  // e.preventDefault();
})