<?php
/**
    *
    * Create new user
    *
    */

if(isset($_POST['submit_register'])){

    require 'functions/form.php';

    if($Form->FormRegisterCheck($_POST) == 0){

        if($User -> getUserIdentifierAndEmail($db,$_POST) == false){

            $User -> UserRegister($db,$_POST,"user");

            header('Location: index.php?page=user');

        }else{



        }

    }else{



    }
    
}