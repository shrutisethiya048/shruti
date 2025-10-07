<?php
date_default_timezone_set("Asia/Kolkata");

echo "<h2>Current Date and Time in Different Formats:</h2>";

// Format 1: Day-Month-Year Hour:Minute:Second
echo "Format 1: " . date("d-m-Y H:i:s") . "<br>";

// Format 2: Month/Day/Year
echo "Format 2: " . date("m/d/Y") . "<br>";

// Format 3: Full Day, Date Month Year
echo "Format 3: " . date("l, d F Y") . "<br>";

// Format 4: 12-hour format with AM/PM
echo "Format 4: " . date("h:i A") . "<br>";

// Format 5: ISO 8601 format
echo "Format 5: " . date("c") . "<br>";

// Format 6: RFC 822 format
echo "Format 6: " . date("r") . "<br>";
?>
