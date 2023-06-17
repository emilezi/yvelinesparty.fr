<?php

require 'functions/party.php';

$party = $Party->getParty($db,$_GET);

if($party == true){
    
    echo "<h1>".$party['name']."</h1>";
    echo "<img src='".$party['picture']."'>";
    echo "<p>".$party['description']."</p>";
    echo "<p>De : ".$party['of_date']." - Jusqu'à : ".$party['to_date']." - Nombre max de participant : ".$party['max_participants']."</p>";
    echo "<p>Catégorie : ".$party['category']." - Organisateur : ".$party['organizer']."</p>";

}else{

    echo "<h1>La soirée n'existe pas</h1>";
    echo "<p>La soirée n'existe pas, l'annonce a été désactivée ou supprimée</p>";

}

?>