<?php
session_start();

// Check if the GET parameter "logout" is set. If so, log the user out.
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Check if the user is already logged in. If so, redirect to admin.php.
if (isset($_SESSION['login'])) {
    header('Location: admin.php');
    exit;
}

// Check if the form has been sent. If so, check the username and password and if correct, log the user in and redirect to admin.php.
// If not correct, show the error message near the form..............................
[$correct_username, $correct_password] = ['admin', 'pass'];
if (isset($_POST['login'])) {
    if ($_POST['username'] === $correct_username && $_POST['password'] === $correct_password) {
        $_SESSION['login'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
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
                <li><a href="booksite.php">Home</a></li>
                <li><a href="booksite.php?genre=Adventure">Adventure</a></li>
                <li><a href="booksite.php?genre=Classic Literature">Classic Literature</a></li>
                <li><a href="booksite.php?genre=Coming-of-age">Coming-of-age</a></li>
                <li><a href="booksite.php?genre=Fantasy">Fantasy</a></li>
                <li><a href="booksite.php?genre=Historical Fiction">Historical Fiction</a></li>
                <li><a href="booksite.php?genre=Horror">Horror</a></li>
                <li><a href="booksite.php?genre=Mystery">Mystery</a></li>
                <li><a href="booksite.php?genre=Romance">Romance</a></li>
                <li><a href="booksite.php?genre=Science Fiction">Science Fiction</a></li>
            </ul>
        </nav>
        <main>
            <form action="login.php" method="post">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </p>
                <p><input type="submit" name="login" value="Log in"></p>
                <?php if (isset($error)) : ?>
                    <small class="error"><?= $error ?></small>
                <?php endif; ?>
            </form>
        </main>
    </div>
</body>

</html>