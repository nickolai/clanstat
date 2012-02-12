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
?>
<body>
<?php
    if(isset($message)){
        echo $message;
    }  
?>   
<div id="tabs" class="main_container">
    <p class="num"><?php echo $lang['total_p']; ?>: <?php echo count($new['data']['request_data']['items']) ?></p>
    <ul>
        <li><a href="#tabs-1"><?php echo $lang['roster']; ?></a></li>
        <li><a href="#tabs-2"><?php echo $lang['overall_title']; ?></a></li>
        <li><a href="#tabs-3"><?php echo $lang['perform_title']; ?></a></li>
        <li><a href="#tabs-4"><?php echo $lang['battel_title']; ?></a></li>
        <li><a href="#tabs-5"><?php echo $lang['tank']; ?> 9</a></li>
        <li><a href="#tabs-6"><?php echo $lang['tank']; ?> 10</a></li> 
        <li><a href="./poss.php"><?php echo $lang['poss']; ?></a></li>
        <li><a href="./attack.php"><?php echo $lang['attack']; ?></a></li>
    </ul>
    <div id="tabs-1">
        <div align="center">
            <table id="stat1" class="tablesorter wid" cellspacing="1">              
                <thead> 
                    <tr>
                        <th><?php echo $lang['name']; ?></th> 
                        <th>ID</th> 
                        <th><?php echo $lang['in_clan']; ?></th>
                        <th><?php echo $lang['day_clan']; ?></th> 
                        <th><?php echo $lang['role']; ?></th>
                        <th><?php echo $config['dateof']; ?></th> 
                    </tr>  
                </thead>
                <tbody>
                    <?php foreach($new['data']['request_data']['items'] as $val){ 
                            if($val['member_since'] == ''){
                                $val['member_since'] = '1300000000';
                            }
                            $date = date('Y.m.d',$val['member_since']);
                        ?>  
                        <tr> 
                            <td><a href="<?php echo $config['base'].$val['name'].'/'; ?>" 
                                    target="_blank"><?php echo $val['name']; ?></a></td> 
                            <td><?php echo $val['account_id']; ?></td> 
                            <td><?php echo $date; ?></td>
                            <td><?php echo floor((time() - mktime(0, 0, 0, date("m", $val['member_since']), date("d", $val['member_since']), date("Y", $val['member_since'])))/(3600*24)); ?></td> 
                            <td><?php echo $val['role']; ?></td>
                            <td><?php echo date('Y.m.d',$res[$val['name']]['date']['local_num']); ?></td>
                        </tr>
                        <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div id="tabs-2">
        <div align="center">
            <table id="stat2" class="tablesorter wid" cellspacing="1">              
                <thead> 
                    <tr>
                        <th><?php echo $lang['name']; ?></th> 
                        <?php foreach(array_keys($res[$rand_keys]['overall']) as $column){ ?>
                            <th class="{sorter: 'digit'}"><?php echo $column; ?></th>
                            <?php } ?>
                    </tr>  
                </thead>
                <tbody>
                    <?php foreach($res as $name => $val){ ?>
                        <tr> 
                            <td><a href="<?php echo $config['base'].$name.'/'; ?>" 
                                    target="_blank"><?php echo $name; ?></a></td>
                            <?php foreach($val['overall'] as $result){ ?>
                                <td><?php echo $result; ?></td>                             
                                <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div id="tabs-3">
        <div align="center">
            <table id="stat3" class="tablesorter wid" cellspacing="1">              
                <thead> 
                    <tr>
                        <th><?php echo $lang['name']; ?></th> 
                        <?php foreach(array_keys($res[$rand_keys]['perform']) as $column){ ?>
                            <th class="{sorter: 'digit'}"><?php echo $column; ?></th>
                            <?php } ?>
                    </tr>  
                </thead>
                <tbody>
                    <?php foreach($res as $name => $val){ ?>
                        <tr> 
                            <td><a href="<?php echo $config['base'].$name.'/'; ?>" 
                                    target="_blank"><?php echo $name; ?></a></td>
                            <?php foreach($val['perform'] as $result){ ?>
                                <td><?php echo $result; ?></td>                             
                                <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div id="tabs-4">
        <div align="center">
            <table id="stat4" class="tablesorter wid" cellspacing="1">              
                <thead> 
                    <tr>
                        <th><?php echo $lang['name']; ?></th> 
                        <?php foreach(array_keys($res[$rand_keys]['exp']) as $column){ ?>
                            <th class="{sorter: 'digit'}"><?php echo $column; ?></th>
                            <?php } ?>
                    </tr>  
                </thead>
                <tbody>
                    <?php foreach($res as $name => $val){ ?>
                        <tr> 
                            <td><a href="<?php echo $config['base'].$name.'/'; ?>" 
                                    target="_blank"><?php echo $name; ?></a></td>
                            <?php foreach($val['exp'] as $result){ ?>
                                <td><?php echo $result; ?></td>                             
                                <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div id="tabs-5">
        <div align="center">
            <table id="stat5" class="tablesorter wid" cellspacing="1">              
                <thead> 
                    <tr>
                        <th><?php echo $lang['name']; ?></th> 
                        <?php foreach(array_keys($tank_name[9]) as $column){ ?>
                            <th class="{sorter: 'digit'}"><?php echo $column; ?></th>
                            <?php } ?>
                    </tr>  
                </thead>
                <tbody>
                    <?php foreach($res as $name => $val){ ?>
                        <tr> 
                            <td><a href="<?php echo $config['base'].$name.'/'; ?>" 
                                    target="_blank"><?php echo $name; ?></a></td>
                            <?php foreach(array_keys($tank_name[9]) as $column){ ?>
                                <td><?php 
                                        if(isset($val['tank'][9][$column])){
                                            if($val['tank'][9][$column]['total'] == 0){
                                                $percent = 0;    
                                            }else{
                                                $percent = round($val['tank'][9][$column]['win']*100/$val['tank'][9][$column]['total'],2);
                                            } 

                                            echo $percent.'% ('.$val['tank'][9][$column]['total'].'/'.$val['tank'][9][$column]['win'].')';
                                        }else{
                                            echo '0% (0/0)';
                                        } 

                                ?></td>                             
                                <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div id="tabs-6">
        <div align="center">
            <table id="stat6" class="tablesorter wid" cellspacing="1">              
                <thead> 
                    <tr>
                        <th><?php echo $lang['name']; ?></th> 
                        <?php foreach(array_keys($tank_name[10]) as $column){ ?>
                            <th class="{sorter: 'digit'}"><?php echo $column; ?></th>
                            <?php } ?>
                    </tr>  
                </thead>
                <tbody>
                    <?php foreach($res as $name => $val){ ?>
                        <tr> 
                            <td><a href="<?php echo $config['base'].$name.'/'; ?>" 
                                    target="_blank"><?php echo $name; ?></a></td>
                            <?php foreach(array_keys($tank_name[10]) as $column){ ?>
                                <td><?php 
                                        if(isset($val['tank'][10][$column])){
                                            if($val['tank'][10][$column]['total'] == 0){
                                                $percent = 0;    
                                            }else{
                                                $percent = round($val['tank'][10][$column]['win']*100/$val['tank'][10][$column]['total'],2);
                                            } 

                                            echo $percent.'% ('.$val['tank'][10][$column]['total'].'/'.$val['tank'][10][$column]['win'].')';
                                        }else{
                                            echo '0% (0/0)';
                                        } 

                                ?></td>                             
                                <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
<?php
    if( function_exists('memory_get_usage') ) {
        $mem_usage = memory_get_peak_usage(true);
        if ($mem_usage < 1024)
            echo $mem_usage." bytes";
        elseif ($mem_usage < 1048576)
            $memory_usage = round($mem_usage/1024,2)." кб";
        else
            $memory_usage = round($mem_usage/1048576,2)." ".$lang['mb'];
    }   
?>
<div align="center">
    © 2011-<?php echo date('Y') ?> <a href="http://wot-news.com/">Wot-news.com</a> <?php echo $lang['version']; ?> <?php echo VER; ?><br>
    <?php $end_time = microtime(true); echo $lang['ex_time'].' - '.round($end_time - $begin_time,4).' '.$lang['sec']; ?><br>
    <?php if(isset($memory_usage)){echo $lang['memory'].' '.$memory_usage;} ?>
    </div>
    
        </div>