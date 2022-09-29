let blur = document.querySelector(".blur");

const openLogin = () => {
	document.getElementById("login").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeLogin);
};

const openSignup = () => {
	document.getElementById("signup").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeSignup);
};

const closeLogin = () => {
	document.getElementById("login").style.display = "none";
	document.querySelector(".blur").style.display = "none";
	blur.removeEventListener("click", closeLogin);
};

const closeSignup = () => {
	document.querySelector(".blur").style.display = "none";
	document.getElementById("signup").style.display = "none";
	blur.removeEventListener("click", closeSignup);
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
