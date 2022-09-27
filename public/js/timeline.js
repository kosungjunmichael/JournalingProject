// searchbar
let searchBar = document.querySelector('.search-bar');

// filter results container
let filterResults = document.querySelector('.filter-cont');

// array of all the filter results to be added
let addedFilters = [];

function removeFilters(){
  let allFilters = document.querySelectorAll('.filter-tags');
  for (let entry of allFilters){
    entry.remove();
  }
}

function addFilters(){
  for (let i=0;i<addedFilters.length;i++){
    let filterText = addedFilters[i];
    let filterDisplay = document.createElement('div');
    let destroyFilter = document.createElement('i');
    destroyFilter.className = 'fa-solid fa-x';
    destroyFilter.onclick = ()=>{
      addedFilters.splice(i,1);
      removeFilters();
      addFilters();
    }
    filterDisplay.textContent = filterText;
    filterDisplay.classList.add("filter-tag");
    filterDisplay.prepend(destroyFilter);
    
    filterResults.appendChild(filterDisplay);
  }

}


function filterEntries(){
  let val = searchBar.value;

  if (val === "" && !val.includes(",") && !addedResults.includes(val)){
    addedResults.push(val);
    removeEntries();
    addEntries();
  }
}

searchBar.addEventListener('keydown',(e)=>{
  if (e.key === "Enter"){
    e.preventDefault();
    filterEntries()
  }
});