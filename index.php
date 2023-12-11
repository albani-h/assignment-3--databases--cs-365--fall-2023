<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password Database Assignment 3</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Password Database Assignment 3 </h1>
</header>
<form id= "refresh" method="post"
action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input id=“Refresh_submit-button" type="submit" value=Refresh>
</form>


<?php
require_once "includes/config.php";
require_once "includes/helpers.php";

$option = (isset($_POST['submitted']) ? $_POST['submitted'] : null);
if ($option != null) {
    switch ($option) {
        case 1:
            if ("" == $_POST['search']) {
                echo '<div id="error">Search query empty. Please try again.</div>' .
                    "\n";
            } else {
                if (0 === (search($_POST['search']))) {
                    echo '<div id="error">Nothing found.</div>' . "\n";
                }
            }

            break;

    case 2:

            if (("" == $_POST['website_url']) || ("" == $_POST['website_name'])|| ("" == $_POST['email'])|| ("" == $_POST['username'])|| ("" == $_POST['user_password'])) {
                echo '<div id="error">At least one field in your insert request ' .
                    'is empty. Please try again.</div>' . "\n";
            } else {
                insert($_POST['website_url'],$_POST['website_name'],$_POST['email'],$_POST['username'],$_POST['user_password'],$_POST['account_comment']);
            }

            break;

        case 3:
            if (("" == $_POST['current_attribute']) || ("" == $_POST['match'])) {
                echo '<div id="error">At least one field in your delete procedure ' .
                    'is empty. Please try again.</div>' . "\n";

            } else {
                delete($_POST['current_attribute'], $_POST['match']);
            }

            break;

        case 4:
            if ((0 == $_POST['new-attribute']) && ("" == $_POST['match'])) {
                echo '<div id="error">One or both fields were empty, ' .
                    'but both must be filled out. Please try again.</div>' . "\n";
            } else {
                update($_POST['current-attribute'], $_POST['new-attribute'],
                    $_POST['query-attribute'], $_POST['match']);
            }

            break;
    }
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Search</legend>
        <input type="text" name="search" autofocus required>
        <input type="hidden" name="submitted" value="1">
        <p><input type="submit" value="search"></p>
    </fieldset>
</form>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Insert</legend>
        CREATE NEW ACCOUNT ( <input type="text" name="website_url" placeholder="WEBSITE URL" required>,
        <input type="text" name="website_name" placeholder="WEBSITE NAME" required>, <input type="text" name="email" placeholder="EMAIL" required>,
        <input type="text" name="username" placeholder="USERNAME" required>,<input type="text" name="user_password" placeholder="PASSWORD" required>,

        <textarea name="account_comment" placeholder="COMMENT" required></textarea>
        <input type="hidden" name="submitted" value="2">
        <p><input type="submit" value="insert"></p>
    </fieldset>
</form>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Delete</legend>
        DELETE ACCOUNT WHERE
        <select name="current_attribute" id="current_attribute">
            <option>Username</option>
            <option>Password</option>
            <option>Email</option>
        </select>
        = <input type="text" name="match" required>
        <input type="hidden" name="submitted" value="3">
        <p><input type="submit" value="delete"></p>
    </fieldset>
</form>
</body>
</html>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Update</legend>
        UPDATE Account
        <select name="current-attribute" id="current-attribute">
            <option>email</option>
            <option>username</option>
            <option>password</option>
        </select>
        = <input type="text" name="new-attribute" required> WHERE
        <select name="query-attribute" id="query-attribute">
            <option>email</option>
            <option>username</option>
            <option>password</option>
        </select>
        = <input type="text" name="match" required>
        <input type="hidden" name="submitted" value="4">
        <p><input type="submit" value="update"></p>
    </fieldset>
</form>
