<?php
/**
    * User management class
    *
    * @author Emile ZIMMER
    */
class User{

    /**
        * Checking the session information of the active connection
        *
        * @param Object database connection
        *
        * @return int if the login information of the active user is valid, otherwise return the error
        *
        */
    public function UserSession($db){

    if
    (
        isset($_SESSION['id'])
        &&
        isset($_SESSION['type'])
        &&
        isset($_SESSION['full_name'])
        &&
        isset($_SESSION['email'])
        &&
        isset($_SESSION['identifier'])
        &&
        isset($_SESSION['user_key'])
        &&
        isset($_SESSION['asset'])
    )
    {

        $q = $db->prepare("SELECT * FROM users WHERE id=:id AND user_key=:user_key AND type=:type");
        $q->execute([
        'id' => $_SESSION['id'],
        'user_key' => $_SESSION['user_key'],
        'type' => $_SESSION['type']
        ]);

        $user = $q->fetch();

        if($user == TRUE){

            return 0;

        }else{

            return 3;

        }
    
    
    }
    elseif
    (
        isset($_SESSION['id'])
        ||
        isset($_SESSION['type'])
        ||
        isset($_SESSION['full_name'])
        ||
        isset($_SESSION['email'])
        ||
        isset($_SESSION['identifier'])
        ||
        isset($_SESSION['user_key'])
        ||
        isset($_SESSION['asset'])
    )
    {

        return 2;

    }else{

        return 1;

    }

    }



    /**
        * Checking the session information of the active connection
        *
        * @param Object database connection
        *
        * @return int if the login information of the active user is valid, otherwise return the error
        *
        */
    public function UserSessionAdmin($db){

        if
        (
            isset($_SESSION['id'])
            &&
            isset($_SESSION['type'])
            &&
            isset($_SESSION['full_name'])
            &&
            isset($_SESSION['email'])
            &&
            isset($_SESSION['identifier'])
            &&
            isset($_SESSION['user_key'])
            &&
            isset($_SESSION['asset'])
        )
        {
    
            $q = $db->prepare("SELECT * FROM users WHERE id=:id AND user_key=:user_key AND type=:type");
            $q->execute([
            'id' => $_SESSION['id'],
            'user_key' => $_SESSION['user_key'],
            'type' => 'admin'
            ]);
    
            $user = $q->fetch();
    
            if($user == TRUE){
    
                return 0;
    
            }else{
    
                return 3;
    
            }
    
    
        }
        elseif
        (
        isset($_SESSION['id'])
        ||
        isset($_SESSION['type'])
        ||
        isset($_SESSION['full_name'])
        ||
        isset($_SESSION['email'])
        ||
        isset($_SESSION['identifier'])
        ||
        isset($_SESSION['user_key'])
        ||
        isset($_SESSION['asset'])
        )
        {
    
            return 2;
    
        }else{
    
            return 1;
    
        }
    
    }



    /**
        * Adding a new user
        *
        * @param Object database connection
        *
        * @param array form register
        *
        * @param string $asset
        *
        * @param string $type
        *
        */
    public function UserRegister($db,$post,$asset,$type){

        $options = [
        'cost' => 12
        ];
                    
        $q = $db->prepare("INSERT INTO `users`(`type`,`photo`,`full_name`,`email`,`identifier`,`password`,`adress`,`city`,`zip_code`,`country`,`user_key`,`asset`) VALUES(:type,:photo,:full_name,:email,:identifier,:password,:adress,:city,:zip_code,:country,:user_key,:asset)");
        $q->execute([
            'type' => $type,
            'photo' => 'ressources/img/profile_picture.jpg',
            'full_name' => $post['post_full_name'],
            'email' => $post['post_email'],
            'identifier' => $post['post_identifier'],
            'password' => password_hash($post['post_password'], PASSWORD_BCRYPT, $options),
            'adress' => $post['post_adress'],
            'city' => $post['post_city'],
            'zip_code' => $post['post_zip_code'],
            'country' => $post['post_country'],
            'user_key' => md5(microtime(TRUE)*100000),
            'asset' => 'no'
            ]);
            
        if(!file_exists("uploads/users/" . $post['post_identifier'])){
                
            mkdir("uploads/users/" . $post['post_identifier']);

            }

            return 0;
        
        }



