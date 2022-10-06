// -----------------------------------------------------------------------------
// --------------------------------FILTERS--------------------------------------
// -----------------------------------------------------------------------------

// searchbar
let searchBar = document.querySelector('.search-bar');

// filter button
let submitFilter = document.querySelector('.filter-btn');

// filter results container
let filterResults = document.querySelector('.filter-cont');

// remove all filters
let deleteFiltersBtn = document.querySelector('.filter-remove-all');

// array of all the filter results to be added
let addedFilters = [];

// monthly and weekly switch
let timeSwitch = document.querySelectorAll('.display-tag');

//                  filter switches
let switches = document.querySelectorAll('.switch');

var filterValues = ['tags'];

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
        let filterDisplay = document.createElement('li');

        let destroyFilter = document.createElement('i');
        destroyFilter.xmlns="http://www.w3.org/2000/svg"
        destroyFilter.className = 'fa-solid fa-x';

        destroyFilter.onclick = () => {
        addedFilters.splice(i,1);
        removeFilters();
        addFilters();
        }
        filterDisplay.textContent = text;
        filterDisplay.classList.add("filter-tag");
        filterDisplay.append(destroyFilter);
        
        filterResults.appendChild(filterDisplay);
    }
    // filters
    filtersString = addedFilters.join(',');
    // filterValues
    value = Object.values(filterValues).join(',');
    // Monthly/ Weekly
    timeSwitch.forEach(element => {
        if (element.classList.contains('switch-active')){
            group = element.textContent;
        }
    });
    let xhr = new XMLHttpRequest();
    xhr.open('GET',`http://localhost/sites/JournalingProject/index.php?action=filterEntries&filter=${filtersString}&value=${value}&group=${group}`)
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
    
    if (val !== "" && !val.includes(",") && !addedFilters.includes(val) && searchBar.value.length > 1){
        addedFilters.push(searchBar.value);
        removeFilters();
        addFilters();
    }
    searchBar.value = "";
}

searchBar.addEventListener('keyup',(e)=>{
    if (e.key === "Enter"){
        e.preventDefault();
        filterEntries(filterValues)
    }
});


deleteFiltersBtn.addEventListener('click',()=>{
    addedFilters = [];
    removeFilters();
    addFilters();
})


submitFilter.addEventListener('click',()=>{
    filterEntries()
})

// FILTER SWITCH VALUES
switches.forEach(eachSwitch => {
    eachSwitch.addEventListener('click',(e)=>{
        checkArr = [];
        switches.forEach(test => {
            if (e.target !== test && test['className'].includes('switch-active')){
                checkArr.push(0);
            }
        });
        
        if (checkArr.some((el) => el === 0)){
            e.target.classList.toggle("switch-active");
        }

        returnArr = [];
        switches.forEach(check => {
            if (check['className'].includes('switch-active')){
                returnArr.push(check.innerHTML);
            }
        });
        if (returnArr.find(el => el === "Titles")){
            returnArr.splice(returnArr.indexOf('Titles'),1,"title");
        }
        if (returnArr.find(el => el === "Entries")){
            returnArr.splice(returnArr.indexOf('Entries'),1,"text_content");
        }
        if (returnArr.find(el => el === "Tags")){
            returnArr.push(returnArr.shift());
            returnArr.splice(returnArr.indexOf('Tags'),1,"tags");
        }
        filterValues = returnArr;
    });
});
