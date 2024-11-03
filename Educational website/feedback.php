<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the input
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Create a feedback entry
    $feedback = "Name: $name\nEmail: $email\nMessage: $message\n\n";

    // Save the feedback to a text file
    $file = 'feedback.txt';
    file_put_contents($file, $feedback, FILE_APPEND | LOCK_EX);

    // Respond to the user
    echo "Thank you for your feedback, $name!";
} else {
    echo "Invalid request.";
}
?>
