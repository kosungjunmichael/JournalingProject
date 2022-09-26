<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script>
    Kakao.init("<?= $_SERVER['JS_API_KEY'] ?>"); // Enter your app's JavaScript key
    // console.log(Kakao.isInitialized());
</script>

<a id="kakao-login-btn" href="javascript:loginWithKakao()">
    <img src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg" width="222" alt="Kakao login button" />
</a>
<script>
    function loginWithKakao() {
        Kakao.Auth.login({
            success: function (authObj) {
                Kakao.Auth.setAccessToken(authObj.access_token);

                getInfo();
            },
            fail: function (err) {
                console.log(err);
            }
        });
    }
    
    function getInfo() {
        Kakao.API.request({
            url: '/v2/user/me',
            success: function (res) {
                console.log(res);
                // console.log(res);
                console.log(res.kakao_account.email);
                console.log(res.kakao_account.profile.nickname);
                console.log(res.kakao_account.profile.thumbnail_image_url)
                let email = res.kakao_account.email;
                // let gender = res.kakao_account.gender;
                // let nickname = res.kakao_account.profile.nickname;
                // let profile_image = res.kakao_account.profile.thumbnail_image_url;

                // console.log(email, gender, nickname, profile_image);
                // console.log(email, nickname, profile_image);

                // return res;
            },
            fail: function (error) {
                alert(JSON.stringify(error));
            }
        })
    }
</script>