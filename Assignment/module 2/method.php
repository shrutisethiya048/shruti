<?php
class DynamicProperties {
    private $data = array(); // To store dynamic properties

    // Magic method to set property dynamically
    public function __set($name, $value) {
        $this->data[$name] = $value;
        echo "Property '$name' has been set to '$value'.<br>";
    }

    // Magic method to get property dynamically
    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            echo "Property '$name' does not exist.<br>";
            return null;
        }
    }
}

// Create object
$obj = new DynamicProperties();

// Dynamically set properties
$obj->name = "Shruti";
$obj->course = "PHP Development";
$obj->city = "Ajmer";

// Access properties dynamically
echo "Name: " . $obj->name . "<br>";
echo "Course: " . $obj->course . "<br>";
echo "City: " . $obj->city . "<br>";
?>

