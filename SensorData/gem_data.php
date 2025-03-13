<?php
    include("opendb.php");

    $sensor =   $_POST['sensor'];
    $location = $_POST['location'];
    $value =    $_POST['value'];
    $remark =   $_POST['remark'];
    
    $sql = "insert into sensordata (sensor, location, value, remark) values ('" . $sensor . "', '" . $location . "', ". $value.",  '".$remark."')"; 

    echo("SQL-sætningen: " . $sql . "<br>");

    if ($conn->query($sql) === TRUE) {
        echo "Data er gemt i databasen :-) ";
    } else {
        echo "Fejl: " . $sql . "<br>" . $conn->error . "<br>";
    }

?>
