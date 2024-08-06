<?php
// fetch-info.php

// Define the API endpoint and API key
$apiEndpoint = "https://api.techcorp.com/getEmployeeInfo";
$apiKey = ""; //insert api key here

// Get the employee ID from the form submission
$employeeId = htmlspecialchars($_POST['employeeId']);

// Check if employee ID is provided
if (empty($employeeId)) {
    die("Employee ID is required.");
}

// Set up the API request headers
$headers = [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json"
];

// Set up the API request data
$data = json_encode(["employeeId" => $employeeId]);

// Initialize cURL session
$ch = curl_init($apiEndpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode and display the response
    $employeeInfo = json_decode($response, true);
    if (isset($employeeInfo['error'])) {
        echo "Error: " . $employeeInfo['error'];
    } else {
        echo "<h2>Employee Information</h2>";
        echo "<p>Name: " . $employeeInfo['name'] . "</p>";
        echo "<p>Position: " . $employeeInfo['position'] . "</p>";
        echo "<p>Email: " . $employeeInfo['email'] . "</p>";
    }
}

// Close cURL session
curl_close($ch);
?>
