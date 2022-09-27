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
			// let response = getInfo();
			// console.log(response);
			// window.location.href = `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&username=${response.kakao_account.email}&email=${response.kakao_account.email}`;
			// window.location.replace = `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&username=${response.kakao_account.email}&email=${response.kakao_account.email}`;
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
			// console.log(res);
			window.location =
				type == "login"
					? `http://localhost/sites/JournalingProject/index.php/?action=kakaoLogin&username=${res.kakao_account.email}&email=${res.kakao_account.email}`
					: `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&username=${res.kakao_account.email}&email=${res.kakao_account.email}`;
			// window.location = `http://localhost/sites/JournalingProject/kakao.php`;
			// window.location = `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&username=${res.kakao_account.email}&email=${res.kakao_account.email}`;
			// return res;
			// window.location.replace = `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&username=${res.kakao_account.email}&email=${res.kakao_account.email}`;
			// return res;
			// console.log(res);
			// console.log(res.kakao_account.email);
			// console.log(res.kakao_account.profile.nickname);
			// console.log(res.kakao_account.profile.thumbnail_image_url)
			// let email = res.kakao_account.email;
			// let gender = res.kakao_account.gender;
			// let nickname = res.kakao_account.profile.nickname;
			// let profile_image = res.kakao_account.profile.thumbnail_image_url;

			// console.log(email, gender, nickname, profile_image);
			// console.log(email, nickname, profile_image);

			// window.location.href = `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&email=${res.kakao_account.email}`;
			// return res;
		},
		fail: function (error) {
			alert(JSON.stringify(error));
		},
	});
}
