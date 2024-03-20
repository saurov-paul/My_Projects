<?php
session_start();
// If the user is not logged in, redirect them back to login.php.................
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Read the file into array variable $books:::::
$books = json_decode(file_get_contents('books.json'), true);

// If 'bookid' is set in the GET request, use it as the book ID (for editing existing book).
// Otherwise, increment the book ID by one for adding a new book................
isset($_GET['bookid']) ? $bookid = $_GET['bookid'] : $bookid = count($books) + 1;

// fetch book details for editing
$bookDetails = [];
foreach ($books as $book) {
    if ($book['id'] == $bookid) {
        $bookDetails = $book;
        break;
    }
}

// determine the button text
$buttonText = isset($_GET['editbook']) ? 'Edit Book' : 'Add Book';

// if the form has been sent, add the book to the data file

// In order to protect against cross-site scripting attacks (i.e. basic PHP security), remove HTML tags from all input.
// There's a function for that. E.g.
// $title = strip_tags($_POST["title"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookid = strip_tags($_POST["bookid"]);
    $title = strip_tags($_POST["title"]);
    $author = strip_tags($_POST["author"]);
    $year = strip_tags($_POST["year"]);
    $genre = strip_tags($_POST["genre"]);
    $description = strip_tags($_POST["description"]);

    $book = [
        'id' => $bookid,
        'title' => $title,
        'author' => $author,
        'publishing_year' => $year,
        'genre' => $genre,
        'description' => $description
    ];

    // Check if the book is being edited
    $isEditing = false;
    foreach ($books as $index => $existingBook) {
        if ($existingBook['id'] == $bookid) {
            $books[$index] = $book;  // Update the existing book
            $isEditing = true;
            break;
        }
    }

    // If the book is not being edited, add it to the array
    if (!$isEditing) {
        $books[] = $book;
    }

    file_put_contents('books.json', json_encode($books));

    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorite Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="booksite.css">
</head>

<body>
    <div id="container">
        <header>
            <h1>Your Favorite Books</h1>
        </header>
        <nav id="main-navi">
            <ul>
                <li><a href="admin.php">Admin Home</a></li>
                <li><a href="addbook.php">Add a New Book</a></li>
                <li><a href="login.php?logout">Log Out</a></li>
            </ul>
        </nav>
        <main>
            <h2>Add a New Book</h2>
            <form action="addbook.php" method="post">
                <p>
                    <label for="bookid">ID:</label>
                    <?php echo $bookid ?>
                    <input type="hidden" name="bookid" value="<?php echo $bookid; ?>">
                </p>
                <p>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $bookDetails['title'] ?? ''; ?>">
                </p>
                <p>
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?php echo $bookDetails['author'] ?? ''; ?>">
                </p>
                <p>
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" value="<?php echo $bookDetails['publishing_year'] ?? ''; ?>">
                </p>
                <p>
                    <label for="genre">Genre:</label>
                    <select id="genre" name="genre">
                        <!-- Add the selected attribute to the genre that matches the book's genre -->
                        <?php
                        $genres = ['Adventure', 'Classic Literature', 'Coming-of-age', 'Fantasy', 'Historical Fiction', 'Horror', 'Mystery', 'Romance', 'Science Fiction'];
                        foreach ($genres as $genre) {
                            $selected = ($bookDetails['genre'] ?? '') == $genre ? ' selected' : '';
                            echo '<option value="' . $genre . '"' . $selected . '>' . $genre . '</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="description">Description:</label><br>
                    <textarea rows="5" cols="100" id="description" name="description"><?php echo $bookDetails['description'] ?? ''; ?></textarea>
                </p>
                <p><input type="submit" name="add-book" value="<?php echo $buttonText; ?>"></p>
            </form>
        </main>
    </div>
</body>

</html>