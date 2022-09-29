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

// TODO: Add login redirect to signup card
// document.getElementById("login-link").addEventListener("click", () => {
// 	closeSignup();
// 	openLogin();
// });


	/* <div class="google-btn">
	<div id='g_id_onload' data-client_id='<?= $_SERVER['CLIENT_ID']; ?>' data-login_uri='http://localhost/sites/JournalingProject/index.php?action=googleLogin' data-auto_prompt='false'></div>
	<div class='g_id_signin' data-type='standard' data-size='large' data-theme='outline' data-text='sign_in_with' data-shape='pill' data-logo_alignment='left'></div>
</div>

<div class="google-btn">
	<div id='g_id_onload' data-client_id='<?= $_SERVER['CLIENT_ID']; ?>' data-login_uri='http://localhost/sites/JournalingProject/index.php?action=googleSignUp' data-auto_prompt='false'></div><div class='g_id_signin' data-type='standard' data-size='large' data-theme='outline' data-text='signup_with' data-shape='pill' data-logo_alignment='left'></div>
</div> */
