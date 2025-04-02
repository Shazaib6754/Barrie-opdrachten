<?php
// edit_message.php

// Controleren of de gebruiker is ingelogd
session_start();
if (!isset($_SESSION['user_id'])) {
    // Als de gebruiker niet is ingelogd, stuur ze door naar de inlogpagina
    header('Location: login.php');
    exit;
}

// Controleren of de bericht-id is opgegeven in de querystring
if (!isset($_GET['id'])) {
    // Als er geen id is opgegeven, stuur de gebruiker terug naar index.php
    header('Location: index.php');
    exit;
}

// Controleren of het bericht behoort tot de ingelogde gebruiker of dat de gebruiker een admin is
require_once 'config.php';
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['role'] == 'admin';

$sql = "SELECT * FROM guestbook WHERE id = $id AND (user_id = $user_id OR $is_admin)";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Geen toestemming om het bericht te bewerken of het bericht is niet gevonden
    header('Location: index.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Het formulier is verzonden, werk het bericht bij met het nieuwe bericht uit het formulier
    $new_message = $_POST['message'];
    
    // Update query om het bericht bij te werken in de database
$sql_update = "UPDATE guestbook SET message='$new_message' WHERE id=$id";
if ($conn->query($update_sql) === TRUE) {
    echo "Het bericht succesvol is bijgewerkt, stuur de gebruiker naar een andere pagina";
    header("Location: index.php");
    exit;
} else {
    echo "Er is een fout opgetreden bij het bijwerken van het bericht: " . $conn->error;
}

if ($gebruiker_heeft_rechten) {
    echo "U heeft geen rechten om dit bericht te bewerken.";
} elseif ($bericht_niet_gevonden) {
    echo "Bericht niet gevonden.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>bericht bewerken</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=$message_id" method="post">
    <label for="message">Wijzig de inhoud van het bericht:</label><br />
    <textarea name="message" id="message" rows="4" cols="40"><?php echo $row['message']; ?></textarea><br />
    <button type="submit">bewerken opslaan</button>
</form>
</body>
</html>