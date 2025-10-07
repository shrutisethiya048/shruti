<?php
include("header.php");
include_once("model.php");
?>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />

<!-- Custom CSS -->
<style>
    body {
        background-color: #f4f6f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        max-width: 700px;
        background: #fff;
        padding: 40px;
        margin-top: 50px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }
    .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ccc;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.5);
    }
    button.btn-primary {
        background-color: #007bff;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        border: none;
        transition: 0.3s;
    }
    button.btn-primary:hover {
        background-color: #0069d9;
    }
    .alert {
        border-radius: 8px;
        padding: 12px 20px;
        font-size: 14px;
    }
</style>

<div class="container pt-5">
    <h2 class="mb-4">Contact Us</h2>

    <!-- Display Success/Error messages -->
    <?php
    if(isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form action="contact_process" method="post">
        <div class="form-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>
        <div class="form-group mb-3">
            <textarea name="message" class="form-control" placeholder="Your Message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<?php include("footer.php"); ?>
