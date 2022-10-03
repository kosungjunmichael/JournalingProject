const loginWithKakao = () => {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);
			// console.log(Kakao.Auth.setAccessToken(authObj.access_token));
			getInfo("login");
			// window.location.href = `http://localhost/sites/JournalingProject/index.php/?action=login&method=kakao&username=${response.kakao_account.email}&email=${response.kakao_account.email}`;
		},
		fail: function (err) {
			console.log(err);
		},
	});
}

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
}

const getInfo = (type) => {
	Kakao.API.request({
		url: "/v2/user/me",
		success: function (res) {
			console.log(res);
			// window.location =
			// 	type == "login"
			// 		? `http://localhost/sites/JournalingProject/index.php/?action=login&method=kakao&username=${res.kakao_account.email}&email=${res.kakao_account.email}`
			// 		: `http://localhost/sites/JournalingProject/index.php/?action=signup&method=kakao&username=${res.kakao_account.email}&email=${res.kakao_account.email}`;
		},
		fail: function (error) {
			alert(JSON.stringify(error));
		},
	});
}
