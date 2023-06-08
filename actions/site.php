<?php
/**
    *
    * This file contains all the function calls concerning the verification of the database, the verification of the active user and contains all the redirections of the application
    *
    */

include 'public/page/page_element/high_page.php';

if ($Database->CheckConnection() == 0) {

    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=yvelinesparty.fr", USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    global $db;

    if($Database->CheckTables($db) == 0){

        session_start();
    
        if($User->UserSession($db) == 0)
        {
    
            require 'functions/ip.php';
    
            $IP->getConnection($db);
    
            include 'public/page/page_element/nav_bar.php';
    
            if(isset($_GET['page']) && !empty($_GET['page'])){

                if($_SESSION['type'] == 'admin' && $_GET['page'] == "admin"){
            
                    require 'public/page/site_element/admin/admin.php';
                                
                }elseif($_SESSION['type'] == 'admin' && $_GET['page'] == "comments"){
            
                    require 'public/page/site_element/admin/comments.php';
                                
                }elseif($_SESSION['type'] == 'admin' && $_GET['page'] == "reporting"){
                
                    require 'public/page/site_element/admin/reporting.php';
                
                }elseif($_SESSION['type'] == 'admin' && $_GET['page'] == "statistics"){
                
                    require 'public/page/site_element/admin/statistics.php';
                
                }elseif($_SESSION['type'] == 'admin' && $_GET['page'] == "user"){
                
                    require 'public/page/site_element/admin/user.php';
                
                }elseif($_GET['page'] == "message"){
            
                    require 'public/page/site_element/discussions/message.php';
                                
                }elseif($_GET['page'] == "edit_party"){
            
                    require 'public/page/site_element/party/edit_party.php';
                                
                }elseif($_GET['page'] == "my_party"){
                
                    require 'public/page/site_element/party/my_party.php';
                
                }elseif($_GET['page'] == "new_party"){
                
                    require 'public/page/site_element/party/new_party.php';
                
                }elseif($_GET['page'] == "views_party"){
                
                    require 'public/page/site_element/party/views_party.php';
                
                }elseif($_GET['page'] == "password_edit"){
            
                    require 'public/page/site_element/user/password_edit.php';
                                
                }elseif($_GET['page'] == "user_banished"){
                
                    require 'public/page/site_element/user/user_banished.php';
                
                }elseif($_GET['page'] == "user_edit"){
                
                    require 'public/page/site_element/user/user_edit.php';
                
                }elseif($_GET['page'] == "user"){
                
                    require 'public/page/site_element/user/user.php';
                
                }else{

                    require 'public/page/site_element/site.php';
                }
            
            }elseif(isset($_GET['q']) && !empty($_GET['q'])){
                    
                require 'public/page/site_element/search.php';
            
            }else{
            
                require 'public/page/site_element/site.php';
            
            }
            
    
        }elseif($User->UserSession($db) == 1){
    
            include 'public/page/page_element/nav_bar.php';
    
            if(isset($_GET['page']) && !empty($_GET['page'])){
    
                if($_GET['page'] == "views_party"){
                
                    require 'public/page/site_element/party/views_party.php';
                
                }elseif($_GET['page'] == "password_recovery"){
            
                    require 'public/page/site_element/user/password_recovery.php';
                                
                }elseif($_GET['page'] == "register"){
                
                    require 'public/page/site_element/user/register.php';
                
                }elseif($_GET['page'] == "user"){
                
                    require 'public/page/site_element/user/user.php';
                
                }else{

                    require 'public/page/site_element/site.php';

                }
            
            }elseif(isset($_GET['q']) && !empty($_GET['q'])){
                    
                require 'public/page/site_element/search.php';
            
            }else{
            
                require 'public/page/site_element/site.php';
            
            }
    
        }elseif($User->UserSession($db) == 2){
    
            session_destroy();
    
            header('Location: index.php');
    
        }elseif($User->UserSession($db) == 3){
    
            session_destroy();
    
            header('Location: index.php');
    
        }
    
    }else{
    
    
        $Database->addTables($db);
    
        header('Location: index.php');
    
    }

}else{

    

}

include 'public/page/page_element/down_page.php';

?>