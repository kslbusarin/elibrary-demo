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

      $response = array(
        'loggedIn' => true,
        // 'user' => $user,
        'fullname_en' => $user->{'first-name-en'}." ".$user->{'last-name-en'},
        'userid' => $user->{'user-id'},
        'accessToken' => $_SESSION['access_token'],
        'refreshToken' => $_SESSION['refresh_token'],
        'expiresIn' => $_SESSION['expires_in']
      );

    
    } else {

      $response = array(
        'loggedIn' => false
      );
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);  


    
    
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