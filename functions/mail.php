<?php
/**
    * Email management class
    *
    * @author Emile ZIMMER
    */
class Mail{

    /**
        * Send registration email
        *
        * @param array user information
        *
        */
    public function MailRegistration($user){

        $sujet = "yvelinesparty.fr - Activation de votre compte";
        $entete = "From: service@" . HTTP_HOST;
        
        $message = "Pour activer le compte, merci de cliquer sur ce lien
        
        https://" . HTTP_HOST . "/index.php?page=user&action=user_activation&get3=".urlencode($user['id_user'])."&get1=".urlencode($user['user_key'])."
        
        ---------------
        Ce mail est un mail automatique, merci de ne pas répondre";
        
        mail($user['email'], $sujet, $message, $entete);

    }



    /**
        * Send email update
        *
        * @param array user information
        *
        */
        public function MailUpdate($user){
    
            $sujet = "yvelinesparty.fr - Recupération de votre compte";
            $entete = "From: service@" . HTTP_HOST;
            
            $message = "Pour modifier l'email du compte, merci de cliquer sur ce lien
            
            https://" . HTTP_HOST . "/index.php?page=user_password_recovery&get1=".urlencode($user['user_key'])."&get2=".urlencode($user['recovery_key'])."
            
            ---------------
            Ce mail est un mail automatique, merci de ne pas répondre";
            
            mail($user['email'], $sujet, $message, $entete);
    
        }



    /**
        * Send password recovery email
        *
        * @param array user information
        *
        */
    public function MailRecovery($user){
    
        $sujet = "yvelinesparty.fr - Recupération de votre compte";
        $entete = "From: service@" . HTTP_HOST;
        
        $message = "Pour recupérer votre compte, merci de cliquer sur ce lien
        
        https://" . HTTP_HOST . "/index.php?page=user_password_recovery&get1=".urlencode($user['user_key'])."&get2=".urlencode($user['recovery_key'])."
        
        ---------------
        Ce mail est un mail automatique, merci de ne pas répondre";
        
        mail($user['email'], $sujet, $message, $entete);

    }


    /**
        * Send feedback email
        *
        * @param array comment information
        *
        */
    public function sendFeedbackMail($comment,$post){
    
        $sujet = "yvelinesparty.fr - Retour : " . $comment['topic'];
        $entete = "From: administrateur@" . HTTP_HOST;
        
        $message = $post['post_response'];
        
        mail($comment['email'], $sujet, $message, $entete);

    }

}

$Mail = new Mail();

?>