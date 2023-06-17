<?php
/**
    * Class database management
    *
    * @author Emile ZIMMER
    */
class Database{

    /**
        * Check database server connection
        *
        * @return boolean whether a connection to the database server is possible
        */
    public function CheckConnection(){

        try{

            $db = new PDO("mysql:host=" . DB_HOST . ";", USER, PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return 0;

        }catch(PDOException $e){

            return 1;

        }

    }

    /**
        * Creation of the zimhosting database if it does not exist
        */
    public function CreateDatabases(){

        $db = new PDO("mysql:host=" . DB_HOST . ";", USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "CREATE DATABASE IF NOT EXISTS `zimhosting`";
        $db->exec($q);

    }

    /**
        *
        * @param Object database connection
        *
        * Creation of the tables in the zimhosting database
        */
    public function addTables($db){

        $q = $db->prepare("
        SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
        START TRANSACTION;
        SET time_zone = '+00:00';

        DROP TABLE IF EXISTS `approvals`;
        CREATE TABLE IF NOT EXISTS `approvals` (
        `id` int NOT NULL AUTO_INCREMENT,
        `id_user` int NOT NULL,
        `id_party` int NOT NULL,
        `statue` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `bans`;
        CREATE TABLE IF NOT EXISTS `bans` (
        `id` int NOT NULL AUTO_INCREMENT,
        `type` varchar(255) NOT NULL,
        `id_original_user` int NOT NULL,
        `id_banned_user` int NOT NULL,
        `description` varchar(255) NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `comments`;
        CREATE TABLE IF NOT EXISTS `comments` (
        `id` int NOT NULL AUTO_INCREMENT,
        `full_name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `advice` varchar(255) NOT NULL,
        `answered` varchar(255) NOT NULL,
        `answer` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `connections`;
        CREATE TABLE IF NOT EXISTS `connections` (
        `id` int NOT NULL AUTO_INCREMENT,
        `id_user` int NOT NULL,
        `ip` varchar(255) NOT NULL,
        `appareil` varchar(255) NOT NULL,
        `navigateur` varchar(255) NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `discussions`;
        CREATE TABLE IF NOT EXISTS `discussions` (
        `id` int NOT NULL AUTO_INCREMENT,
        `id_transmitter` int NOT NULL,
        `id_recipient` int NOT NULL,
        `message` varchar(255) NOT NULL,
        `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `partys`;
        CREATE TABLE IF NOT EXISTS `partys` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `organizer` varchar(255) NOT NULL,
        `category` varchar(255) NOT NULL,
        `picture` varchar(255) NOT NULL,
        `description` varchar(255) NOT NULL,
        `themes` varchar(255) NOT NULL,
        `interest` varchar(255) NOT NULL,
        `music` varchar(255) NOT NULL,
        `place` varchar(255) NOT NULL,
        `address` varchar(255) NOT NULL,
        `of_date` varchar(255) NOT NULL,
        `to_date` varchar(255) NOT NULL,
        `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `max_participants` int NOT NULL,
        `asset` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `reports`;
        CREATE TABLE IF NOT EXISTS `reports` (
        `id` int NOT NULL AUTO_INCREMENT,
        `id_author` int NOT NULL,
        `type` varchar(255) NOT NULL,
        `description` varchar(255) NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `searchs`;
        CREATE TABLE IF NOT EXISTS `searchs` (
        `id` int NOT NULL AUTO_INCREMENT,
        `author` varchar(255) NOT NULL,
        `category` varchar(255) NOT NULL,
        `element` varchar(255) NOT NULL,
        `link` varchar(255) NOT NULL,
        `type` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        DROP TABLE IF EXISTS `users`;
        CREATE TABLE IF NOT EXISTS `users` (
        `id` int NOT NULL AUTO_INCREMENT,
        `type` varchar(255) NOT NULL,
        `picture` varchar(255) NOT NULL,
        `first_name` varchar(255) NOT NULL,
        `last_name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(255) NOT NULL,
        `identifier` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `description` varchar(255) DEFAULT NULL,
        `themes` varchar(255) DEFAULT NULL,
        `interest` varchar(255) DEFAULT NULL,
        `music` varchar(255) DEFAULT NULL,
        `adress` varchar(255) NOT NULL,
        `city` varchar(255) NOT NULL,
        `zip_code` varchar(255) NOT NULL,
        `country` varchar(255) NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `user_key` varchar(255) NOT NULL,
        `recovery_key` varchar(255) DEFAULT NULL,
        `recovery_date` varchar(255) DEFAULT NULL,
        `update_date` varchar(255) DEFAULT NULL,
        `asset` varchar(255) NOT NULL,
        `two_factor_auth` varchar(255) NOT NULL,
        `code` varchar(255) NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        INSERT INTO `users` (`id`, `type`, `picture`, `first_name`, `last_name`, `email`, `phone`, `identifier`, `password`, `description`, `themes`, `interest`, `music`, `adress`, `city`, `zip_code`, `country`, `date`, `user_key`, `recovery_key`, `recovery_date`, `update_date`, `asset`, `two_factor_auth`, `code`) VALUES ('1', 'admin', 'ressources/img/profile_picture.jpg', 'Administrateur', 'Yvelinesparty', 'administrateur@yvelinesparty.fr', '+33768379372', 'administrateur', '$2y$12$8aO5RRTgJeqBMKhtQxaXQ.FfBEHda0krsnQszcoclZaIBUUSffWFW', NULL, NULL, NULL, NULL, '2 Av. Paul Vaillant Couturier', 'Bois d\'Arcy', '78390', 'France', CURRENT_TIMESTAMP, '3699344387be191b5169fb72a8f830fe', NULL, NULL, NULL, 'yes', 'no', NULL);

        COMMIT;
        ");

        $q->execute();


    }

    /**
        * Check if the zimhosting database exists
        *
        * @return boolean if the database exists
        */
    public function DatabaseCheck(){

        try{

            $db = new PDO("mysql:host=" . DB_HOST . ";dbname=yvelinesparty.fr", USER, PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return 0;

        }catch(PDOException $e){

            return 1;

        }

    }

    /**
        * Check if tables exist inside a database
        *
        * @param Object database connection
        *
        * @return boolean if the tables exists
        */
    public function CheckTables($db){

        $q = $db->prepare("SHOW TABLES");
   	    $q->execute();
   	    $tables = $q->rowCount();

        if($tables != 0)
        {
            return 0;
        }else{
            return 1;
        }

    }

}

$Database = new Database();