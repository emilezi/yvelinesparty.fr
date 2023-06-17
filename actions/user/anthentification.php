<?php
/**
    *
    * User authentication
    *
    */

if(isset($_POST['submit_login'])){

    require 'functions/form.php';

    if($Form->FormLoginCheck($_POST) == 0){

        if($User -> UserLogin($db,$_POST) == 0){

            $User -> UserLogin($db,$_POST);

            header('Location: index.php?page=user');

        }elseif($User -> UserLogin($db,$_POST) == 1){



        }else{

            

        }

    }elseif($Form->FormLoginCheck($_POST) == 1){

        
    
    }
    
}