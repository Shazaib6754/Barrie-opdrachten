<?php
// Database configuratie
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'guestbook';

// Maak verbinding met de database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Controleer op connectiefouten
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}
?>