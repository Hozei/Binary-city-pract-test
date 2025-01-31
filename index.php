<?php
// Include necessary files for connecting to the database
require_once 'db.php';
require_once 'controllers/ClientController.php';
require_once 'controllers/ContactController.php';

// Instantiate controllers
$clientController = new ClientController();
$contactController = new ContactController();

// Get all clients and contacts for quick display (optional)
$clients = $clientController->showClients();
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
        <h2>Overview</h2>

        <div class="overview">
            <h3>Clients</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Code</th>
                        <th>No. of Contacts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($clients) > 0) {
                        foreach ($clients as $client) {
                            // Get the number of contacts linked to this client
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM client_contacts WHERE client_id = ?");
                            $stmt->execute([$client['client_id']]);
                            $num_contacts = $stmt->fetchColumn();
                            echo "<tr>
                                    <td>{$client['client_name']}</td>
                                    <td>{$client['client_code']}</td>
                                    <td style='text-align: center;'>{$num_contacts}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='text-align: center;'>No clients found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="overview">
            <h3>Contacts</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>No. of Clients</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($contacts) > 0) {
                        foreach ($contacts as $contact) {
                            // Get the number of clients linked to this contact
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM client_contacts WHERE contact_id = ?");
                            $stmt->execute([$contact['contact_id']]);
                            $num_clients = $stmt->fetchColumn();
                            echo "<tr>
                                    <td>{$contact['last_name']} {$contact['first_name']}</td>
                                    <td>{$contact['email']}</td>
                                    <td style='text-align: center;'>{$num_clients}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='text-align: center;'>No contacts found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Client and Contact Management</p>
    </footer>

</body>
</html>
