<?php
$array = [0, 5, 0, 3, 0, 1];

$nonZero = [];       
$zeroCount = 0;     

foreach ($array as $value) {
    if ($value == 0) {
        $zeroCount++; 
    } else {
        $nonZero[] = $value;
    }
}

for ($i = 0; $i < $zeroCount; $i++) {
    $nonZero[] = 0;
}

print_r($nonZero);
?>
