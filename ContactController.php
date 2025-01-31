<?php
require_once 'models/Contact.php';

class ContactController {
    public function createContact($first_name, $last_name, $email) {
        // Use the Contact model to create the contact
        return Contact::createContact($first_name, $last_name, $email);
    }

    // These methods should be inside the class, not after a closing brace
    public function showContacts() {
        return Contact::getAllContacts();
    }

    public function linkClientToContact($contact_id, $client_id) {
        Contact::linkClient($contact_id, $client_id);
    }

    public function unlinkClientFromContact($contact_id, $client_id) {
        Contact::unlinkClient($contact_id, $client_id);
    }
    // Inside ContactController.php
public function updateContact($contact_id, $first_name, $last_name, $email) {
    $stmt = $GLOBALS['pdo']->prepare("UPDATE contacts SET first_name = ?, last_name = ?, email = ? WHERE contact_id = ?");
    $stmt->execute([$first_name, $last_name, $email, $contact_id]);
}

public function deleteContact($contact_id) {
    $stmt = $GLOBALS['pdo']->prepare("DELETE FROM contacts WHERE contact_id = ?");
    $stmt->execute([$contact_id]);
}

}
?>
