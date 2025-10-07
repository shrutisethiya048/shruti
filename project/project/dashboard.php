<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include("header.php");
?>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
    <p>You are logged in successfully.</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<?php include("footer.php"); ?>
