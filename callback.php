<?php
session_start();
require_once 'config.php';

if (isset($_GET['code'])) {
    // Tukar code dengan access token
    $token_url = "https://oauth2.googleapis.com/token";
    $data = [
        'code' => $_GET['code'],
        'client_id' => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'redirect_uri' => GOOGLE_REDIRECT_URI,
        'grant_type' => 'authorization_code'
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($token_url, false, $context);
    $response = json_decode($result, true);

    // Ambil data user
    if (isset($response['access_token'])) {
        $access_token = $response['access_token'];
        $user_info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' . $access_token);
        $_SESSION['user'] = json_decode($user_info, true);
        header('Location: home.php');
        exit;
    } else {
        echo "Gagal mendapatkan access token.";
    }
} else {
    echo "Tidak ada kode otorisasi.";
}
?>