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
    define('ROOT_DIR', dirname(__FILE__));
    include_once(ROOT_DIR.'/function/config.php');
    include_once(ROOT_DIR.'/nosql/'.$language.'.php');
    include_once(ROOT_DIR.'/nosql/config_'.SERVER.'.php');
    $begin_time = microtime(true);
    if(MYSQL == 'on' && MYSQL_ERROR != 'on'){
        include_once(ROOT_DIR.'/function/mysql.php');
        $players = $db->query("SELECT * FROM players;")->fetch();
        $tables = reform($db->query("SHOW TABLES FROM ".$dbname." LIKE 'tank\_%';")->fetchAll());
    }else{
        $tables = array();
    }
    include_once(ROOT_DIR.'/function/html_dom.php');
    include_once(ROOT_DIR.'/function/curl.php');
    include_once(ROOT_DIR.'/function/mcurl.php');
    if(file_exists(ROOT_DIR.'/function/rating.php')){
        include_once(ROOT_DIR.'/function/rating.php');
    }
    include_once(ROOT_DIR.'/function/func.php');
    include_once(ROOT_DIR.'/function/get.php');

    //print_r($config);
    //$newss = get_last_roster();
    if(is_valid_url($config['td']) == true){
        $new = get_player(CLAN,$config);   //dg65tbhjkloinm 
        //print_r($new);
        if($new['error'] != 0 && MYSQL == 'on' && MYSQL_ERROR != 'on'){
            $new = get_last_roster();   
        }elseif($new['error'] != 0 && (MYSQL != 'on' || MYSQL_ERROR == 'on')){
            $new['data']['request_data']['items'] = array();    
        } 
    }elseif(MYSQL == 'on' && MYSQL_ERROR != 'on'){
        $new = get_last_roster();
    }else{
        $new['error'] = 1;
        $new['data']['request_data']['items'] = array();
    }
    $roster = &roster_sort($new['data']['request_data']['items']);
    //print_r($roster);
    if(count($new['data']['request_data']['items']) > 0){ 
        foreach($new['data']['request_data']['items'] as $val){
            $tmp = checker($val,$lang,$config,$tables,$new['error']);
            if(isset($tmp['link'])){
                $links[$val['name']] = &$tmp['link'];
            }
            if(isset($tmp['data'])){
                $data[$val['name']] = &$tmp['data'];
            }    
        }
        //print_r($new['data']['request_data']['items']);
        //print_r($links);
        if(count($links) > 0){        
            multiget($links, $result,PARS);
            foreach($result as $name => $val){    
                $res_tmp[$name] = pars_data($val,$config,$lang,$name,$roster[$name]);
                unset($result[$name]);   
            }
            unset($result);
            $res = &array_special_merge($data,$res_tmp);
        }else{
            $res = &$data;
        }
    }

    //print_r($roster);
    if(count($res) > 0 ){        
        $tank_name = tank_names($res);
        $rand_keys = array_rand($res, 1);

        //print_r($rand_keys);
        //print_r($tmp);
        //print_r($res[$rand_keys]);
        //print_r($tank_name);
        //print_r($res['achtung']);

        include_once(ROOT_DIR.'/header.php');
        include_once(ROOT_DIR.'/body.php');
        include_once(ROOT_DIR.'/footer.php');

    }else{
        include_once(ROOT_DIR.'/header.php');
        include_once(ROOT_DIR.'/error.php');
        include_once(ROOT_DIR.'/footer.php');    
    }

?>
