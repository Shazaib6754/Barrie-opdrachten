<?php
// Start de sessie om de gebruikersgegevens te kunnen gebruiken
session_start();

// Controleren of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    // Als de gebruiker niet is ingelogd, stuur ze door naar de inlogpagina
    header("Location: login.php");
    exit();
}

// Inclusief de configuratiebestand
require_once('config.php');

// Gebruikersnaam van de huidige ingelogde gebruiker ophalen uit de sessie
$username = $_SESSION['username'];

// Controleren of er een bericht is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Berichtgegevens ophalen uit het formulier
    $message = $_POST['message'];

    // Query voor het invoegen van het bericht in de database
    $insert_sql = "INSERT INTO guestbook (username, message) VALUES ('$username', '$message')";

    // Voer de query uit en controleer op fouten
    if ($conn->query($insert_sql) === TRUE) {
        // Bericht succesvol toegevoegd
        header("Location: index.php");
        exit();
    } else {
        // Fout bij het toevoegen van bericht
        echo "Fout bij het toevoegen van bericht: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bericht verwijderen</title>
</head>
<body>
<h2>Bericht verwijderen</h2>
<p>Weet je zeker dat u het volgende bericht wilt verwijderen?</p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="post">
    <input type="submit" name="confirm_delete" value="Verwijderen">
    <button type="button" onclick="location.href='index.php';">Annuleren</button>
</form>

</body>
</html>