<?php
if(isset($_SESSION['a_id'])){
    header("Location: dashboard");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
/* General body style */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

/* Login form container */
form {
    background: #ffffff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    width: 350px;
    text-align: center;
}

/* Heading */
h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    font-size: 24px;
    font-weight: 600;
}

/* Input fields */
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

input[type="text"]:focus, input[type="password"]:focus {
    border-color: #2575fc;
    box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
}

/* Submit button */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background: linear-gradient(90deg, #2575fc, #6a11cb);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button[type="submit"]:hover {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
}

/* Error message */
.error {
    color: red;
    margin-top: 15px;
    font-size: 14px;
}

/* Responsive for small screens */
@media(max-width: 400px){
    form {
        width: 90%;
        padding: 30px 20px;
    }
}
</style>
</head>
<body>

<form method="post" action="control.php/authentication-login">
    <h2>Admin Login</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="submit">Login</button>

    <?php
    if(isset($_SESSION['login_error'])){
        echo "<p class='error'>".$_SESSION['login_error']."</p>";
        unset($_SESSION['login_error']);
    }
    ?>
</form>

</body>
</html>
