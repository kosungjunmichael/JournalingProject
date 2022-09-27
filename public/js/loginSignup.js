// function login() {
// }
let blur = document.querySelector(".blur");

function openLogin() {
	document.getElementById("login").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeLogin);
}

function openSignup() {
	document.getElementById("signup").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeSignup);
}

function closeLogin() {
	document.getElementById("login").style.display = "none";
	document.querySelector(".blur").style.display = "none";
	blur.removeEventListener("click", closeLogin);
}

function closeSignup() {
	document.querySelector(".blur").style.display = "none";
	document.getElementById("signup").style.display = "none";
	blur.removeEventListener("click", closeSignup);
}

document.querySelector("#close").addEventListener("click", closeLogin);
document.querySelector("#close1").addEventListener("click", closeSignup);
document.querySelector(".btn").addEventListener("click", openLogin);
document.querySelector(".btn1").addEventListener("click", openSignup);

document.getElementById("sign-up-link").addEventListener("click", () => {
	closeLogin();
	openSignup();
});

// var myInput = document.getElementById("psw");
// var letter = document.getElementById("letter");
// var capital = document.getElementById("capital");
// var number = document.getElementById("number");
// var length = document.getElementById("length");

// // When the user clicks on the password field, show the message box
// myInput.onfocus = function() {
//     document.getElementById("message").style.display = "block";
// }

// // When the user clicks outside of the password field, hide the message box
// myInput.onblur = function() {
//     document.getElementById("message").style.display = "none";
// }

// // When the user starts to type something inside the password field
// myInput.onkeyup = function() {
//     // Validate lowercase letters
//     var lowerCaseLetters = /[a-z]/g;
//     if(myInput.value.match(lowerCaseLetters)) {
//         letter.classList.remove("invalid");
//         letter.classList.add("valid");
//     } else {
//         letter.classList.remove("valid");
//         letter.classList.add("invalid");
//     }

//     var upperCaseLetters = /[A-Z]/g;
//     if(myInput.value.match(upperCaseLetters)) {
//         capital.classList.remove("invalid");
//         capital.classList.add("valid");
//     } else {
//         capital.classList.remove("valid");
//         capital.classList.add("invalid");
//     }

//     // Validate numbers
//     var numbers = /[0-9]/g;
//     if(myInput.value.match(numbers)) {
//         number.classList.remove("invalid");
//         number.classList.add("valid");
//     } else {
//         number.classList.remove("valid");
//         number.classList.add("invalid");
//     }

//     // Validate length
//     if(myInput.value.length >= 8) {
//         length.classList.remove("invalid");
//         length.classList.add("valid");
//     } else {
//         length.classList.remove("valid");
//         length.classList.add("invalid");
//     }
// }
