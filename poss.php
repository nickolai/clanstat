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

    $poss = array();
    if(is_valid_url($config['td']) == true){
        $poss = get_clan_province($config,CLAN);
    }

    include_once(ROOT_DIR.'/header.php');
?>

<div align="center">
    <table id="stat5" class="tablesorter" cellspacing="1" style="width: 70%;"> 
        <thead> 
            <tr>
                <th width="40"><?php echo $lang['type']; ?></th>
                <th><?php echo $lang['title_name']; ?></th>
                <th><?php echo $lang['map']; ?></th>
                <th><?php echo $lang['prime_time']; ?></th>
                <th><?php echo $lang['income']; ?></th>
                <th><?php echo $lang['owned']; ?></th>

            </tr> 
        </thead> 
        <tbody>
            <?php $total = 0; foreach($poss['request_data']['items']  as $val){ 
                    if(strlen($val['attacked']) > 0){
                        $attack = '<img src="/images/attacked.png">';
                    }elseif(strlen($val['combats_running']) > 0){
                        $attack = '<img src="/combats_running.png">';
                    }else{
                        $attack = '';
                    }
                    $total += $val['revenue'];
                ?>
                <tr>
                    <td><img src="/images/<?php echo $val['type']; ?>.png"></td>
                    <td><a href="<?php echo $config['clan_link']; ?>maps/?province=<?php echo $val['id']; ?>" target="_blank"><?php echo $val['name'].'</a> '.$attack; ?></td>
                    <td><?php echo $val['arena_name']; ?></td>
                    <td align="center"><?php echo date('H:i',$val['prime_time']); ?></td>
                    <td align="center" style="color: #ba904d;"><?php echo $val['revenue']; ?> <img src="/images/currency-gold.png"></td>
                    <td align="center"><?php echo $val['occupancy_time']; ?> дней</td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    <p><?php echo $lang['total'].': <span style="color: #ba904d;">'.$total.'</span>'; ?> <img src="/images/currency-gold.png"></p>
                </div>
                    </body>
</html>