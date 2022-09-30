// -----------------------------------------------------------------------------
// --------------------------------FILTERS--------------------------------------
// -----------------------------------------------------------------------------

// searchbar
let searchBar = document.querySelector('.search-bar');

let submitFilter = document.querySelector('.filter-btn');

// filter results container
let filterResults = document.querySelector('.filter-cont');

// array of all the filter results to be added
let addedFilters = [];

// entries display container
let entriesDisplay = document.querySelector('.entry-display');

function removeFilters(){
    let allFilters = document.querySelectorAll('.filter-tag');
    for (let filter of allFilters){
        filter.remove();
    }
}

function addFilters(){
    for (let i=0; i<addedFilters.length; i++){
        let text = addedFilters[i];
        let filterDisplay = document.createElement('div');

        let liTag = `
        <li>${tag}
            <svg class="create-entry-tag-close" onclick="remove(this, '${tag}')" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="#000000" viewBox="0 0 256 256">
                <rect width="256" height="256" fill="none"></rect>
                <circle class="close-svg-circle" cx="128" cy="128" r="96" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="16"></circle>
                <line class="close-svg-line" x1="160" y1="96" x2="96" y2="160" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                <line class="close-svg-line" x1="160" y1="160" x2="96" y2="96" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
            </svg>
        </li>`;

        // let destroyFilter = document.createElement('i');
        // destroyFilter.className = 'fa-solid fa-x';
        // destroyFilter.onclick = () => {
        // addedFilters.splice(i,1);
        // removeFilters();
        // addFilters();
        // }
        // filterDisplay.textContent = text;
        // filterDisplay.classList.add("filter-tag");
        // filterDisplay.prepend(destroyFilter);
        
        filterResults.appendChild(filterDisplay);
    }
    filtersString = addedFilters.join(',');
    let xhr = new XMLHttpRequest();
    xhr.open('GET',`http://localhost/sites/JournalingProject/index.php?action=filterEntries&filter=${filtersString}`)
    xhr.addEventListener('readystatechange',()=>{
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            // console.log(xhr.responseText);
            // console.log(entriesDisplay);
            entriesDisplay.innerHTML = xhr.responseText;
        } else if (xhr.readyState === XMLHttpRequest.DONE && xhr.status !== 200){
            console.log(`there's an error code: ${xhr.status} text: ${xhr.statusText}`);
        }
    })
    xhr.send();
}


function filterEntries(){
    let val = searchBar.value;
    // console.log(addedFilters);
    if (val !== "" && !val.includes(",") && !addedFilters.includes(val)){
        addedFilters.push(searchBar.value);
        removeFilters();
        addFilters();
    }
    searchBar.value = "";
}

searchBar.addEventListener('keydown',(e)=>{
    if (e.key === "Enter"){
        e.preventDefault();
        filterEntries()
    }
});

submitFilter.addEventListener('click',()=>{
    filterEntries()
})