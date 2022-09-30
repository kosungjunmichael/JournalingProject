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
        let destroyFilter = document.createElement('i');
        destroyFilter.className = 'fa-solid fa-x';
        destroyFilter.onclick = () => {
        addedFilters.splice(i,1);
        removeFilters();
        addFilters();
        }
        filterDisplay.textContent = text;
        filterDisplay.classList.add("filter-tag");
        filterDisplay.prepend(destroyFilter);
        
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