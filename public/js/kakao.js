function loginWithKakao() {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);
			getInfo("login");
			window.location.href = `http://localhost/sites/JournalingProject/index.php/?action=kakaoLogin&username=${response.kakao_account.email}&email=${response.kakao_account.email}`;
		},
		fail: function (err) {
			console.log(err);
		},
	});
}

function signUpWithKakao() {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);
			getInfo("signup");
		},
		fail: function (err) {
			console.log(err);
		},
	});
}

function getInfo(type) {
	Kakao.API.request({
		url: "/v2/user/me",
		success: function (res) {
			window.location =
				type == "login"
					? `http://localhost/sites/JournalingProject/index.php/?action=kakaoLogin&username=${res.kakao_account.email}&email=${res.kakao_account.email}`
					: `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&username=${res.kakao_account.email}&email=${res.kakao_account.email}`;
		},
		fail: function (error) {
			alert(JSON.stringify(error));
		},
	});
}
