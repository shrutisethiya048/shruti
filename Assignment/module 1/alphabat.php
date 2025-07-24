<?php
for ($i = 1; $i <= 5; $i++) {
    $char = 'A';
    for ($j = 1; $j <= $i; $j++) {
        echo $char . " ";
        $char++;
    }
    echo "<br>";
}
?>
