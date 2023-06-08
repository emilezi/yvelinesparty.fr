<?php
/**
    * Cookie management class.
    *
    * @author Emile ZIMMER
    */
class Cookie{

    /**
        * Create a cookie
        *
        * @param array form post user information
        */
    public function setCookie($post){

        setcookie("id_user", $post['id_user'], time()+3600*24*14);
		setcookie("full_name", $post['full_name'], time()+3600*24*14);
		setcookie("identifier", $post['identifier'], time()+3600*24*14);
		setcookie("email", $post['email'], time()+3600*24*14);
    
    }
    
    /**
        * Cookie authentication
        */
    public function CookieLogin(){

        if(
            isset($_COOKIE['id_user'])
             && 
             isset($_COOKIE['full_name'])
             && 
             isset($_COOKIE['identifier'])
             &&
             isset($_COOKIE['email'])
            )
        {
        
        $_SESSION['id_user'] = $_COOKIE['id_user'];
        $_SESSION['full_name'] = $_COOKIE['full_name'];
        $_SESSION['identifier'] = $_COOKIE['identifier'];
        $_SESSION['email'] = $_COOKIE['email'];
        

    }
    
    }

    /**
        * Cookie deletion
        */
    public function CookieDestroy(){

        setcookie("id_user", "false", (time()-3600*24*14));
        setcookie("full_name", "false", (time()-3600*24*14));
        setcookie("identifier", "false", (time()-3600*24*14));
        setcookie("email", "false", (time()-3600*24*14));
    
    }

}

$Cookie = new Cookie();

?>