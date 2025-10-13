<?php
function sendWelcomeEmail($email) {
    // Step 1: Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format: $email");
    }

    echo "✅ Welcome email would be sent successfully to $email (Test Mode)";
}

// Example usage
try {
    $userEmail = "shruti@example.com";  
    sendWelcomeEmail($userEmail);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
