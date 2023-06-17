<?php

require 'actions/user/password_recovery.php';

?>

<h3>Mot de passe oublié ?</h3>

<form method='post'>
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <input class="uk-input uk-form-width-large" name='post_email' type="email" placeholder="Entrez votre adresse email" require>
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-small" name='submit_recovery' type="submit" value="Valider">
        </div>

        <a href='index.php?page=user'><p>Retour</p></a>

    </fieldset>
</form>