<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    include("header.php");
    ?>
    <form id="mijnFormulier" method="POST">
        <input type="submit" id="volgordeHL" name="volgordeHL" value="Leeftijdvolgorde aanpassen">
    </form>
    <link rel="stylesheet" href="css/styles.css">
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studenten";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if(isset($_POST['volgordeHL'])) {
        mijnFunctie(); 
    } 

    function mijnFunctie() {
        global $conn;
        if(!isset($_SESSION['Counter'])) {
            $_SESSION['Counter'] = 0; 
        }
        $_SESSION['Counter']++; 
        //echo "De waarde van de teller is: " . $_SESSION['Counter'];

        if ($_SESSION['Counter'] == 1) {
            $result = $conn->query("SELECT * FROM `student`");
        } 
        if ($_SESSION['Counter'] == 2) {
            $result = $conn->query("SELECT * FROM `student` ORDER BY leeftijd ASC");
        }
        if ($_SESSION['Counter'] == 3) {
            $result = $conn->query("SELECT * FROM `student` ORDER BY leeftijd DESC");
        }
        if ($_SESSION['Counter'] == 3) {
            $_SESSION['Counter'] = 0;
        }

        echo "<table border='1'>";
        echo '<tr><th>Naam</th><th>Leeftijd</th><th>Land</th><th>Geslacht</th><th>Aanpassen</th></tr>';

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row["naam"] . "</td>";
            echo "<td>" . $row["leeftijd"] . "</td>";
            echo "<td>" . $row["land"] . "</td>";
            echo "<td>" . $row["geslacht"] . "</td>";
            echo "<td>" . "<a href='Aanpassen.php?id=" . $row["id"] . "'>Aanpassen</a>" . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</body>
</html>
