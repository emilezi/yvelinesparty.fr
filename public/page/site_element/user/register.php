<?php

require 'actions/user/new_user.php';

?>

<h3>Inscription</h3>

<form method='post'>
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_first_name' type="text" placeholder="Entrez votre prénom" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_last_name' type="text" placeholder="Entrez votre nom de famille" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_email' type="email" placeholder="Entrez votre adresse email" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_phone' type="text" placeholder="Entrez votre numéro de téléphone" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_identifier' type="text" placeholder="Entrez votre nom d'utilisateur" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_password' type="password" placeholder="Créez votre mot de passe" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_rpassword' type="password" placeholder="Réécrivez votre mot de passe" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_country' type="text" placeholder="Choisissez votre pays d'origine" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_adress' type="text" placeholder="Entrez votre adresse de résidence" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_city' type="text" placeholder="Entrez le nom de votre ville" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_zip_code' type="text" placeholder="Entrez votre code postal" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-small" name='submit_register' type="submit" value="Valider">
        </div>

        <a href='index.php?page=user'><p>Retour</p></a>

    </fieldset>
</form>