<?php
/**
    * Party management class
    *
    * @author Emile ZIMMER
    */
class Party{

    /**
        * Adding a new party
        *
        * @param Object database connection
        *
        * @param array form party register
        *
        * @param array user information
        *
        */
    public function NewParty($db,$user,$post,$picture,$themes,$interest,$music){
                        
            $q = $db->prepare("INSERT INTO `partys`(`name`, `organizer`, `category`, `picture`, `description`, `themes`, `interest`, `music`, `place`, `address`, `of_date`, `to_date`, `max_participants`, `asset`) VALUES(:name,:organizer,:category,:picture,:description,:themes,:interest,:music,:place,:address,:of_date,:to_date,:max_participants,:asset)");
            $q->execute([
                'name' => $post['name'],
                'organizer' => $user['identifier'],
                'category' => $post['category'],
                'picture' => $picture,
                'description' => $post['description'],
                'themes' => $themes,
                'interest' => $interest,
                'music' => $music,
                'place' => $post['place'],
                'address' => $post['address'],
                'of_date' => $post['of_date'],
                'to_date' => $post['to_date'],
                'max_participants' => $post['max_participants'],
                'asset' => 'asset'
            ]);

            return 0;
            
        }



    /**
        * Modify the information of an existing party
        *
        * @param Object database connection
        *
        * @param array form edit party
        *
        * @param array user information
        *
        */
    public function EditParty($db,$party,$post){
                        
        $q = $db->prepare("UPDATE partys SET name=:name, description=:description, place=:place, address=:address, of_date=:of_date, to_date=:to_date, max_participants=:max_participants WHERE id=:id");
        $q->execute([
            'id' => $party['id'],
            'name' => $post['name'],
            'description' => $post['description'],
            'place' => $post['place'], 
            'address' => $post['address'],
            'of_date' => $post['of_date'],
            'to_date' => $post['to_date'],
            'max_participants' => $post['max_participants']
        ]);

        return 0;
        
    }



    /**
        * Modify the information of an existing party
        *
        * @param Object database connection
        *
        * @param array image editing form party
        *
        * @param array user information
        *
        */
    public function EditPictureParty($db,$party,$picture){
                        
            $q = $db->prepare("UPDATE partys SET picture=:picture WHERE id=:id");
            $q->execute([
                'id' => $party['id'],
                'picture' => $picture
            ]);
    
            return 0;
            
        }
    


    /**
        * Delete party
        *
        * @param Object database connection
        *
        * @param array user information
        *
        * @return boolean if the user has not committed an accidental deletion else return the error
        *
        */
    public function PartyDelete($db,$party){
    
        $q = $db->prepare("DELETE FROM `partys` WHERE id=:id");
        $q->execute([
        'id' => $party['id']
        ]);

    }

}

$Party = new Party();

?>