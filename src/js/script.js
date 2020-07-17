const login = document.getElementById('login');
const logut = document.getElementById('logout');
const videoSearch = document.getElementById('videoSearch');

// Hiding the Logout Button
logout.style.display = 'none';

/**
   * Sample JavaScript code for youtube.search.list
   * See instructions for running APIs Explorer code samples locally:
   * https://developers.google.com/explorer-help/guides/code_samples#javascript
*/

const loadClient = async () => {

  // Setting The API & oAUTH URL
  gapi.client.setApiKey('AIzaSyAth-FzxYIc5PSSuQAomHN5qQS8G8Bly0c');
  const oauthURL = "https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest";

  try {
    const load = await gapi.client.load(oauthURL);
    return load;
  } catch (err) {
    console.log(err);
  }

}

// Authenticate OAuth 2.0
const authenticate = async () => {

  // Auth URL
  const authURL = "https://www.googleapis.com/auth/youtube.force-ssl";

  // Getting The Data
  try {
    return (await gapi.auth2.getAuthInstance()).signIn({scope: authURL});
    loadClient();
  } catch(error) {
    console.log(error.message);
  }
  
}



// login.addEventListener('click', function() {
//   document.getElementById('loginForm').submit();
// });