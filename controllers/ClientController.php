<?php
require_once 'models/Client.php';

class ClientController {
    public function createClient($client_name) {
        // Use the Client model to create the client
        return Client::createClient($client_name);
    }

    // These methods should be inside the class, not after a closing brace
    public function showClients() {
        return Client::getAllClients();
    }

    public function linkContactToClient($client_id, $contact_id) {
        Client::linkContact($client_id, $contact_id);
    }

    public function unlinkContactFromClient($client_id, $contact_id) {
        Client::unlinkContact($client_id, $contact_id);
    }
    // Inside ClientController.php
public function updateClient($client_id, $client_name) {
    $stmt = $GLOBALS['pdo']->prepare("UPDATE clients SET client_name = ? WHERE client_id = ?");
    $stmt->execute([$client_name, $client_id]);
}

public function deleteClient($client_id) {
    $stmt = $GLOBALS['pdo']->prepare("DELETE FROM clients WHERE client_id = ?");
    $stmt->execute([$client_id]);
}

}
?>
