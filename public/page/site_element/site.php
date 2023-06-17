<?php

$q = $db->prepare("SELECT * FROM partys WHERE asset=:asset");
$q->execute([
    'asset' => 'asset'
    ]);

    if($q->rowCount() > 0){

        while($list_party = $q->fetch(PDO::FETCH_ASSOC)){
    
            echo "<div class='uk-child-width-1-2@s uk-grid-match' uk-grid>
                <a href='index.php?page=views_party&party=".$list_party['id']."'>
                    <div class='uk-card uk-card-default uk-card-hover uk-card-body'>
                    <h3 class='uk-card-title'>".$list_party['name']."</h3>
                    <p>".$list_party['description']."</p>
                    </div>
                </a>
            </div>";
                    
        }
    
    }else{

        echo "<div class='uk-child-width-1-2@s uk-grid-match' uk-grid>
        <div>
            <div class='uk-card uk-card-default uk-card uk-card-body'>
            <h3 class='uk-card-title'>Pas de fêtes pour le moment</h3>
            <p>Pas de soirées à organiser pour le moment. Soyez le premier à organiser votre soirée</p>
            </div>
        </div>
        </div>";

    }
