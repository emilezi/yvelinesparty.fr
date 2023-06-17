<?php

require 'actions/user/anthentification.php';

?>

<h3>Authentification</h3>

<form method='post'>
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_identifier' type="text" placeholder="Nom d'utilisateur ou adresse e-mail" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_password' type="password" placeholder="Mot de passe" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-small" name='submit_login' type="submit" value="Connexion">
        </div>

        <p><a href='index.php?page=user_register'>Vous n'avez pas encore de compte ?</a></p>
        <p><a href='index.php?page=password_recovery'>Mot de passe oublié ?</a></p>

    </fieldset>
</form>