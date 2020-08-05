import axios from 'axios';
const login = document.getElementById('login');

window.fbAsyncInit = function() {
  FB.init({
    // 297048008200610
    appId      : '_FB_APP_ID',
    cookie     : true,
    xfbml      : true,
    version    : 'v6.0'
  });
    
  FB.AppEvents.logPageView();   
    
};


if(login) {
  login.addEventListener('click', function() {

    FB.login(function(response) {
      if(response.authResponse) {
        facebookAfterLogin();
      }
    });
    
  });
}




  function facebookAfterLogin() {
  
    FB.getLoginStatus(function(response) {
  
      if(response.status == 'connected') {
        FB.api('/me?fields=name,email,picture,id', function(resp) {
          const data = {
            name: resp.name,
            id: resp.id,
            email: resp.email
          };

          const response =  axios.post('/fb', data).then(function(res) {
            window.location.href = '/';
          });
          
        });
      }
  
    });
  
  }


(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));