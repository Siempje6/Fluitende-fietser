<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("header2.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=studenten", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $naam = $_POST["naam"];
        $leeftijd = $_POST["leeftijd"];
        $land = $_POST["land"];
        $geslacht = $_POST["geslacht"];
        $leerjaar = $_POST["leerjaar"];
        $studentnummer = $_POST["studentnummer"];
    
        $query = "UPDATE student SET naam='$naam', leeftijd='$leeftijd', land='$land', geslacht='$geslacht' 
                  WHERE studentnummer='$studentnummer' AND naam='$naam'";
        
    
        if ($conn->query($query) === TRUE) {
            echo "Nieuwe wijzegingen succesvol aangepast";
        } else {
            echo "Fout bij het bijwerken van de aanpassingen: ";
        }  
    } 
    ?>
    <form action="insert.php" method="POST">
    <label for="Naam">Naam:</label><br>
    <input type="text" id="naam" name="naam" required pattern="[A-Za-z ]+"><br>

    <label for="Leeftijd">Leeftijd:</label><br>
    <input type="number" id="leeftijd" name="leeftijd" required min="1" max="99"><br>

    <select type="text" id="land" name="land" required pattern="[A-Za-z ]+">
        <option value="Ned">Nederland</option>
        <option value="Bel">Belgie</option>
        <option value="Dui">Duitsland</option>
        <option value="Eng">Engeland</option>
        <option value="Fra">Frankrijk</option>
        <option value="Spa">Spanje</option>
    </select><br>
    <label for="Leeftijd">Geslacht:</label><br>
    <select type="text" id="geslacht" name="geslacht" required pattern="[A-Za-z ]+">
        <option value="Man">Man</option>
        <option value="Vrouw">Vrouw</option>
    </select><br>

    <label for="leerjaar">Leerjaar:</label><br>
    <input type="number" id="leerjaar" name="leerjaar" required min="1" max="6"><br>

    <label for="studentnummer">Studentnummer:</label><br>
    <input type="text" id="studentnummer" name="studentnummer" required pattern="PS\d{6}"><br>

    <input type="submit" value="Toevoegen">
</form>
</body>
</html>