<?php
/**
    *
    * Send email for account recovery
    *
    */

if(isset($_POST['submit_recovery'])){

    require 'functions/form.php';
    require 'functions/mail.php';

    if($Form->FormEmailCheck($_POST) == 0){

        $user = $User->getUserEmail($db,$_POST);

        if($user == TRUE){

            $User -> UserRecovery($db,$user);

            $user = $User -> getUserEmail($db,$_POST);

            $Mail -> MailRecovery($user);

        }else{


            
        }

    }elseif($Form->FormEmailCheck($_POST) == 1){


    
    }
    
}