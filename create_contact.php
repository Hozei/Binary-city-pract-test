<?php
// Include your db.php and contact controller logic here
require_once 'db.php';
require_once 'controllers/ContactController.php';

// Initialize the controller
$contactController = new ContactController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Call the controller to create the contact
    $contactController->createContact($first_name, $last_name, $email);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Contact</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
        <h1>Welcome to the Client and Contact Management System</h1>
    </header>

 <?php
// Get the current file name (e.g., "index.php", "client_view.php")
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav>
    <ul>
        <li class="<?php echo ($current_page == 'client_view.php') ? 'active' : ''; ?>">
            <a href="client_view.php">View Clients</a>
        </li>
        <li class="<?php echo ($current_page == 'contact_view.php') ? 'active' : ''; ?>">
            <a href="contact_view.php">View Contacts</a>
        </li>
        <li class="<?php echo ($current_page == 'create_client.php') ? 'active' : ''; ?>">
            <a href="create_client.php">Create New Client</a>
        </li>
        <li class="<?php echo ($current_page == 'create_contact.php') ? 'active' : ''; ?>">
            <a href="create_contact.php">Create New Contact</a>
        </li>
    </ul>
</nav>


   

    <section>
        <form action="create_contact.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Create Contact</button>
        </form>
    </section>
</body>
</html>