    /**
        * User session creation
        *
        * @param Object database connection
        *
        * @param array form login
        *
        * @return int if the information entered is valid create the session, otherwise return the corresponding error
        *
        */
    public function UserLogin($db,$post){

        $user = $this->getUser($db,$post);

        if($user == TRUE){

            if($user['asset'] == 'yes'){

                if(password_verify($post['post_password'], $user['password'])){

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['type'] = $user['type'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['identifier'] = $user['identifier'];
                    $_SESSION['user_key'] = $user['user_key'];
    
                    return 0;
            
                }else{
                    return 1;
                }
            
    
            }else{
    
                return 2;
    
            }

        }else{

            return 3;

        }
    
    }
    


    /**
        * Editing user information
        *
        * @param Object database connection
        *
        * @param array user information
        *
        * @param array post user information
        *
        */
    public function UserEdit($db,$user,$post){

            $options = [
            'cost' => 12
            ];

            $q = $db->prepare("UPDATE users SET full_name=:full_name, adress=:adress, city=:city, zip_code=:zip_code, country=:country WHERE id=:id");
            $q->execute([
                'id' => $user['id'],
                'full_namen'=> $post['post_full_name'],
                'adress'=> $post['post_adress'],
                'city'=> $post['post_city'],
                'zip_code'=> $post['post_zip_code'],
                'country'=> $post['post_country']
            ]);

            return 0;
    
        }
    


    /**
        * Editing user description information
        *
        * @param Object database connection
        *
        * @param array user information
        *
        * @param array post user information
        *
        */
    public function UserEditDescription($db,$user,$post,$themes,$interest,$music){

        $options = [
        'cost' => 12
        ];

        $q = $db->prepare("UPDATE users SET description=:description, themes=:themes, interest=:interest, music=:music WHERE id=:id");
        $q->execute([
        'id' => $user['id'],
        'description'=> $post['post_description'],
        'themes'=> $themes,
        'interest'=> $interest,
        'music'=> $music
        ]);

        return 0;

    }




    /**
        * Editing password user information
        *
        * @param Object database connection
        *
        * @param array user information
        *
        * @param array post password user information
        *
        */
    public function UserPasswordEdit($db,$user,$post){

            $options = [
            'cost' => 12
            ];
    
            $q = $db->prepare("UPDATE users SET password=:password WHERE id=:id");
            $q->execute([
            'password' => password_hash($post['post_password'], PASSWORD_BCRYPT, $options),
            'id' => $user['id']
            ]);
    
        }
    


    /**
        * Edit user account recovery information
        *
        * @param Object database connection
        *
        * @param array user information
        *
        */
    public function UserRecovery($db,$user){

            $q1 = $db->prepare("UPDATE users SET recovery_key=:recovery_key WHERE id=:id");
            $q1->execute([
            'recovery_key' => md5(microtime(TRUE)*100000),
            'id' => $user['id']
            ]);
    
            $q2 = $db->prepare("UPDATE users SET recovery_date=:recovery_date WHERE id=:id");
            $q2->execute([
            'recovery_date' => date('d-m-Y'),
            'id' => $user['id']
            ]);
    
        }



    /**
        * Delete user
        *
        * @param Object database connection
        *
        * @param array user information
        *
        * @return boolean if the user has not committed an accidental deletion else return the error
        *
        */
    public function UserDelete($db,$user){

        if($_SESSION['type'] <> 'admin')
        {

            $q = $db->prepare("DELETE FROM `users` WHERE id=:id");
            $q->execute([
            'id' => $user['id']
            ]);
        
            return 0;

        }else{

            return 1;

        }

    }



    /**
        * Banish user
        *
        * @param Object database connection
        *
        * @param array user information
        *
        * @return boolean if the user has not committed an accidental deletion else return the error
        *
        */
    public function UserBanish($db,$user){

        if($user['id'] != $_SESSION['id'])
        {
    
            $q = $db->prepare("UPDATE users SET asset=:asset WHERE id=:id");
            $q->execute([
            'asset' => 'banished',
            'id' => $post['id']
            ]);
        
            return 0;

        }else{

            return 1;

        }
    
        }


        
    /**
        * Retrieve user information
        *
        * @param Object database connection
        *
        * @param array post user information
        *
        */
    public function getUser($db,$post){

        if(isset($post['id'])){

        $q = $db->prepare("SELECT * FROM users WHERE id=:id");
        $q->execute([
        'id' => $post['id']
        ]);

        $user = $q->fetch();

        }elseif((isset($post['post_identifier'])) && (isset($post['post_email']))){

        $q = $db->prepare("SELECT * FROM users WHERE identifier=:identifier OR email=:email");
        $q->execute([
        'identifier' => $post['post_identifier'],
        'email' => $post['post_email']
        ]);

        $user = $q->fetch();

        }elseif(isset($post['post_identifier'])){

        $q = $db->prepare("SELECT * FROM users WHERE identifier=:identifier OR email=:email");
        $q->execute([
        'identifier' => $post['post_identifier'],
        'email' => $post['post_identifier']
        ]);

        $user = $q->fetch();

        }elseif(isset($post['post_email'])){

        $q = $db->prepare("SELECT * FROM users WHERE email=:email");
        $q->execute([
        'email' => $post['post_email']
        ]);

        $user = $q->fetch();

        }

        if($user == TRUE){

        return $user;

        }

    }



    /**
        * Retrieve user information asset
        *
        * @param Object database connection
        *
        * @param array post user information
        *
        */
    public function getUserAsset($db,$post){

        if(isset($post['id'])){

        $q = $db->prepare("SELECT * FROM users WHERE id=:id AND asset=:asset");
        $q->execute([
        'asset' => 'banished',
        'id' => $post['id']
        ]);

        $user = $q->fetch();

        }elseif((isset($post['post_identifier'])) && (isset($post['post_email']))){

        $q = $db->prepare("SELECT * FROM users WHERE identifier=:identifier OR email=:email AND asset=:asset");
        $q->execute([
        'identifier' => $post['post_identifier'],
        'email' => $post['post_email'],
        'asset' => 'banished'
        ]);

        $user = $q->fetch();

        }elseif(isset($post['post_identifier'])){

        $q = $db->prepare("SELECT * FROM users WHERE identifier=:identifier OR email=:email AND asset=:asset");
        $q->execute([
        'identifier' => $post['post_identifier'],
        'email' => $post['post_identifier'],
        'asset' => 'banished'
        ]);

        $user = $q->fetch();

        }elseif(isset($post['post_email'])){

        $q = $db->prepare("SELECT * FROM users WHERE email=:email AND asset=:asset");
        $q->execute([
        'email' => $post['post_email'],
        'asset' => 'banished'
        ]);

        $user = $q->fetch();

        }

        if($user == TRUE){

        return $user;

        }

    }
        

}

$User = new User();



?>