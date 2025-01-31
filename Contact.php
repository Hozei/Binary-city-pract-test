<?php
require_once 'db.php';

class Contact {
    public $contact_id;
    public $first_name;
    public $last_name;
    public $email;

    public static function createContact($first_name, $last_name, $email) {
        $stmt = $GLOBALS['pdo']->prepare("INSERT INTO contacts (first_name, last_name, email) VALUES (?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $email]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    public static function getAllContacts() {
        $stmt = $GLOBALS['pdo']->query("SELECT * FROM contacts ORDER BY last_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function linkClient($contact_id, $client_id) {
        $stmt = $GLOBALS['pdo']->prepare("INSERT INTO client_contacts (client_id, contact_id) VALUES (?, ?)");
        $stmt->execute([$client_id, $contact_id]);
    }

    public static function unlinkClient($contact_id, $client_id) {
        $stmt = $GLOBALS['pdo']->prepare("DELETE FROM client_contacts WHERE contact_id = ? AND client_id = ?");
        $stmt->execute([$contact_id, $client_id]);
    }
}
?>
