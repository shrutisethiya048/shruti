<!DOCTYPE html>
<html>
<head>
    <title>Chessboard Pattern</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>

<h2>8x8 Chessboard Pattern</h2>

<table border="1">
<?php
for ($row = 1; $row <= 8; $row++) {
    echo "<tr>";  // Start of row
    for ($col = 1; $col <= 8; $col++) {
        $total = $row + $col;
        if ($total % 2 == 0) {
            echo "<td style='background-color: white;'></td>";
        } else {
            echo "<td style='background-color: black;'></td>";
        }
    }
    echo "</tr>";  // End of row
}
?>
</table>

</body>
</html>
