<?php
function validateEmail($email) {
    // Sanitize email to remove unwanted characters
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate sanitized email
    if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email address: $email");
    }

    // Return the sanitized and valid email
    return $sanitizedEmail;
}

try {
    $email = "shruti@@example.com"; // try invalid email
    // $email = "shruti@gmail.com"; // try valid email

    $validEmail = validateEmail($email);
    echo "Valid email: " . $validEmail;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
