// === Toggle to show password ===
// Sign up
const togglePsw = document.getElementById("su-pwd-show");
const pswToggle = document.querySelector(".input-container i#togglePsw");
const su_pwd = document.getElementById("sign-p");

togglePsw.addEventListener("click", () => {
	if (pswToggle.classList.contains("fa-eye")) {
		pswToggle.classList.remove("fa-eye");
		pswToggle.classList.add("fa-eye-slash");
	} else {
		pswToggle.classList.remove("fa-eye-slash");
		pswToggle.classList.add("fa-eye");
	}
	const type = su_pwd.getAttribute("type") === "password" ? "text" : "password";
	su_pwd.setAttribute("type", type);
	togglePsw.innerHTML = "";
	togglePsw.appendChild(pswToggle);
});

const togglePsw2 = document.getElementById("su-pwd2-show");
const pwd2Toggle = document.querySelector(".input-container i#togglePsw2");
const su_pwd2 = document.getElementById("sign-cp");

togglePsw2.addEventListener("click", () => {
	if (pwd2Toggle.classList.contains("fa-eye")) {
		pwd2Toggle.classList.remove("fa-eye");
		pwd2Toggle.classList.add("fa-eye-slash");
	} else {
		pwd2Toggle.classList.remove("fa-eye-slash");
		pwd2Toggle.classList.add("fa-eye");
	}
	const type2 =
		su_pwd2.getAttribute("type") === "password" ? "text" : "password";
	su_pwd2.setAttribute("type", type2);
	togglePsw2.innerHTML = "";
	togglePsw2.appendChild(pwd2Toggle);
});

// Login
const togglePswSi = document.getElementById("si-pwd-show");
const pswSiToggle = document.querySelector(".input-container i#togglePswSi");
const si_pwd = document.getElementById("login-p");

togglePswSi.addEventListener("click", () => {
	if (pswSiToggle.classList.contains("fa-eye")) {
		pswSiToggle.classList.remove("fa-eye");
		pswSiToggle.classList.add("fa-eye-slash");
	} else {
		pswSiToggle.classList.remove("fa-eye-slash");
		pswSiToggle.classList.add("fa-eye");
	}
	const typeSi =
		si_pwd.getAttribute("type") === "password" ? "text" : "password";
	si_pwd.setAttribute("type", typeSi);
	togglePswSi.innerHTML = "";
	togglePswSi.appendChild(pswSiToggle);
});

// ==== Regex ====
var regName = /^[a-zA-Z0-9]{4,}/;
var regMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var regPsw = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

// === Validate Username ===

let user = document.getElementById("sign-u");
let error_user = document.getElementById("tooltip-u");

const checkUser = () => {
	if (regName.test(user.value)) {
		error_user.style.display = "none";
		return true;
	} else {
		error_user.style.display = "block";
		return false;
	}
}

// === Validate E-mail ===

let mail = document.getElementById("sign-e");
let error_mail = document.getElementById("tooltip-e");

const checkMail = () => {
	if (regMail.test(mail.value)) {
		error_mail.style.display = "none";
		return true;
	} else {
		error_mail.style.display = "block";
		return false;
	}
}

// // === Validate Password ===

let psw = document.getElementById("sign-p");
let cp = document.getElementById("sign-cp");
let error_p = document.getElementById("tooltip-psw");
let error_cp = document.getElementById("tooltip-cp");

const checkPsw = () => {
	if (regPsw.test(psw.value)) {
		error_p.style.display = "none";
		return true;
	} else {
		error_p.style.display = "block";
		// === Show Password tooltip ===
		var myInput = document.getElementById("sign-p");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		// When the user clicks on the password field, show the message box
		myInput.onfocus = function () {
			document.getElementById("message").style.display = "block";
		};

		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function () {
			document.getElementById("message").style.display = "none";
		};

		// When the user starts to type something inside the password field
		myInput.onkeyup = function () {
			// Validate lowercase letters
			var lowerCaseLetters = /[a-z]/g;
			if (myInput.value.match(lowerCaseLetters)) {
				letter.classList.remove("invalid");
				letter.classList.add("valid");
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
			}

			var upperCaseLetters = /[A-Z]/g;
			if (myInput.value.match(upperCaseLetters)) {
				capital.classList.remove("invalid");
				capital.classList.add("valid");
			} else {
				capital.classList.remove("valid");
				capital.classList.add("invalid");
			}

			// Validate numbers
			var numbers = /[0-9]/g;
			if (myInput.value.match(numbers)) {
				number.classList.remove("invalid");
				number.classList.add("valid");
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
			}

			// Validate length
			if (myInput.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
			}
		};
		return false;
	}
}

const checkCP = () => {
	if (psw.value == cp.value) {
		error_cp.style.display = "none";
		return true;
	} else {
		error_cp.style.display = "block";
		return false;
	}
}

// === Event listeners on Key up ===
user.addEventListener("keyup", checkUser);
mail.addEventListener("keyup", checkMail);
psw.addEventListener("keyup", checkPsw);
cp.addEventListener("keyup", checkCP);

// ==== Submit =====

const su_form = document.getElementById("su-form");

su_form.addEventListener("submit", function (e) {
	let errorUser = checkUser(true);
	let errorMail = checkMail(true);
	let errorPsw = checkPsw(true);
	let errorCP = checkCP(true);
	if (errorUser && errorMail && errorPsw && errorCP) {
		su_form.submit();
	} else {
		e.preventDefault();
	}
});
