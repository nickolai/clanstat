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
    function get_clan_province($config,$id)
    {
        //echo $search;
        $error = 0;
        $data = array();
        $request = "GET /uc/clans/".$id."/provinces/?type=table HTTP/1.0\r\n";
        //$request = "GET /uc/clans/?type=table&search=\"The Red\"".$off." HTTP/1.0\r\n"; 
        //echo $request;
        $request.= "Accept: text/html, */*\r\n";
        $request.= "User-Agent: Mozilla/3.0 (compatible; easyhttp)\r\n";
        $request.= "X-Requested-With: XMLHttpRequest\r\n";
        $request.= "Host: ".$config['gm_url']."\r\n";
        $request.= "Connection: Keep-Alive\r\n";
        $request.= "\r\n";
        $n = 0;
        while(!isset($fp)){  
            $fp = fsockopen($config['gm_url'], 80, $errno, $errstr, 15);
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
        $new = &$data;
        return $new;
    }
    function get_clan_attack($config,$id)
    {
        //echo $search;
        $error = 0;
        $data = array();
        $request = "GET /uc/clans/".$id."/battles/?type=table HTTP/1.0\r\n";
        //$request = "GET /uc/clans/?type=table&search=\"The Red\"".$off." HTTP/1.0\r\n"; 
        //echo $request;
        $request.= "Accept: text/html, */*\r\n";
        $request.= "User-Agent: Mozilla/3.0 (compatible; easyhttp)\r\n";
        $request.= "X-Requested-With: XMLHttpRequest\r\n";
        $request.= "Host: ".$config['gm_url']."\r\n";
        $request.= "Connection: Keep-Alive\r\n";
        $request.= "\r\n";
        $n = 0;
        while(!isset($fp)){  
            $fp = fsockopen($config['gm_url'], 80, $errno, $errstr, 15);
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
        $new = &$data;
        return $new;
    }
?>
