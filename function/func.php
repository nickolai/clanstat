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

    if (preg_match ("/func.php/", $_SERVER['PHP_SELF']))
    {
        header ("Location: ./index.php");
        exit;
    }
    function restr($array)
    {
        foreach(array_keys($array) as $val){
            if(is_array($array[$val])){
                foreach(array_keys($array[$val]) as $v){
                    if(is_numeric($v)){
                        unset($array[$val][$v]);
                    }    
                }    
            }else{
                if(is_numeric($val)){
                    unset($array[$val]);
                }    
            }
        }
        return $array;
    }
    function tank_names($array){
        $name = array();
        foreach($array as $val){
            if(isset($val['tank'])){
                foreach($val['tank'] as $lvl => $tanks){
                    foreach($tanks as $tank){
                        $name[$lvl][trim($tank['type'])] = true;
                    }
                }
            }
        }
        return $name;
    }


    function now(){
        return strtotime(date("Y-m-d H:i:s"));
    }
    function error_rep($error,$lang){
        if($error == 1){
            return $lang['error_2'];    
        }elseif($error == 21){
            return $lang['error_3'];
        }

    }

    function array_special_merge($array1,$array2)
    {
        foreach($array2 as $key2 => $val2){
            if(!array_key_exists($key2,$array1)){
                $array1[$key2] = $val2;
            }else{
                $array1[] = $val2;
            }

        }
        return $array1;

    }
    function get_data($name,$trans,$stat_config,$tables)
    {
        global $db;      
        $result = $db->query("select * from players WHERE name = '".$name."';")->fetch();

        //Даты
        $new['date']['reg'] = $stat_config['reg'].' '.date('d.m.Y',$result['reg']);
        $new['date']['local'] = $stat_config['dateof'].' '.date('d.m.Y, H:i',$result['local']);
        $new['date']['reg_num'] = $result['reg'];
        $new['date']['local_num'] = $result['local'];

        //Общие результаты
        $new['overall'][$trans['games_p']] = $result['total'];
        $new['overall'][$trans['victories']] = $result['win'];
        $new['overall'][$trans['defeats']] = $result['lose'];
        $new['overall'][$trans['battles_s']] = $result['alive'];

        //Боевая эффективность
        $new['perform'][$trans['destroyed']] = $result['des'];
        $new['perform'][$trans['spotted']] = $result['spot'];
        $new['perform'][$trans['hit_ratio']] = $result['accure'];
        $new['perform'][$trans['damage']] = $result['dmg'];
        $new['perform'][$trans['capture']] = $result['cap'];
        $new['perform'][$trans['defend']] = $result['def'];

        //Боевой опыт
        $new['exp'][$trans['total_exp']] = $result['exp'];
        $new['exp'][$trans['exp_battle']] = $result['averag_exp'];
        $new['exp'][$trans['exp_max']] = $result['max_exp'];

        //Рейтинг

        $new['rating'][$trans['gr']]['type'] = 'GR';;
        $new['rating'][$trans['gr']]['link'] = $stat_config['rating_link'].'gr.png';;
        $new['rating'][$trans['gr']]['name'] = $trans['gr'];
        $new['rating'][$trans['gr']]['value'] = $result['gr_v'];
        $new['rating'][$trans['gr']]['place'] = $result['gr_p'];

        $new['rating'][$trans['wb']]['type'] = 'W/B';;
        $new['rating'][$trans['wb']]['link'] = $stat_config['rating_link'].'wb.png';;
        $new['rating'][$trans['wb']]['name'] = $trans['wb'];
        $new['rating'][$trans['wb']]['value'] = $result['wb_v'];
        $new['rating'][$trans['wb']]['place'] = $result['wb_p'];

        $new['rating'][$trans['eb']]['type'] = 'E/B';;
        $new['rating'][$trans['eb']]['link'] = $stat_config['rating_link'].'eb.png';;
        $new['rating'][$trans['eb']]['name'] = $trans['eb'];
        $new['rating'][$trans['eb']]['value'] = $result['eb_v'];
        $new['rating'][$trans['eb']]['place'] = $result['eb_p'];

        $new['rating'][$trans['win']]['type'] = 'WIN';;
        $new['rating'][$trans['win']]['link'] = $stat_config['rating_link'].'win.png';;
        $new['rating'][$trans['win']]['name'] = $trans['win'];
        $new['rating'][$trans['win']]['value'] = $result['win_v'];
        $new['rating'][$trans['win']]['place'] = $result['win_p'];

        $new['rating'][$trans['gpl']]['type'] = 'GPL';;
        $new['rating'][$trans['gpl']]['link'] = $stat_config['rating_link'].'gpl.png';;
        $new['rating'][$trans['gpl']]['name'] = $trans['gpl'];
        $new['rating'][$trans['gpl']]['value'] = $result['gpl_v'];
        $new['rating'][$trans['gpl']]['place'] = $result['gpl_p'];

        $new['rating'][$trans['cpt']]['type'] = 'CPT';;
        $new['rating'][$trans['cpt']]['link'] = $stat_config['rating_link'].'cpt.png';;
        $new['rating'][$trans['cpt']]['name'] = $trans['cpt'];
        $new['rating'][$trans['cpt']]['value'] = $result['cpt_v'];
        $new['rating'][$trans['cpt']]['place'] = $result['cpt_p'];

        $new['rating'][$trans['dmg']]['type'] = 'DMG';;
        $new['rating'][$trans['dmg']]['link'] = $stat_config['rating_link'].'dmg.png';;
        $new['rating'][$trans['dmg']]['name'] = $trans['dmg'];
        $new['rating'][$trans['dmg']]['value'] = $result['dmg_v'];
        $new['rating'][$trans['dmg']]['place'] = $result['dmg_p'];

        $new['rating'][$trans['dpt']]['type'] = 'DPT';;
        $new['rating'][$trans['dpt']]['link'] = $stat_config['rating_link'].'dpt.png';;
        $new['rating'][$trans['dpt']]['name'] = $trans['dpt'];
        $new['rating'][$trans['dpt']]['value'] = $result['dpt_v'];
        $new['rating'][$trans['dpt']]['place'] = $result['dpt_p'];

        $new['rating'][$trans['frg']]['type'] = 'FRG';;
        $new['rating'][$trans['frg']]['link'] = $stat_config['rating_link'].'frg.png';;
        $new['rating'][$trans['frg']]['name'] = $trans['frg'];
        $new['rating'][$trans['frg']]['value'] = $result['frg_v'];
        $new['rating'][$trans['frg']]['place'] = $result['frg_p'];

        $new['rating'][$trans['spt']]['type'] = 'SPT';;
        $new['rating'][$trans['spt']]['link'] = $stat_config['rating_link'].'spt.png';;
        $new['rating'][$trans['spt']]['name'] = $trans['spt'];
        $new['rating'][$trans['spt']]['value'] = $result['spt_v'];
        $new['rating'][$trans['spt']]['place'] = $result['spt_p'];

        $new['rating'][$trans['exp']]['type'] = 'EXP';;
        $new['rating'][$trans['exp']]['link'] = $stat_config['rating_link'].'exp.png';;
        $new['rating'][$trans['exp']]['name'] = $trans['exp'];
        $new['rating'][$trans['exp']]['value'] = $result['exp_v'];
        $new['rating'][$trans['exp']]['place'] = $result['exp_p'];

        $tank = array();
        foreach($tables as $tab){
            $result_tank = $db->query("SELECT * FROM ".$tab." WHERE id = '".$result['id']."';")->fetch();
            if(is_array($result_tank)){
                foreach(array_keys($result_tank) as $val){
                    if(is_numeric($val)){
                        unset($result_tank[$val]);
                    }
                }
                $tank = array_merge($tank,$result_tank);
            }
        }
        unset($result_tank);
        $total = array();
        foreach($tank as $key => $game){
            if($key != 'id' && $game >= 0){
                if(strpos($key,'t')){
                    $total[$key] = $game;
                }else{
                    $win[$key] = $game;
                }
            }
        }
        //print_r($tank);
        unset($tank);
        if(is_array($total)){
            arsort($total,SORT_NUMERIC);
        }else{
            $total = array();
        }
        $tank_name = $db->query("SELECT * FROM tanks;")->fetchAll();
        $i = 0;
        foreach($total as $key => $game){
            $tmp = explode('_',$key);
            $tkey = $tmp[0];
            $new['tank'][number_transform($tank_name[$tkey-1]['lvl'])][$tank_name[$tkey-1]['tank']]['type'] = $tank_name[$tkey-1]['tank'];
            $new['tank'][number_transform($tank_name[$tkey-1]['lvl'])][$tank_name[$tkey-1]['tank']]['total'] = $game; 
            $new['tank'][number_transform($tank_name[$tkey-1]['lvl'])][$tank_name[$tkey-1]['tank']]['link'] = $tank_name[$tkey-1]['link'];
            $new['tank'][number_transform($tank_name[$tkey-1]['lvl'])][$tank_name[$tkey-1]['tank']]['win'] = $win[$tkey.'_w'];
            $new['tank'][number_transform($tank_name[$tkey-1]['lvl'])][$tank_name[$tkey-1]['tank']]['nation'] = $tank_name[$tkey-1]['nation'];
            $new['tank'][number_transform($tank_name[$tkey-1]['lvl'])][$tank_name[$tkey-1]['tank']]['lvl'] = $tank_name[$tkey-1]['lvl'];    

        }
        //print_r($tank_name);
        return $new;

    }

    function checker($val,$lang,$config,$tables,$error){
        global $db;
        if(MYSQL == 'on' && MYSQL_ERROR != 'on'){
            if($error == 0){
                $status = $db->query("SELECT COUNT(*) FROM players WHERE name = '".$val['name']."' AND up < '".(now() - CACHE*3600)."';")->fetchColumn();
            }else{
                $status = 0;    
            }
            $player_stat = $db->query("SELECT COUNT(*) FROM players WHERE name = '".$val['name']."';")->fetchColumn();
        }else{
            $status = 1;
            $player_stat = 0;
        }
        if($status > 0 || $player_stat == 0){
            $link = $config['base_direct'].$val['account_id'].'-'.$val['name'].'/';
        }else{
            $data = get_data($val['name'],$lang,$config,$tables);
        }
        $new['link'] = &$link;
        $new['data'] = &$data;
        return $new;
    }

    function insert_rating($data,$trans,$fname,$server,$stat_config,$roster){
        //if($this->session->userdata('group') == 'administrator'){ 
        global $db;
        if(count($data['stats']) > 0){
            $mod = 1;
            $dbb['account_id'] = $roster['account_id'];
            $dbb['name'] = $fname;
            $dbb['role'] = $roster['role'];
            $dbb['server'] = $server;
            $dbb['reg'] = trim(str_replace($stat_config['reg'],'',$data['date']['reg']));
            $dbb['local'] = trim(str_replace($stat_config['dateof'],'',$data['date']['local']));
            $dbb['member_since'] = $roster['member_since'];
            $dbb['reg'] = strtotime($dbb['reg']);
            $dbb['local'] = strtotime($dbb['local']);
            $dbb['up'] = now();
            $dbb['total'] = str_replace(' ','',$data['stats'][0+$mod][0][0]);

            $tmp = explode('(',str_replace(' ','',$data['stats'][0+$mod][1][0]));
            $dbb['win'] = $tmp[0];
            $tmp = explode('(',str_replace(' ','',$data['stats'][0+$mod][2][0]));
            $dbb['lose'] = $tmp[0];
            $tmp = explode('(',str_replace(' ','',$data['stats'][0+$mod][3][0]));
            $dbb['alive'] = $tmp[0];

            $dbb['des'] = str_replace(' ','',$data['stats'][1+$mod][0][0]);
            $dbb['spot'] = str_replace(' ','',$data['stats'][1+$mod][1][0]);
            $dbb['accure'] = (int) str_replace(' ','',$data['stats'][1+$mod][2][0]);
            $dbb['dmg'] = str_replace(' ','',$data['stats'][1+$mod][3][0]);
            $dbb['cap'] = str_replace(' ','',$data['stats'][1+$mod][4][0]);
            $dbb['def'] = str_replace(' ','',$data['stats'][1+$mod][5][0]);
            $dbb['exp'] = str_replace(' ','',$data['stats'][2+$mod][0][0]);
            $dbb['averag_exp'] = str_replace(' ','',$data['stats'][2+$mod][1][0]);
            $dbb['max_exp'] = str_replace(' ','',$data['stats'][2+$mod][2][0]);
            $dbb['gr_v'] = str_replace(' ','',$data['stats'][3+$mod][0][0]);
            $dbb['gr_p'] = str_replace(' ','',$data['stats'][3+$mod][0][1]);
            $dbb['wb_v'] = (int) str_replace(' ','',$data['stats'][3+$mod][1][0]);
            $dbb['wb_p'] = str_replace(' ','',$data['stats'][3+$mod][1][1]);
            $dbb['eb_v'] = str_replace(' ','',$data['stats'][3+$mod][2][0]);
            $dbb['eb_p'] = str_replace(' ','',$data['stats'][3+$mod][2][1]);
            $dbb['win_v'] = str_replace(' ','',$data['stats'][3+$mod][3][0]);
            $dbb['win_p'] = str_replace(' ','',$data['stats'][3+$mod][3][1]);
            $dbb['gpl_v'] = str_replace(' ','',$data['stats'][3+$mod][4][0]);
            $dbb['gpl_p'] = str_replace(' ','',$data['stats'][3+$mod][4][1]);
            $dbb['cpt_p'] = str_replace(' ','',$data['stats'][3+$mod][5][1]);
            $dbb['cpt_v'] = str_replace(' ','',$data['stats'][3+$mod][5][0]);
            $dbb['dmg_p'] = str_replace(' ','',$data['stats'][3+$mod][6][1]);
            $dbb['dmg_v'] = str_replace(' ','',$data['stats'][3+$mod][6][0]);
            $dbb['dpt_p'] = str_replace(' ','',$data['stats'][3+$mod][7][1]);
            $dbb['dpt_v'] = str_replace(' ','',$data['stats'][3+$mod][7][0]);
            $dbb['frg_p'] = str_replace(' ','',$data['stats'][3+$mod][8][1]);
            $dbb['frg_v'] = str_replace(' ','',$data['stats'][3+$mod][8][0]);
            $dbb['spt_p'] = str_replace(' ','',$data['stats'][3+$mod][9][1]);
            $dbb['spt_v'] = str_replace(' ','',$data['stats'][3+$mod][9][0]);
            $dbb['exp_p'] = str_replace(' ','',$data['stats'][3+$mod][10][1]);
            $dbb['exp_v'] = str_replace(' ','',$data['stats'][3+$mod][10][0]);

            $status = $db->query("SELECT COUNT(*) FROM players WHERE name = '".$fname."' AND server = '".$server."';")->fetchColumn();

            //print_r($status);
            if($status > 0){
                $player = $db->query("SELECT id FROM players WHERE name = '".$fname."' AND server = '".$server."';")->fetch();
                //print_r($id);
                $nm = 0;
                $insert = '';
                foreach($dbb as $column => $val){
                    if($nm == 0){
                        $insert .= $column." = '".$val."'";  
                        $nm++;  
                    }else{
                        $insert .= ', '.$column." = '".$val."'";
                    }    
                }
                $sql = "UPDATE players SET ".$insert." WHERE id = '".$player['id']."';";
                //echo $sql;
                $q = $db->prepare($sql);
                $q->execute();   
            }else{ 
                $sql = "INSERT INTO players (".(implode(",",array_keys($dbb))).") VALUES ('".(implode("','",$dbb))."');";
                //echo $sql;
                $q = $db->prepare($sql);
                $q->execute();
                $player['id'] = $db->lastInsertId();  
            }              

            $current_tmp = $db->query("SELECT id,tank,nation FROM tanks;")->fetchAll();   
            foreach($current_tmp as $val){
                $current[$val['id']] = $val['tank'].'_'.$val['nation'];    
            }


            if(!isset($current)){
                $current = array();
            }
            //print_r($current);
            $tmp = array();
            $current_flip = &array_flip($current);
            if(isset($data['stats'][4+$mod])){
                foreach($data['stats'][4+$mod] as $val){

                    if(in_array(trim($val[$trans['battle']]).'_'.$val[2],$current)){
                        $tmp[$val[2]][$current_flip[trim($val[$trans['battle']]).'_'.$val[2]].'_t'] = str_replace(' ','',$val[$trans['win']]);
                        $tmp[$val[2]][$current_flip[trim($val[$trans['battle']]).'_'.$val[2]].'_w'] = str_replace(' ','',$val[1]);        
                    }else{
                        $tank = array(
                        'tank' => trim($val[$trans['battle']]),
                        'nation' => $val[2],
                        'lvl' => trim($val[0]),
                        'link' => $val[$trans['tank']],
                        );
                        //print_r($tank);
                        $db->prepare("INSERT INTO tanks (".(implode(",",array_keys($tank))).") VALUES ('".(implode("','",$tank))."');")->execute();
                        $id = $db->lastInsertId();
                        $nation_db = $db->query("show tables like 'tank_".$val[2]."';")->fetchAll(); 
                        if(count($nation_db) < 1){
                            $db->prepare("CREATE TABLE tank_".$val[2]." (id INT(12) PRIMARY KEY);")->execute();    
                        }
                        $db->prepare("ALTER TABLE `tank_".$val[2]."` ADD `".$id."_t` INT( 12 ) NOT NULL;")->execute();
                        $db->prepare("ALTER TABLE `tank_".$val[2]."` ADD `".$id."_w` INT( 12 ) NOT NULL;")->execute();
                        $tmp[$val[2]][$id.'_t'] = str_replace(' ','',$val[$trans['win']]);
                        $tmp[$val[2]][$id.'_w'] = str_replace(' ','',$val[1]); 

                    }
                }
            }

            $nation_db_now = $db->query("show tables like 'tank\_%';")->fetchAll();

            foreach($nation_db_now as $db_now){
                $status_nation[$db_now[0]] = $db->query("SELECT COUNT(*) FROM ".$db_now[0]." WHERE id = '".$player['id']."';")->fetchColumn();
            }
            //print_r($status_nation);
            //print_r($tmp);
            foreach($tmp as $key => $t){
                if($status_nation['tank_'.$key] > 0){
                    $nm = 0;
                    $insert = '';
                    foreach($t as $column => $val){
                        if($nm == 0){
                            $insert .= $column." = '".$val."'";  
                            $nm++;  
                        }else{
                            $insert .= ', '.$column." = '".$val."'";
                        }    
                    }
                    //$db->prepare("UPDATE players SET ".$insert." WHERE id = '".$id['id']."';")->execute();
                    $db->prepare("UPDATE tank_".$key." SET ".$insert." WHERE id = '".$player['id']."';")->execute();    
                }else{
                    $t['id'] = $player['id'];
                    $q = $db->prepare("INSERT INTO tank_".$key." (".(implode(",",array_keys($t))).") VALUES ('".(implode("','",$t))."');")->execute();
                }
            }

        }
    }

    function number_transform($num)
    {
        $data['I'] = 1;
        $data['II'] = 2;
        $data['III'] = 3;
        $data['IV'] = 4;
        $data['V'] = 5;
        $data['VI'] = 6;
        $data['VII'] = 7;
        $data['VIII'] = 8;
        $data['IX'] = 9;
        $data['X'] = 10;
        $return = $data[trim($num)];

        return $return;

    }

    function get_player($clan_id,$config)
    {
        $error = 0;
        $data = array();
        $request = "GET /uc/clans/".$clan_id."/members/?type=table HTTP/1.0\r\n";
        $request.= "Accept: text/html, */*\r\n";
        $request.= "User-Agent: Mozilla/3.0 (compatible; easyhttp)\r\n";
        $request.= "X-Requested-With: XMLHttpRequest\r\n";
        $request.= "Host: ".$config['gm_url']."\r\n";
        $request.= "Connection: Keep-Alive\r\n";
        $request.= "\r\n";

        $wot_host=$config['gm_url'];
        $n = 1;
        while(!isset($fp)){
            $fp = fsockopen($config['gm_url'], 80, $errno, $errstr, 20);
            if($n == 3){
                break;
            }
            $n++;
        }
        if (!$fp) {
            echo "$errstr ($errno)<br>\n";
        } else {

            stream_set_timeout($fp,20);
            $info = stream_get_meta_data($fp);

            fwrite($fp, $request);
            $page = '';

            while (!feof($fp) && (!$info['timed_out'])) { 
                $page .= fgets($fp, 4096);
                $info = stream_get_meta_data($fp);
                //echo $page;
            }
            fclose($fp);
            if ($info['timed_out']) {
                $error = 1; //Connection Timed Out
            }

        }
        if($error == 0){
            preg_match_all("/{\"request_data\":(.*?),\"result\":\"success\"}/", $page, $matches);
            $data = (json_decode($matches[0][0], true));
        }
        $new['error'] = &$error;
        $new['data'] = &$data;
        return $new;
    }
    function multiget($urls, &$result,$tcurl = 'curl')
    {
        if($tcurl == 'curl'){
            $curl = new CURL();
            $opts = array( CURLOPT_RETURNTRANSFER => true );  
            foreach($urls as $key => $link){
                $curl->addSession( $link, $key, $opts );
            }  
            $result = $curl->exec();  
            $curl->clear();
        }else{
            $curl = new MCurl; 
            $curl->threads = 100;  
            $curl->timeout = 15;   
            unset($results); 
            $curl->sec_multiget($urls, $result);  
        }
    }
    function parseTable($html,$config,$veh)
    {
        $table = array();
        $spec = 1;    
        //echo $spec;
        $html = str_replace('&nbsp;', ' ',$html);
        $veh = &str_replace('&nbsp;', ' ',$veh->outertext);
        // Find the table
        preg_match_all("/<table.*?>.*?<\/[\s]*table>/s", $html, $table_html);
        //print_r($table_html);
        if($veh != ''){
            $table_html[0][5] = $veh;
        }
        for($n= 1 - $spec; $n < count($table_html[0]); $n++){
            // Get title for each row
            preg_match_all("/<th.*?>(.*?)<\/[\s]*th>/", $table_html[0][$n], $matches);
            //print_r($matches);
            $row_headers = $matches[1];
            //print_r($row_headers);
            // Iterate each row
            preg_match_all("/<tr.*?>(.*?)<\/[\s]*tr>/s", $table_html[0][$n], $matches);
            //print_r($matches);
            $tmp = array();
            foreach($matches[0] as $row_html)
            {
                //echo $row_html;
                preg_match_all("/<td.*?>(.*?)<\/[\s]*td>/s", $row_html, $td_matches);
                preg_match_all('/<td class="js\-[\'"]?([^\'" >]+)[\'" >]/', $row_html, $nation);
                //print_r($nation);
                $row = array();
                //print_r($td_matches);

                for($i=0; $i<count($td_matches[1]); $i++)
                {
                    preg_match_all('/src=[\'"]?([^\'" >]+)[\'" >]/', $td_matches[1][$i], $img);
                    if(isset($img[1][0])){
                        $td = $config['td'].$img[1][0];
                        $tm = strip_tags(html_entity_decode($td_matches[1][$i]));   
                    }else{
                        $td = strip_tags(html_entity_decode($td_matches[1][$i]));
                    }
                    if(isset($row_headers[$i])){
                        $row[$row_headers[$i]] = $td;
                    }else{
                        $row[] = $td;
                    }
                    if(isset($tm)){
                        if(strlen($tm)>0){
                            $row[] = $tm;
                            $tm = '';
                        }
                    }
                }
                if(isset($nation[1][0])){
                    if(strlen($nation[1][0]) > 0){
                        $row[] = $nation[1][0];
                    }
                }
                //print_r($row);
                if(count($row) > 0)
                    $tmp[] = $row;
            }
            $table[$n - 1 + $spec] = $tmp;
        }
        //print_r($table);
        return $table;
    }
    function pars_date($newr,$newu,$config)
    {
        //Дата регистрации: 22.09.2010
        //Данные по состоянию на 06.05.2011, 07:59 
        //$reg = "/".$config['reg'].".*/";
        //$dateof = "/".$config['dateof'].".*/";
        //echo $reg;   
        preg_match_all('/data-timestamp=[\'"]?([^\'" >]+)[\'" >]/', $newr, $registred);
        preg_match_all('/data-timestamp=[\'"]?([^\'" >]+)[\'" >]/', $newu, $local);
        //print_r($registred[1][0]);    
        if(isset($registred[1][0])){
            $array['reg'] = $config['reg'].' '.date("d.m.Y",number_format($registred[1][0],0,'',''));
            $array['local'] = $config['dateof'].' '.date("d.m.Y H:m",number_format($local[1][0],0,'',''));
            $array['reg_num'] = number_format($registred[1][0],0,'','');
            $array['local_num'] = number_format($local[1][0],0,'','');
            //echo $array['reg'].' '.$array['local']; 
            //print_r($array);
            return $array;

        }
    } 
    function pars_data($url,$config,$lang,$name,$roster)
    {
        //print_r($url);
        $html = str_get_html($url);
        $newr = $html->find('div[class=b-data-create]',0);
        $newu = $html->find('div[class=b-data-date]',0);
        $veh = '';
        if(VEH == 'alter'){
            $veh = $html->find('table[class=t-statistic]',1); 
        }
        //echo $newr->outertext;
        //print_r($newr);
        $array['date'] = pars_date($newr->outertext,$newu->outertext,$config); 
        $array['stats'] = parseTable($html,$config,$veh);  

        if(MYSQL == 'on' && MYSQL_ERROR != 'on'){
            insert_rating($array,$lang,$name,SERVER,$config,$roster);
        }
        if(count($array['stats']) < 1){
            $array['stats'] = array();
            $new = array();
        }else{
            $new['date'] = $array['date'];
        }
        $html->clear();
        unset($html,$newr,$newu,$array['date']);
        unset($array['stats'][0]);
        if(count(($array['stats']))>0){
            foreach($array['stats'][1] as $val){
                $tmp = str_replace(':','',trim($val[$lang['overall_title']]));
                $num = explode('(',trim($val[0]));
                $new['overall'][$tmp] = str_replace(' ','',$num[0]);     
            }
            unset($array['stats'][1]);
            foreach($array['stats'][2] as $val){
                $tmp = str_replace(':','',trim($val[$lang['perform_title']]));
                $num = explode('(',trim($val[0]));
                $new['perform'][$tmp] = str_replace(' ','',$num[0]);     
            }
            unset($array['stats'][2]);
            foreach($array['stats'][3] as $val){
                $tmp = str_replace(':','',trim($val[$lang['battel_title']]));
                $num = explode('(',trim($val[0]));
                $new['exp'][$tmp] = str_replace(' ','',$num[0]);     
            }
            unset($array['stats'][3]);
            foreach($array['stats'][4] as $val){
                $tmp = trim($val[$lang['place']]);

                $new['rating'][$tmp]['type'] = $val[$lang['rating_title']];
                $new['rating'][$tmp]['link'] = $val[$lang['value']]; 
                $new['rating'][$tmp]['name'] = $val[$lang['place']];
                $new['rating'][$tmp]['value'] = str_replace(' ','',$val[0]);
                $new['rating'][$tmp]['place'] = str_replace(' ','',$val[1]);    
            }
            unset($array['stats'][4]);
            if(isset($array['stats'][5])){
                foreach($array['stats'][5] as $val){
                    $tmp = trim($val[$lang['battle']]);

                    $new['tank'][number_transform($val[0])][$tmp]['type'] = $val[$lang['battle']];
                    $new['tank'][number_transform($val[0])][$tmp]['total'] = str_replace(' ','',$val[$lang['win']]); 
                    $new['tank'][number_transform($val[0])][$tmp]['link'] = $val[$lang['tank']];
                    $new['tank'][number_transform($val[0])][$tmp]['win'] = str_replace(' ','',$val[1]);
                    $new['tank'][number_transform($val[0])][$tmp]['nation'] = str_replace(' ','',$val[2]);
                    $new['tank'][number_transform($val[0])][$tmp]['lvl'] = number_transform($val[0]);    
                }
                unset($array['stats'][5]);
            }
        }

        return $new;

    }
    function get_last_roster()
    {
        global $db;
        $error = 1;
        $players = $db->query("SELECT COUNT(*) FROM players;")->fetchColumn();
        if($players > 0){
            $result = $db->query("SELECT * FROM players ORDER BY up DESC ;")->fetch();    
        }else{
            $error = 21; //No entries in MySQL
        }
        $roster['request_data']['items'] = $db->query("SELECT name,id,account_id,role,member_since FROM players WHERE up <= '".$result['up']."' AND up > '".($result['up'] - 100)."' ORDER BY up ASC;")->fetchALL();
        //print_r(restr($roster));
        $new['error'] = &$error;
        $new['data'] = &restr($roster);
        return $new;
    }
    function roster_sort($array)
    {
        $new = array();
        foreach($array as $val){
            $new[$val['name']] = $val;
        }
        return $new;    
    }

    function get_headers_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $url);
        curl_setopt($ch, CURLOPT_HEADER,         true);
        curl_setopt($ch, CURLOPT_NOBODY,         true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT,        10);

        $r = @curl_exec($ch);
        $r = @explode("\n", $r);
        return $r;
    } 

    function is_valid_url($url)
    {   
        $url = @parse_url($url);

        if ( ! $url) {
            return false;
        }

        $url = array_map('trim', $url);
        $url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
        $path = (isset($url['path'])) ? $url['path'] : '';

        if ($path == '')
        {
            $path = '/';
        }

        $path .= ( isset ( $url['query'] ) ) ? "?$url[query]" : '';

        if ( isset ( $url['host'] ) AND $url['host'] != gethostbyname ( $url['host'] ) )
        {
            if ( PHP_VERSION >= 5 )
            {
                $headers = get_headers_curl("$url[scheme]://$url[host]:$url[port]$path");
                //print_r($headers);
            }
            $headers = ( is_array ( $headers ) ) ? implode ( "\n", $headers ) : $headers;
            preg_match_all ( '#^HTTP/.*\s+[0-9]+\s#i', $headers,$match );
            $tmp = explode(' ',$match[0][0]);
            //print_r($tmp);
            $code = array(200,301,302);
            if(in_array($tmp[1],$code)){
                return true ;
            }
        }
        return false;
    } 
?>
