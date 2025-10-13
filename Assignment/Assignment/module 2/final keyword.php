<?php
// Base class
class Animal {
    public function eat() {
        echo "Animal is eating.<br>";
    }
}

// Final class
final class Dog extends Animal {
    public function bark() {
        echo "Dog is barking.<br>";
    }
}

// Testing Dog class
$dog = new Dog();
$dog->eat();   // Inherited method from Animal
$dog->bark();  // Dog's own method

// Attempt to extend final class
/*
class Puppy extends Dog {  
    // This will cause an error: Cannot extend final class Dog
}
*/
?>