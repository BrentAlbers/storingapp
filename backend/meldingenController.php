<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit']; 
$melder = $_POST['melder'];
$type = $_POST['type'];

echo $attractie . " / " . $capaciteit . " / " . $melder . " / " $type;

if(isset($_POST['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, capaciteit, melder, type)
VALUES(:attractie, :capaciteit, :melder, :type);
//3. Prepare
$statement = $conn->prepare($query);
//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":type" => $type,
]);

$type = $_post['type']

echo $type;

header("Location:../meldingen/index.php?msg=Meldingopgeslagen");