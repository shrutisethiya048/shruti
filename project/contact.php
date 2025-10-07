<?php
session_start(); // Must be on top
include("header.php");
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="contact.css" />

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

    <form action="contact_process.php" method="post">
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
