// This is js stuff
  function handleCredentialResponse(response) {
    try {
      const data = JSON.parse(atob(response.credential.split('.')[1]));
      const credentials = {
        aud: data.aud,
        email: data.email,
        picture: data.picture
      }

      let req = new XMLHttpRequest();
      req.open('POST', `message_view.php?pagination=${paginationVal}`);
      req.addEventListener('readystatechange', () => {
        if (req.readyState === XMLHttpRequest.DONE && req.status === 200) {
          console.log(JSON.parse(req.responseText))
          const res = JSON.parse(req.responseText);
          displayMessages(res);
        } else if (req.readyState === XMLHttpRequest.DONE && req.status !== 200) {
          console.log(req.statusText);
        }
      });
      req.send(null);

    } catch (err) {
      throw new Error(err);
    }


  }
  