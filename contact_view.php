<?php
require_once 'db.php';
require_once 'controllers/ContactController.php';

$contactController = new ContactController();
$contacts = $contactController->showContacts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client and Contact Management</title>
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
        <h2>List of Contacts</h2>
        <table>
            <thead>
                <tr>
                    <th>Contact Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo $contact['first_name'] . ' ' . $contact['last_name']; ?></td>
                        <td><?php echo $contact['email']; ?></td>
                        <td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
