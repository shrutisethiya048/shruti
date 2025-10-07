<?php
$number = array(1, 3, 5, 7, 9, 11, 13, 15);
$evencount = 0;
$oddcount = 0;

foreach ($number as $num) {
    if ($num % 2 == 0) {
        $evencount++;
    } else {
        $oddcount++;
    }
}

echo "Total even numbers: " . $evencount . "<br>";
echo "Total odd numbers: " . $oddcount . "<br>";
?>
