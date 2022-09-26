Kakao.init("<?= $_SERVER['JS_API_KEY'] ?>"); // Enter your app's JavaScript key
// console.log(Kakao.isInitialized());

function loginWithKakao() {
	Kakao.Auth.login({
		success: function (authObj) {
			Kakao.Auth.setAccessToken(authObj.access_token);

			getInfo();
		},
		fail: function (err) {
			console.log(err);
		},
	});
}

function getInfo() {
	Kakao.API.request({
		url: "/v2/user/me",
		success: function (res) {
			console.log(res);
			let email = res.kakao_account.email;
			// let gender = res.kakao_account.gender;
			let nickname = res.kakao_account.profile.nickname;
			let profile_image = res.kakao_account.profile.thumbnail_image_url;

			// console.log(email, gender, nickname, profile_image);
			console.log(email, nickname, profile_image);
		},
		fail: function (error) {
			alert(JSON.stringify(error));
		},
	});
}
