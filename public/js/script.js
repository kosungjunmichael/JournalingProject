// Dark Mode
let darkToggle = document.querySelector('#darkMode');

darkToggle.addEventListener('click', ()=> {
    document.body.classList.toggle('dark');
})
// This is js stuff
  function handleCredentialResponse(response) {
    console.log(JSON.parse(atob(response.credential.split('.')[1])))
  }
  
