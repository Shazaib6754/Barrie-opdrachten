<?php
// forgot_password_process.php

require_once 'config.php';

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Haal de gebruikersnaam en nieuwe wachtwoord uit het formulier
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];

    // Controleer of de gebruiker bestaat in de database
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Gebruiker gevonden, update het wachtwoord in de database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE users SET password=? WHERE username=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ss", $hashedPassword, $username);

       () {
            // Wachtwoord succesvol bijgewerkt
            session_start();
            $_SESSION['reset_username'] = 1;
            header('Location: index.php');
            exit();
        } else {
            echo "<p>Er is een fout opgetreden bij het bijwerken van het wachtwoord. Probeer het later opnieuw.</p>";
        }
    } else {
        echo "<p>Gebruiker niet gevonden.</p>";
    }
}
?>