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
    * @version     $Rev: 1.2.4 $
    *
    */
    define('ROOT_DIR', dirname(__FILE__));
    include_once(ROOT_DIR.'/function/config.php');
    include_once(ROOT_DIR.'/nosql/'.$language.'.php');
    include_once(ROOT_DIR.'/nosql/config_'.SERVER.'.php');
    if(MYSQL == 'on' && MYSQL_ERROR != 'on'){ 
        include_once(ROOT_DIR.'/function/mysql.php');
    }
    include_once(ROOT_DIR.'/function/get.php');
    include_once(ROOT_DIR.'/function/html_dom.php');
    include_once(ROOT_DIR.'/function/func.php');
    $battel = array();

    if(is_valid_url($config['td']) == true){
        $battel = get_clan_attack($config,CLAN);
    }

    include_once(ROOT_DIR.'/header.php');
?>

<div align="center">
    <table id="stat6" class="tablesorter" cellspacing="1" style="width: 70%;"> 
        <thead> 
            <tr>
                <th width="40"><?php echo $lang['type']; ?></th>
                <th><?php echo $lang['time']; ?></th>
                <th><?php echo $lang['province']; ?></th>

            </tr> 
        </thead> 
        <tbody>
            <?php foreach($battel['request_data']['items'] as $val){ 
                    if(strlen($val['time']) > 1){
                        $date = date('H:i',$val['time']);
                    }else{
                        $date = '--:--';
                    }
                    if($val['type'] == 'landing'){
                        $type = '<img src="/images/landing.png">';    
                    }elseif($val['type'] == 'for_province'){
                        $type = '<img src="/images/attacked.png">';
                    }elseif($val['type'] == 'meeting_engagement'){
                        $type = '<img src="/images/combats_running.png">';
                    }
                ?>
                <tr>
                    <td align="center"><?php echo $type; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><a href="<?php echo $config['clan_link']; ?>maps/?province=<?php echo $val['provinces'][0]['id']; ?>" target="_blank"><?php echo $val['provinces'][0]['name']; ?></a></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
                </div>
                    </body>
</html>