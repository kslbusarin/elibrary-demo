<?php
//Oauth 2.0: exchange token for session token so multiple calls can be made to api

    // $accessToken = $authObj->access_token;
    include '../front/components/environment.php';

    define('OAUTH2_CLIENT_ID', 'oauthpsu1647');
    define('OAUTH2_CLIENT_SECRET', 'b3bbcf8a3bf47c7d3f02e562dfd382cc');
    
    $authorizeURL = 'https://oauth.psu.ac.th/?oauth=authorize';
    $tokenURL = 'https://oauth.psu.ac.th/?oauth=token';
    $apiURLBase = 'https://oauth.psu.ac.th/?oauth=profile';
    // $apiURLBase = 'https://192.168.27.106/psupassportcallback';
    
    
    
    $timeout = 3600;
    ini_set( "session.gc_maxlifetime", $timeout );
    ini_set( "session.cookie_lifetime", $timeout );
    session_start();
    
    if(!session('access_token')) {
      // Exchange the auth code for a token
      $token = apiRequest($tokenURL, array(
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
        'redirect_uri'  => $host.'psupassportcallback',
        'grant_type'    => 'authorization_code',
        'code' => get('code')
      ));
      // var_dump($token);
      $_SESSION['access_token'] = $token->access_token;
      $_SESSION['refresh_token'] = $token->refresh_token;
      $_SESSION['expires_in'] = $token->expires_in;
      $s_name = session_name();

      // echo $s_name;

      setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );


    }
    
    if(session('access_token')) {

      $user = apiRequest($apiURLBase);
      // echo '<h3>Logged In</h3>';
      // echo "<b>User Profile</b><br>";
      // var_dump($user);
      // echo $user->{'login-id'};

      // echo '<br><br><b>Token is </b>'.$_SESSION['access_token'];
      // echo '<br><br><b>Refresh Token is </b>'.$_SESSION['refresh_token'];
      // echo '<br><br><b>Expires sin </b>'.$_SESSION['expires_in'];
      // echo '<br><a href="../front/home/">Home</a>';


      check_login($user);
    
    } else {
      echo '<h3>Not logged in</h3>';
      header( "location: ../front/authen/login.php?action=login" );
      exit(0);
      echo '<p><a href="../front/authen/login.php?action=login">Log In</a></p>';


    }
    

    function check_login($user){

      ?>
        <html>
          <body>
            <script>
                  const api_url = sessionStorage.getItem("url_api");
                  var username="<?php echo $user->{'login-id'}; ?>"; 
                  var department = "<?php echo $user->{'department-th'}; ?>"; 
                  var department_id = "<?php echo $user->{'department-id'}; ?>"; 
                  var email = "<?php echo $user->{'mail'}; ?>";   
                  var faculty = "<?php echo $user->{'faculty-th'}; ?>"; 
                  var faculty_id = "<?php echo "F".$user->{'faculty-id'}; ?>";  
                  var fullname = "<?php echo $user->{'first-name-th'}." ".$user->{'last-name-th'}; ?>";  
                  var fullname_en = "<?php echo $user->{'first-name-en'}." ".$user->{'last-name-en'}; ?>";  
                  var login = "<?php echo $user->{'login-id'}; ?>"; 
                  var typeperson = "<?php echo $user->{'type-person'}; ?>"; 
                  var uid = "<?php echo $user->{'user-id'}; ?>";   

                  // console.log(username)
                  var formData = new FormData();
                      formData.append('username', username);
                      formData.append('tmpurl', 'sasdfd');
                      // console.log(formData);
                      // formData.append("userid", "");
                      var url = "https://read.libx.psu.ac.th/backend/authen/checkauthen.php";
                      
                      fetch(url, { method: 'POST', body: formData })
                      .then(function (response) {
                          // console.log(response)
                          // alert(response)
                          return response.json();
                      })
                      .then(function (body) {
                        // console.log(body[0]);
                          if(body[0]){
                                  // console.log(body);
                                  // console.log(body[0].login);
                                  localStorage.setItem("username", body[0].login);
                                  localStorage.setItem("fullname_en", body[0].fullname_en);
                                  localStorage.setItem("userid", body[0].userid);
                                  localStorage.setItem("uid", body[0].uid);
                                  localStorage.setItem("access_token", "<?php echo $_SESSION['access_token']; ?>");

                                  

                                  var object = {userid: body[0].userid, timestamp: new Date().getTime()}
                                  localStorage.setItem("key", JSON.stringify(object));

                                  // Check if user has reference URL
                                  // console.log(body[1].tmpbookurl)
                                  // console.log(typeof(body[1]))
                                      // show(body);
                                      location.href = 'https://read.libx.psu.ac.th/front/consent';
                          } 
                          else{
                            if(username){
                              var formdata = new FormData();
                                  formdata.append("department", department);
                                  formdata.append("department_id", department_id);
                                  formdata.append("email", email);
                                  formdata.append("faculty", faculty);
                                  formdata.append("faculty_id", faculty_id);
                                  formdata.append("fullname", fullname);
                                  formdata.append("fullname_en", fullname_en);
                                  formdata.append("login", login);
                                  formdata.append("username", username);
                                  formdata.append("typeperson", typeperson);

                                  var requestOptions = {
                                    method: 'POST',
                                    body: formdata,
                                    redirect: 'follow'
                                  };

                                  fetch("https://read.libx.psu.ac.th/psupassportcallback/insert_user.php", requestOptions)
                                    .then(response => response.text())
                                    .then(result => {
                                      // Parse the result parameter to a JavaScript object
                                      const resultObj = JSON.parse(result);

                                      // Check if the result object has a status property equal to "success"
                                      if (resultObj.status === "success") {
                                          

                                        var formData = new FormData();
                                            formData.append('username', username);
                                            formData.append('tmpurl', 'sasdfd');
                                            // console.log(formData);
                                            // formData.append("userid", "");
                                            var url = "https://read.libx.psu.ac.th/backend/authen/checkauthen.php";
                                            
                                            fetch(url, { method: 'POST', body: formData })
                                            .then(function (response) {
                                                // console.log(response)
                                                // alert(response)
                                                return response.json();
                                            })
                                            .then(function (body) {
                                              if(body[0]){
                                                    // console.log(body);
                                                    // console.log(body[0].login);
                                                    localStorage.setItem("username", body[0].login);
                                                    localStorage.setItem("fullname_en", body[0].fullname_en);
                                                    localStorage.setItem("userid", body[0].userid);
                                                    localStorage.setItem("uid", body[0].uid);
                                                    localStorage.setItem("access_token", "<?php echo $_SESSION['access_token']; ?>");

                                                    

                                                    var object = {userid: body[0].userid, timestamp: new Date().getTime()}
                                                    localStorage.setItem("key", JSON.stringify(object));

                                                    // Check if user has reference URL
                                                    // console.log(body[1].tmpbookurl)
                                                    // console.log(typeof(body[1]))
                                                        // show(body);
                                                        location.href = 'https://read.libx.psu.ac.th/front/consent';
                                              } 
                                            })




                                        
                                      } else {
                                        // Handle the result if the status is not "success"
                                        console.log(resultObj);
                                      }
                                    })
                                    .catch(error => console.log('error', error));
                            }
                            else{
                              alert("ขออภัย!! ท่านไม่มีสิทธิ์เข้าใช้งานในระบบนี้")
                              location.href = '../';
                            }
                          }
                      });     
                      // location.href = '../'; 
            </script>
          </body>
        </html>
      <?php
    }
    
    
    function apiRequest($url, $post=FALSE, $headers=array()) {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
      if($post)
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    
      $headers[] = 'Accept: application/json';
    
      if(session('access_token'))
        $headers[] = 'Authorization: Bearer ' . session('access_token');
    
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
      $response = curl_exec($ch);
      return json_decode($response);
    }
    
    function get($key, $default=NULL) {
      return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }
    
    function session($key, $default=NULL) {
      return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }


// $curl = curl_init();

// $base_url = 'https://oauth.psu.ac.th/?oauth=token';

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $base_url);
// curl_setopt($ch, CURLOPT_POST, TRUE);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_POSTFIELDS, array(
//         'client_id'     => 'oauthpsu1647',
//         'client_secret' => 'b3bbcf8a3bf47c7d3f02e562dfd382cc',
//         'grant_type'    => 'authorization_code',
//         'redirect_uri'  => 'https://192.168.27.106/psupassportcallback',
//         'respond_type'  => 'code',
//         'code' => '6803133703c035eb80481051a01499087840a86b'
// ));

// $data = curl_exec($ch);
// $info = curl_getinfo($ch);
// // var_dump($ch);
// var_dump($data);
// // var_dump($info);
// // $auth_string = json_decode($data, true);
// // var_dump($auth_string);



?>