const loginWithKakao = () => {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);
			getInfo("login");
		},
		fail: function (err) {
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
			console.log(err);
		},
	});
};

const getInfo = (type) => {
	Kakao.API.request({
		url: "/v2/user/me",
		success: function (res) {
			// console.log(res);
			// console.log(JSON.stringify(res));
			window.location =
				type == "login"
					? `http://localhost/sites/JournalingProject/index.php/?action=kakaoLogin&data=${JSON.stringify(
							res
					  )}`
					: `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&data=${JSON.stringify(
							res
					  )}`;
		},
		fail: function (error) {
			alert(JSON.stringify(error));
		},
	});
};
