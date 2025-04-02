<?php
// Zorg ervoor dat je configuratiebestand correct is opgenomen
require_once 'config.php';

// Controleer of de gebruiker is ingelogd, anders stuur ze naar de inlogpagina
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Haal de toegang tot de variabelen die zijn gedefinieerd in config.php
try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // Query om gegevens op te halen
    $stmt = $pdo->query("SELECT * FROM users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['name']);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Wijzigen voor Gebruiker</title>
</head>
<body>
<h2>Wachtwoord Wijzigen voor Gebruiker</h2>

<form action="forgot_password.php" method="post">

    <label for="username">Selecteer de gebruiker:</label>
    <select id="username" name="username" required>
        <option value="">--Kies een gebruiker--</option>
        <?php foreach ($gebruikers as $gebruiker) { ?>
            <option value="<?php echo htmlspecialchars($gebruiker['username']); ?>"><?php echo htmlspecialchars($gebruiker['username']); ?></option>
        <?php } ?>
    </select>

    <br><br>

    <label for="newPassword">Nieuw Wachtwoord:</label>
    <input type="password" id="newPassword" name="newPassword" required>

    <br><br>

    <input type="submit" value="Wijzig wachtwoord">

</form>

<p>Als de gebruiker een admin is en de rol is ingesteld, toon een link naar forgot_password.php met beheerdersrechten.</p>

<?php
if (isset($_SESSION['beheerdersrol']) && $_SESSION['beheerdersrol'] === 'Beheerder')
?>
</body>
</html>