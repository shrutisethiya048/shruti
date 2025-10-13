<?php
// ABSTRACT CLASS (Abstraction)
abstract class User {
    protected $name;
    protected $userId;

    public function __construct($name, $userId) {
        $this->name = $name;
        $this->userId = $userId;
    }

    // Abstract method (must be defined in child classes)
    abstract public function displayInfo();
}

// INHERITANCE & POLYMORPHISM
class Member extends User {
    private $borrowedBooks = [];

    public function borrowBook($book) {
        $this->borrowedBooks[] = $book;
    }

    // Method overriding (Polymorphism)
    public function displayInfo() {
        echo "<b>Member:</b> {$this->name} (ID: {$this->userId})<br>";
        echo "Borrowed Books:<br>";
        if (empty($this->borrowedBooks)) {
            echo "_No books borrowed<br>";
        } else {
            foreach ($this->borrowedBooks as $book) {
                echo "_ " . $book->getTitle() . "<br>";
            }
        }
        echo "<hr>";
    }
}

class Admin extends User {
    // Method overriding (Polymorphism)
    public function displayInfo() {
        echo "<b>Admin:</b> {$this->name} (ID: {$this->userId})<br><hr>";
    }
}

// ENCAPSULATION
class Book {
    private $title;
    private $author;
    private $isAvailable = true;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    // Getter methods
    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function isAvailable() {
        return $this->isAvailable;
    }

    // Setter method (Encapsulation)
    public function setAvailability($status) {
        $this->isAvailable = $status;
    }
}

// TRANSACTION CLASS
class Transaction {
    private $book;
    private $user;
    private $date;

    public function __construct($book, $user) {
        $this->book = $book;
        $this->user = $user;
        $this->date = date('Y-m-d');
    }

    public function completeTransaction() {
        if ($this->book->isAvailable()) {
            $this->book->setAvailability(false);
            $this->user->borrowBook($this->book);
            echo "Transaction successful on {$this->date}<br>";
        } else {
            echo "Sorry! Book '{$this->book->getTitle()}' is not available.<br>";
        }
    }
}

// LIBRARY CLASS
class Library {
    private $books = [];

    public function addBook($book) {
        $this->books[] = $book;
    }

    public function showBooks() {
        echo "<h3>Library Books:</h3>";
        foreach ($this->books as $book) {
            $status = $book->isAvailable() ? "Available" : "Not Available";
            echo "{$book->getTitle()} by {$book->getAuthor()} - <b>{$status}</b><br>";
        }
        echo "<hr>";
    }
}

// MAIN PROGRAM (DEMO)

// Create Book objects
$book1 = new Book("The Alchemist", "Paulo Coelho");
$book2 = new Book("Harry Potter", "J.K. Rowling");
$book3 = new Book("Rich Dad Poor Dad", "Robert Kiyosaki");

// Create Users (Admin & Member)
$admin = new Admin("Shruti", 101);
$member = new Member("Navya", 201);

// Create Library
$library = new Library();
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Display Books before borrowing
$library->showBooks();

// Display Admin Info
$admin->displayInfo();

// Borrow Book (Transaction)
$transaction = new Transaction($book1, $member);
$transaction->completeTransaction();

// Display Member Info after borrowing
$member->displayInfo();

// Display Books after borrowing
$library->showBooks();
?>
