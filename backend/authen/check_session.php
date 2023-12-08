<?php

    session_start();

   // Initialize the status variable
    $status = 0;

    // Check if the session is active
    if (isset($_SESSION['access_token'])) {
    // Session is active
    $status = 200; // OK
    } else {
    // Session is not active
    $status = 401; // Unauthorized
    }

    // Return the status as part of the response
    $response = [
    'status' => $status
    ];
    header('Content-Type: application/json');
    echo json_encode($response);

?>