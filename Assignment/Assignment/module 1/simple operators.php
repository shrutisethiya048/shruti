<?php
$number1=10;
$number2=5;
$operator="*";

if($operator=="+"){
$result = $number1 + $number2; 
echo"Result: $number1 + $number2 = $result";
}
elseif($operator=="-"){
$result=$number1-$number2;
echo"Result:$number1-$number2 = $result";
}
elseif($operator=="*"){
$result=$number1*$number2;
echo"Result:$number1*$number2 = $result";
} 
elseif ($operator == "/") {
    if ($number2 != 0) {
        $result = $number1 / $number2;
        echo "Result: $number1 / $number2 = $result";
    } else {
        echo "Error: Cannot divide by zero!";
    }
}
else {
    echo "Invalid operator!";
}
?>