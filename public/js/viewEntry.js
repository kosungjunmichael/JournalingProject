// -----------------------------------------------------------------------------
// --------------------------------DELETE ENTRY---------------------------------
// -----------------------------------------------------------------------------

let deleteEntry = document.querySelector("#delete-btn");

deleteEntry.addEventListener('click',()=>{
    console.log('something');
    let entryID = document.querySelector('.entryID');
    if (confirm("Do you want to delete this entry?")){
        deleteEntry.setAttribute('href', `index.php?action=deleteEntry&entryID=${entryID.textContent}`);
    }
})