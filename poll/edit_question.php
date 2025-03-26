<?php
include 'connect.php';

// Controleren of er een 'id' en 'update' actie in de request
// $stmt is een prepared statement die de vraag en opties ophaalt uit de database.
// De vraag wordt opgehaald op basis van de id die in de GET request is meegegeven.
// Als de vraag bestaat, wordt een formulier weergegeven om de vraag te bewerken.
// In het formulier bevat de huidige vraagtekst en antwoordopties.
// Als het formulier wordt ingediend, wordt de vraag bijgewerkt in de database.
// De vraagtekst en antwoordopties worden opgehaald uit de POST request en geÃ¼pdatet in de database.
// Na het bijwerken van de vraag wordt een succesbericht weergegeven en een link om terug te gaan naar het beheer.

if (isset($_GET['id']) && !isset($_POST['update'])) {
    $stmt = $conn->prepare("SELECT * FROM vragen_en_opties WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $question = $stmt->fetch();

    if ($question) {
        // Formulier voor het bewerken van de vraag
        // $question['vraag'] is de vraagtekst die het haalt uit de database.
        // htmlspecialchars zorgt ervoor dat speciale tekens worden omgezet naar HTML entiteiten.
        // Daardoor wordt bijvoorbeeld < omgezet naar &lt; en > naar &gt;
        // Zo kan geen kwaadaardige code worden ingevoerd in het formulier.
        echo "<form action='edit_question.php' method='post'>
            <input type='hidden' name='id' value='" . $question['id'] . "'>
            Vraag: <input type='text' name='question' value='" . htmlspecialchars($question['vraag']) . "' required><br/>
            Antwoord 1: <input type='text' name='answer1' value='" . htmlspecialchars($question['antwoord1']) . "' required><br/>
            Antwoord 2: <input type='text' name='answer2' value='" . htmlspecialchars($question['antwoord2']) . "' required><br/>
            Antwoord 3: <input type='text' name='answer3' value='" . htmlspecialchars($question['antwoord3']) . "' required><br/>
            Antwoord 4: <input type='text' name='answer4' value='" . htmlspecialchars($question['antwoord4']) . "' required><br/>
            <input type='submit' name='update' value='Update Vraag'>
        </form>";
    } else {
        echo "Vraag niet gevonden.";
    }
} elseif (isset($_POST['update'])) {
    // Update de vraag in de database
    $stmt = $conn->prepare("UPDATE vragen_en_opties SET vraag = ?, antwoord1 = ?, antwoord2 = ?, antwoord3 = ?, antwoord4 = ? WHERE id = ?");
    $stmt->execute([$_POST['question'], $_POST['answer1'], $_POST['answer2'], $_POST['answer3'], $_POST['answer4'], $_POST['id']]);

    echo "Vraag bijgewerkt. <a href='manage_questions.php'>Terug naar beheer</a>";
}
?>