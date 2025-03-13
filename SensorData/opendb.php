<?php
$servername = "sql.itcn.dk:3306";
$username = "angr6.EADANIA"; // Brugernavn til databasen
$password = "2pFS222yqN"; // Adgangskode til databasen
$database = "angr6.EADANIA"; // Database som skal forbindes til, husk at det er det rigtige navn & nummer
// Create connection
$conn = new mysqli($servername, $username, $password, $database);


$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
die("Forbindelse mislykkedes: " . $conn->connect_error);
}
echo "Forbindelse oprettet<br>";
?>