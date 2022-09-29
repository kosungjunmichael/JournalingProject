let blur = document.querySelector(".blur");
// let header = document.querySelector("header");
// console.log(header);

const openLogin = () => {
	document.getElementById("login").style.display = "block";
	blur.style.display = "block";
	blur.addEventListener("click", closeLogin);
	// header.innerHTML += "<script src='https://accounts.google.com/gsi/client' async defer></script>";
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

{
	/* <div class="google-btn">
	<div id='g_id_onload' data-client_id='<?= $_SERVER['CLIENT_ID']; ?>' data-login_uri='http://localhost/sites/JournalingProject/index.php?action=googleLogin' data-auto_prompt='false'></div>
	<div class='g_id_signin' data-type='standard' data-size='large' data-theme='outline' data-text='sign_in_with' data-shape='pill' data-logo_alignment='left'></div>
</div>

<div class="google-btn">
	<div id='g_id_onload' data-client_id='<?= $_SERVER['CLIENT_ID']; ?>' data-login_uri='http://localhost/sites/JournalingProject/index.php?action=googleSignUp' data-auto_prompt='false'></div><div class='g_id_signin' data-type='standard' data-size='large' data-theme='outline' data-text='signup_with' data-shape='pill' data-logo_alignment='left'></div>
</div> */
}
