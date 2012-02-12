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

    if (preg_match ("/config.php/", $_SERVER['PHP_SELF']))
    {
        header ("Location: /index.php");
        exit;
    }


    define("SERVER",'ru');  // Server, can be ru, eu, us(Сервер может быть ru, eu, us)
    define("CLAN",'7188'); //Clan ID(ID Клана) 7188
    define("MYSQL",'on'); //MYSQL can be on or off(Включить MySQL - on, не включать - off)
    define("CACHE",'24'); //Players cache time for MySQL in hours(Время на которое кешируються данные в MySQL-е в часах)
    define("ALIGN",'hor'); //Vertical(ver) or Horizontal(hor) align of tabs(Вертикальное или Горизонтальное расположение закладок, возможные значения - hor и ver)
    define("PARS",'curl'); //Parsing method, can be curl or alternative mcurl(Библиотека парсинга, может быть curl или mcurl)
    define("VEH",'normal'); //Base mod is normal, but if u have problems with vehicle parsing, pls turn on alternative method - alter (Обычный - normal, если есть проблемы с парсингом техники, переключить в - alter)

    $sqlchar = 'utf8';
    if(SERVER == 'ru'){
        $language = 'ru';
    }else{
        $language = 'en';
    }
    $data = array();
    $links = array();
    $res_tmp = array();
    $result = array();
    $res = array();
    //Special function
    function reform($array){
        $new = array();
        foreach($array as $val){
            $new[] = $val[0];
        }
        return $new;
    }
    function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    if ( !extension_loaded('pdo') ) {
        if($language == 'en'){
        $message = '<i>ERORRO:</i> <strong>php-pdo</strong> extention do not loaded, without it you cant use MySQL. Turn off Mysql in config.php or get extention load';
        }else{
        $message = '<i>ОШИБКА:</i> <strong>php-pdo</strong> расширение не загружено, без него MySQL не будет работать. Выключите MySQL в config.php или зпгрузите модуль';    
        }
        define('MYSQL_ERROR','on'); 
    }elseif ( !extension_loaded('pdo_mysql') ) {
        if($language == 'en'){
        $message = '<i>ERORRO:</i> <strong>php-pdo_mysql</strong> extention do not loaded, without it you cant use MySQL. Turn off Mysql in config.php or get extention load';
        }else{
        $message = '<i>ОШИБКА:</i> <strong>php-pdo_mysql</strong> расширение не загружено, без него MySQL не будет работать. Выключите MySQL в config.php или зпгрузите модуль';    
        }
        define('MYSQL_ERROR','on');  
    }else{
        define('MYSQL_ERROR','off');
    }
    
    define("VER",'1.2.6');  
?>
