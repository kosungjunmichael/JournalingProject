const loginWithKakao = () => {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);
			getInfo("login");
		},
		fail: function (err) {
			// window.location = `http://localhost/sites/JournalingProject/index.php/?action=&kakaoError${err}`;
			console.log(err);
		},
	});
};

const signUpWithKakao = () => {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);
			getInfo("signup");
		},
		fail: function (err) {
			// window.location = `http://localhost/sites/JournalingProject/index.php/?action=&kakaoError${err}`;
			console.log(err);
		},
	});
};

const getInfo = (type) => {
	Kakao.API.request({
		url: "/v2/user/me",
		success: function (res) {
			let form = document.createElement("form");
			form.action =
				type == "login"
					? "http://localhost/sites/JournalingProject/index.php/?action=kakaoLogin"
					: "http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp";

			form.method = "POST";
			let input = document.createElement("input");
			input.type = "text";
			input.name = "data";
			input.value = `${JSON.stringify(res)}`;
			form.appendChild(input);
			document.body.appendChild(form);
			form.submit();
		},
		fail: function (error) {
			alert(JSON.stringify(error));
		},
	});
};
