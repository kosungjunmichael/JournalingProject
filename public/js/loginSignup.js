let blur = document.querySelector(".blur");
import addGoogleLogin from './googleButtons.js';
import removeGoogleLogin from './googleButtons.js';
import addGoogleSignup from './googleButtons.js';
import removeGoogleSignup from './googleButtons.js';

const openLogin = () => {
	document.getElementById("login").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeLogin);

	addGoogleLogin();
};

const openSignup = () => {
	document.getElementById("signup").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeSignup);

	addGoogleSignup();
};

const closeLogin = () => {
	document.getElementById("login").style.display = "none";
	document.querySelector(".blur").style.display = "none";
	blur.removeEventListener("click", closeLogin);


	removeGoogleLogin();
};

const closeSignup = () => {
	document.querySelector(".blur").style.display = "none";
	document.getElementById("signup").style.display = "none";
	blur.removeEventListener("click", closeSignup);

	removeGoogleSignup();
};

document.querySelector("#close").addEventListener("click", closeLogin);
document.querySelector("#close1").addEventListener("click", closeSignup);
document.querySelector(".btn").addEventListener("click", openLogin);
document.querySelector(".btn1").addEventListener("click", openSignup);

document.getElementById("sign-up-link").addEventListener("click", () => {
	closeLogin();
	openSignup();
});

document.getElementById("sign-in-link").addEventListener("click", () => {
	closeSignup();
	openLogin();
});
