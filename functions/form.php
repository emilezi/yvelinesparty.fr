<?php
/**
    * Form verification class
    *
    * @author Emile ZIMMER
    */
class Form{
    
    /**
        * Verification of fields entered for the registration of a new user
        *
        * @param array form post register information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormRegisterCheck($post){

            if(
            !empty($post['post_first_name'])
            &&
            !empty($post['post_last_name'])
            &&
            !empty($post['post_email'])
            &&
            !empty($post['post_phone'])
            &&
            !empty($post['post_identifier'])
            &&
            !empty($post['post_adress'])
            &&
            !empty($post['post_city'])
            &&
            !empty($post['post_zip_code'])
            &&
            !empty($post['post_country'])
            &&
            !empty($post['post_password'])
            &&
            !empty($post['post_rpassword'])
            )
            {
                if(
                preg_match("#^[^<>]+$#i", $post['post_first_name'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_last_name'])
                &&
                preg_match("#^[a-z0-9.]+@[a-z0-9.]+$#i", $post['post_email'])
                &&
                preg_match("#^[0-9]+$#i", $post['post_phone'])
                &&
                preg_match("#^[a-z0-9]+$#i", $post['post_identifier'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_adress'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_city'])
                &&
                preg_match("#^[a-z0-9]+$#i", $post['post_zip_code'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_country'])
                )
                {

                    return 0;

                }else{

                    return 1;

                }
            }else{

                return 2;
    
            }
    
        }



    /**
        * Verification of fields entered for the login of user
        *
        * @param array form post login information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormLoginCheck($post){

        if(
            !empty($post['post_identifier'])
            &&
            !empty($post['post_password'])
            )
        {
            if(preg_match("#^[^<>]+$#i", $post['post_identifier']))
            {
                return 0;
            }else{
                return 1;
            }
        }else{
            return 2;
        }


    }



    /**
        * Verification of fields entered for the edit of user
        *
        * @param array form post edit user information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormEditUserCheck($post){

            if(
            !empty($post['post_first_name'])
            &&
            !empty($post['post_last_name'])
            &&
            !empty($post['post_phone'])
            &&
            !empty($post['post_adress'])
            &&
            !empty($post['post_city'])
            &&
            !empty($post['post_zip_code'])
            &&
            !empty($post['post_country'])
            )
            {
            if(
                preg_match("#^[^<>]+$#i", $post['post_first_name'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_last_name'])
                &&
                preg_match("#^[0-9]+$#i", $post['post_phone'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_adress'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_city'])
                &&
                preg_match("#^[a-z0-9]+$#i", $post['post_zip_code'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_country'])
                )
                {
                    return 0;
                }else{
                    return 1;
                }
            }else{
                return 2;
    
            }
    
        }



    /**
        * Verification of the fields entered for the registered party
        *
        * @param array news partys information form
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormRegisterPartyCheck($post){

        if(
            !empty($post['post_name'])
            &&
            !empty($post['post_category'])
            &&
            !empty($post['post_description'])
            &&
            !empty($post['post_themes'])
            &&
            !empty($post['post_interest'])
            &&
            !empty($post['post_music'])
            &&
            !empty($post['post_place'])
            &&
            !empty($post['post_address'])
            &&
            !empty($post['post_of_date'])
            &&
            !empty($post['post_to_date'])
            &&
            !empty($post['post_max_participants'])
            )
            {
            if(
                preg_match("#^[^<>]+$#i", $post['post_name'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_category'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_description'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_themes'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_interest'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_music'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_place'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_address'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_of_date'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_to_date'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_max_participants'])
                )
                {
                    return 0;
                }else{
                    return 1;
                }
            }else{
                return 2;
    
            }

        }



    /**
        * Verification of the fields entered for the editing party
        *
        * @param array form post editing party information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormEditPartyCheck($post){

        if(
            !empty($post['post_name'])
            &&
            !empty($post['post_description'])
            &&
            !empty($post['post_place'])
            &&
            !empty($post['post_address'])
            &&
            !empty($post['post_of_date'])
            &&
            !empty($post['post_to_date'])
            &&
            !empty($post['post_max_participants'])
            )
            {
            if(
                preg_match("#^[^<>]+$#i", $post['post_name'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_description'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_place'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_address'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_of_date'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_to_date'])
                &&
                preg_match("#^[^<>]+$#i", $post['post_max_participants'])
                )
                {
                    return 0;
                }else{
                    return 1;
                }
            }else{
                return 2;
    
            }

        }



    /**
        * Verification of fields entered for the identifier
        *
        * @param array form post Identifier information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormIdentifierCheck($post){

            if(!empty($post['post_identifier']))
            {
                if(preg_match("#^[a-z0-9.]+@[a-z0-9.]+$#i", $post['post_identifier']))
                {
                    return 0;
                }else{
                    return 1;
                }
            }else{
                return 2;
    
            }
    
        }



    /**
        * Verification of fields entered for the email address
        *
        * @param array form post email information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormEmailCheck($post){

        if(!empty($post['post_email']))
        {
            if(preg_match("#^[a-z0-9.]+@[a-z0-9.]+$#i", $post['post_email']))
            {
                return 0;
            }else{
                return 1;
            }
        }else{
            return 2;

        }

    }



    /**
        * Verification of fields entered for password verification
        *
        * @param array form post password information
        *
        * @return int if the fields are correctly filled in otherwise return the error number
        *
        */
    public function FormPasswordCheck($post){

        if(
            !empty($post['post_password'])
            &&
            !empty($post['post_rpassword'])
            ){

        if($post['post_password'] == $post['post_rpassword']){

            return 0;

        }else{

            return 1;

        }

    }else{

        return 2;

    }
    
    }

}

$Form = new Form();

?>