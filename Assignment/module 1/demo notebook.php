<?php
$notes = array();

while (true) {
    echo "\n======= PHP E-Note Book =======\n";
    echo "1. Add Note\n";
    echo "2. View Notes\n";
    echo "3. Exit\n";
    echo "Enter your choice: ";
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            echo "Enter Note Title: ";
            $title = trim(fgets(STDIN));
            echo "Enter Note Content: ";
            $content = trim(fgets(STDIN));
            $notes[] = array("title" => $title, "content" => $content);
            echo " Note added successfully!\n";
            break;

        case 2:
            echo "\n====== Your Notes ======\n";
            if (count($notes) == 0) {
                echo " No notes available.\n";
            } else {
                foreach ($notes as $index => $note) {
                    echo "\nNote " . ($index + 1) . ":\n";
                    echo "Title: " . strtoupper($note["title"]) . "\n";
                    echo "Content: " . $note["content"] . "\n";
                }
            }
            break;

        case 3:
            echo "Exiting the application. Goodbye!\n";
            exit;

        default:
            echo " Invalid input! Please enter 1, 2, or 3.\n";
    }
}
