<?php
include('opendb.php');

$fornavn = $_POST['fornavn'];
$efternavn = $_POST['efternavn'];
$fodtaar = $_POST['fodtaar'];

$sql = "INSERT INTO form_demo (fornavn, efternavn, fodtaar) VALUES ('" . $fornavn . "','" . $efternavn . "'," . $fodtaar . ")";

echo ("SQL-sætningen: ". $sql);

if($conn->query($sql)=== TRUE){
    echo "Data er gemt i databasen :-)";
}else{
    echo "Fejl: " . $sql . "<br>" . $conn->error . "<br>";
}

?>
