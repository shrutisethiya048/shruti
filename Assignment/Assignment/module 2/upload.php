<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <label>Select a text file:</label>
    <input type="file" name="myfile">
    <input type="submit" name="upload" value="Upload">
</form>

<?php
if (isset($_POST['upload'])) {
    try {
        if (!isset($_FILES['myfile']) || $_FILES['myfile']['error'] != 0) {
            throw new Exception("File upload failed!");
        }

        $fileName = $_FILES['myfile']['name'];
        $fileTmp = $_FILES['myfile']['tmp_name'];

        // folder create if not exists
        if (!file_exists("uploads")) {
            mkdir("uploads");
        }

        $target = "uploads/" . $fileName;

        // move file
        move_uploaded_file($fileTmp, $target);

        // read content
        $content = file_get_contents($target);

        echo "<h3>File Uploaded Successfully!</h3>";
        echo "<p>File Name: $fileName</p>";
        echo "<h4>File Content:</h4><pre>$content</pre>";

    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

</body>
</html>