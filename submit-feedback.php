<?php
// submit-feedback.php

// Get the submitted form data
$name = htmlspecialchars($_POST['name']);
$feedback = htmlspecialchars($_POST['feedback']);

// Validate inputs
if (empty($name) || empty($feedback)) {
    die("Name and feedback are required.");
}

// Construct the feedback entry
$feedbackEntry = "Name: $name\nFeedback: $feedback\n\n";

// Save the feedback to a file
file_put_contents('feedback.txt', $feedbackEntry, FILE_APPEND);

// Confirmation message
echo "<h2>Thank you for your feedback!</h2>";
echo "<p>Your feedback has been received and recorded.</p>";
?>
