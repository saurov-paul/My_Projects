<?php
session_start();
// If the user is not logged in, redirect them back to login.php.
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Read the file into array variable $books:
$books = json_decode(file_get_contents('books.json'), true);

// Check the POST parameter "bookid". If it's set, delete the corresponding book from the data file.
// Hint: array_diff will not work here, since you'd need to create the whole book "object". Find the index and use array_splice instead.............................

if (isset($_POST['bookid'])) {
    $bookid = $_POST['bookid'];

    foreach ($books as $index => $book) {
        if ($book['id'] == $bookid) {
            array_splice($books, $index, 1);
            break;
        }
    }
    file_put_contents('books.json', json_encode($books));
}


// Redirect back to admin.php.
header('Location: admin.php');
exit;