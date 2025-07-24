<html>
<head>
    <title>PHP E-Note Book</title>
</head>
<body>
    <h2>PHP E-Note Book</h2>

    <?php
    $notes = array();
    if (!empty($_POST['notes_data'])) {
        $notes = unserialize(base64_decode($_POST['notes_data']));
    }

    $action = $_POST['action'] ?? '';
    $note = $_POST['note'] ?? '';

    if ($action === "Add") {
        if (!empty(trim($note))) {
            $notes[] = trim($note);
            echo "<p style='color:green;'> Note added successfully!</p>";
        } else {
            echo "<p style='color:red;'> Note cannot be empty!</p>";
        }
    } elseif ($action === "Exit") {
        $notes = array();
        echo "<p style='color:blue;'> Notes cleared. (Exit)</p>";
    }
    ?>

    <!-- Form -->
    <form method="post">
        <textarea name="note" rows="4" cols="40" placeholder="Write your note here..."></textarea><br><br>

        <input type="submit" name="action" value="Add">
        <input type="submit" name="action" value="View">
        <input type="submit" name="action" value="Exit">

       
        <input type="hidden" name="notes_data" value="<?php echo base64_encode(serialize($notes)); ?>">
    </form>

    <?php if ($action === "View") { ?>
        <h3>Your Notes:</h3>
        <?php
        if (!empty($notes)) {
            echo "<ol>";
            foreach ($notes as $n) {
                echo "<li>" . htmlspecialchars($n) . "</li>";
            }
            echo "</ol>";
        } else {
            echo "<p>No notes found.</p>";
        }
        ?>
    <?php } ?>
</body>
</html>
