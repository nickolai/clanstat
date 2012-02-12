<?php
    /*
    * Project:     Clan Stat
    * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
    * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
    * -----------------------------------------------------------------------
    * Began:       2011
    * Date:        $Date: 2011-10-24 11:54:02 +0200 $
    * -----------------------------------------------------------------------
    * @author      $Author: Edd $
    * @copyright   2011-2011 Edd - Aleksandr Ustinov
    * @link        http://wot-news.com
    * @package     Clan Stat
    * @version     $Rev: 1.2.6 $
    *
    */
    if (preg_match ("/mysql.php/", $_SERVER['PHP_SELF']))
    {
        header ("Location: /index.php");
        exit;
    }

    $dbhost ='localhost';
    // username and password to log onto db server
    $dbuser ='';
    $dbpass  ='';
    // name of database
    $dbname='';



    $db = new PDO ( 'mysql:host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass);  
    $db->query ( 'SET character_set_connection = '.$sqlchar );  
    $db->query ( 'SET character_set_client = '.$sqlchar );  
    $db->query ( 'SET character_set_results = '.$sqlchar );


?>
