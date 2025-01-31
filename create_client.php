<?php
// Include your db.php and client controller logic here
require_once 'db.php';
require_once 'controllers/ClientController.php';

// Initialize the controller
$clientController = new ClientController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the client name from the form
    $client_name = $_POST['client_name'];

    // Call the controller to create the client
    $clientController->createClient($client_name);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Client</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
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
        <form action="create_client.php" method="POST">
            <label for="client_name">Client Name:</label>
            <input type="text" id="client_name" name="client_name" required>
            <input type="submit" value="Create Client">
        </form>
    </section>
</body>
</html>
