<?php
$fornavn = $_POST['fornavn'];
$efternavn = $_POST['efternavn'];
$fodtaar = $_POST['fodtaar'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP test</title>
    </head>
    <body>
        <H1> Der skal laves en beregning</H1>
        <p>Og der skal vises et resultat</p>
        <?php
        $aktueltAar = date("Y");
        $x_aar = $aktueltAar - $fodtaar;

        echo "Hej " . $fornavn . " " . $efternavn . ", du fylder " . $x_aar . " år i " . $aktueltAar;
        ?>
    </body>
</html>