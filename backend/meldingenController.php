<?php

//Variabelen vullen

$action = $_POST['action'];

if($action == "create")
{
    $attractie = $_POST['attractie'];
    if(empty($_POST['attractie']))
    {
        $errors[]="Vul de attractie-naam in.";
    }

    $capaciteit = $_POST['capaciteit'];
    if(!is_numeric($_POST['capaciteit']))
    {
        $errors[]="Vul een geldig getal in in.";
    } 
    $type = $_POST['type'];
    if(empty($_POST['type']))
    {
        $errors[]="Vul het type in.";
    }
    if(isset($_POST['prioriteit']))
    {
        $prioriteit = True;
    }
    else
    {
        $prioriteit = False;
    }
    $melder = $_POST['melder'];
    if(empty($_POST['melder']))
    {
        $errors[]="Vul naam in.";
    }
    $overig = $_POST['overig'];

    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    //1. Verbinding
    require_once 'conn.php';


    //2. Query
    $query = "INSERT INTO meldingen (attractie, capaciteit, melder, type, overige_info, prioriteit)
    VALUES(:attractie, :capaciteit, :melder, :type, :overige_info, :prioriteit)";

    $statement = $conn->prepare($query);

    $statement->execute([
        ":attractie" => $attractie,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":type" => $type,
        ":overige_info" => $overig,  
    ]);



    header("Location:../meldingen/index.php?msg=Meldingopgeslagen");
}

if($action == "update")
{
    $capaciteit = $_POST['capaciteit'];
    $prioriteit = $_POST['prioriteit'];
    $melder = $_POST['melder'];
    $overig = $_POST['overige_info'];


    require_once 'conn.php';

    $query = "UPDATE meldingen SET capaciteit = :capaciteit, attractie = :attractie, prioriteit = :prioriteit, melder = :melder, type = :type, 
              overig = :overige_info, WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig,
        ":id" => $id  
    ])

    header("Location:../meldingen/index.php?msg=Meldingopgeslagen");
}