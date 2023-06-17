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
        isset($_SESSION['first_name'])
        &&
        isset($_SESSION['last_name'])
        &&
        isset($_SESSION['email'])
        &&
        isset($_SESSION['phone'])
        &&
        isset($_SESSION['identifier'])
        &&
        isset($_SESSION['user_key'])
        &&
        isset($_SESSION['asset'])
    )
    {

        $q = $db->prepare("SELECT * FROM users WHERE id=:id AND type=:type AND user_key=:user_key");
        $q->execute([
        'id' => $_SESSION['id'],
        'type' => $_SESSION['type'],
        'user_key' => $_SESSION['user_key']
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
        isset($_SESSION['first_name'])
        ||
        isset($_SESSION['last_name'])
        ||
        isset($_SESSION['email'])
        ||
        isset($_SESSION['phone'])
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
            isset($_SESSION['first_name'])
            &&
            isset($_SESSION['last_name'])
            &&
            isset($_SESSION['email'])
            &&
            isset($_SESSION['phone'])
            &&
            isset($_SESSION['identifier'])
            &&
            isset($_SESSION['user_key'])
            &&
            isset($_SESSION['asset'])
        )
        {
    
            $q = $db->prepare("SELECT * FROM users WHERE id=:id AND type=:type AND user_key=:user_key");
            $q->execute([
            'id' => $_SESSION['id'],
            'type' => $_SESSION['type'],
            'user_key' => $_SESSION['user_key']
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
            isset($_SESSION['first_name'])
            ||
            isset($_SESSION['last_name'])
            ||
            isset($_SESSION['email'])
            ||
            isset($_SESSION['phone'])
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
    public function UserRegister($db,$post,$type){

        $options = [
        'cost' => 12
        ];
                    
        $q = $db->prepare("INSERT INTO `users`(`type`,`picture`,`first_name`,`last_name`,`email`,`phone`,`identifier`,`password`,`adress`,`city`,`zip_code`,`country`,`user_key`,`asset`) VALUES(:type,:picture,:first_name,:last_name,:email,:phone,:identifier,:password,:adress,:city,:zip_code,:country,:user_key,:asset)");
        $q->execute([
            'type' => $type,
            'picture' => 'ressources/img/profile_picture.jpg',
            'first_name' => $post['post_first_name'],
            'last_name' => $post['post_last_name'],
            'email' => $post['post_email'],
            'phone' => $post['post_phone'],
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

        $user = $this->getUserIdentifier($db,$post);

        if($user == TRUE){

            if($user['asset'] == 'yes'){

                if(password_verify($post['post_password'], $user['password'])){

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['type'] = $user['type'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['phone'] = $user['phone'];
                    $_SESSION['identifier'] = $user['identifier'];
                    $_SESSION['user_key'] = $user['user_key'];
                    $_SESSION['asset'] = $user['asset'];
    
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

            $q = $db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, phone=:phone, adress=:adress, city=:city, zip_code=:zip_code, country=:country WHERE id=:id");
            $q->execute([
                'id' => $user['id'],
                'first_name' => $post['post_first_name'],
                'last_name' => $post['post_last_name'],
                'phone' => $post['post_phone'],
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
        * Retrieve user information asset by identifier and email
        *
        * @param Object database connection
        *
        * @param array post user information
        *
        */
    public function getUserIdentifierAndEmail($db,$post){

        if(isset($post['post_identifier']) && isset($post['post_email'])){

            $q = $db->prepare("SELECT * FROM users WHERE identifier=:identifier OR email:email");
            $q->execute([
            'identifier' => $post['post_identifier'],
            'email' => $post['post_email']
            ]);

            $user = $q->fetch();

            if($user == TRUE){

            return $user;

            }
        }
    }



    /**
        * Retrieve user information asset by identifier
        *
        * @param Object database connection
        *
        * @param array post user information
        *
        */
    public function getUserIdentifier($db,$post){

        if(isset($post['post_identifier'])){

            $q = $db->prepare("SELECT * FROM users WHERE email=:email OR identifier=:identifier AND asset=:asset");
            $q->execute([
            'email' => $post['post_identifier'],
            'identifier' => $post['post_identifier'],
            'asset' => 'yes'
            ]);

            $user = $q->fetch();

            if($user == TRUE){

            return $user;

            }
        }
    }



    /**
        * Retrieve user information asset by email
        *
        * @param Object database connection
        *
        * @param array post user information
        *
        */
    public function getUserEmail($db,$post){

        if(isset($post['post_email'])){

            $q = $db->prepare("SELECT * FROM users WHERE email=:email AND asset=:asset");
            $q->execute([
            'email' => $post['post_email'],
            'asset' => 'yes'
            ]);

            $user = $q->fetch();

            if($user == TRUE){

            return $user;

            }
        }
    }



    /**
        * Retrieve user information asset by id
        *
        * @param Object database connection
        *
        * @param array post user information
        *
        */
    public function getUserId($db,$post){

        if(isset($post['id'])){

            $q = $db->prepare("SELECT * FROM users WHERE id=:id");
            $q->execute([
            'id' => $post['id']
            ]);

            $user = $q->fetch();

            if($user == TRUE){

            return $user;

            }
        }
    }

}

$User = new User();



?>