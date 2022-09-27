let searchBar = document.querySelector('.search-bar');

function filterEntries(){
  let filterValue = searchBar.value;

  



}

searchBar.addEventListener('keydown',(e)=>{
  if (e.key === "Enter"){
    e.preventDefault();
    filterEntries()
  }
});