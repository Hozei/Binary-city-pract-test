<?php
require_once 'db.php';

class Client {
    public $client_id;
    public $client_name;
    public $client_code;

    /**
     * Generate a unique client code based on the client name.
     */
    public static function generateClientCode($client_name) {
        // Ensure $client_name is a string and get the first 3 uppercase characters
        $client_name = trim($client_name); // Clean up any leading or trailing spaces
        $alpha_part = strtoupper(substr($client_name, 0, 3));

        // Count the number of clients with the same prefix
        $sql = "SELECT COUNT(*) FROM clients WHERE client_code LIKE :client_code";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->execute([':client_code' => $alpha_part . '%']);
        $count = $stmt->fetchColumn();

        // Generate a numeric part for the client code, incrementing from the last used number
        $numeric_part = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Return the full client code
        return $alpha_part . $numeric_part;
    }

 
   public static function createClient($client_name) {
    // Validate that $client_name is a string and not empty
    if (!is_string($client_name) || empty($client_name)) {
        throw new Exception("Client name must be a non-empty string.");
    }

    // Generate the unique client code
    $client_code = self::generateClientCode($client_name);

    // Insert the new client into the database
    $stmt = $GLOBALS['pdo']->prepare("INSERT INTO clients (client_name, client_code) VALUES (?, ?)");
    $stmt->execute([$client_name, $client_code]);

    // Return the ID of the newly created client
    return $GLOBALS['pdo']->lastInsertId();
}


    /**
     * Retrieve all clients ordered by client name.
     */
    public static function getAllClients() {
        $stmt = $GLOBALS['pdo']->query("SELECT * FROM clients ORDER BY client_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve a client by ID.
     */
    public static function getClientById($client_id) {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM clients WHERE client_id = ?");
        $stmt->execute([$client_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Link a contact to a client.
     */
    public static function linkContact($client_id, $contact_id) {
        $stmt = $GLOBALS['pdo']->prepare("INSERT INTO client_contacts (client_id, contact_id) VALUES (?, ?)");
        $stmt->execute([$client_id, $contact_id]);
    }

    /**
     * Unlink a contact from a client.
     */
    public static function unlinkContact($client_id, $contact_id) {
        $stmt = $GLOBALS['pdo']->prepare("DELETE FROM client_contacts WHERE client_id = ? AND contact_id = ?");
        $stmt->execute([$client_id, $contact_id]);
    }
}
?>
