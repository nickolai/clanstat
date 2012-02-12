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
    function rating($array,$lang)
    {
        //print_r($array);
        $max = array('mdmg' => 0,'mspo' => 0,'mcap' => 0,'mdef' => 0);
        foreach($array as $name => $stat){
            //$rating[$name]['mid'] = middel_tank_lvl($stat['tank']);
            if($stat['overall'][$lang['games_p']] != 0 ){
                $rat['mdmg'][$name] = $rating[$name]['mdmg'] = round($stat['perform'][$lang['damage']]/$stat['overall'][$lang['games_p']]);
                $rat['mspo'][$name] = $rating[$name]['mspo'] = round($stat['perform'][$lang['spotted']]/$stat['overall'][$lang['games_p']],3);
                $rat['mcap'][$name] = $rating[$name]['mcap'] = round($stat['perform'][$lang['capture']]/$stat['overall'][$lang['games_p']],3);
                $rat['mdef'][$name] = $rating[$name]['mdef'] = round($stat['perform'][$lang['defend']]/$stat['overall'][$lang['games_p']],3);


                if($rating[$name]['mdmg'] >= $max['mdmg']){
                    $max['mdmg'] = $rating[$name]['mdmg'];  
                }

                if($rating[$name]['mspo'] >= $max['mspo']){
                    $max['mspo'] = $rating[$name]['mspo'];  
                }

                if($rating[$name]['mcap'] >= $max['mcap']){
                    $max['mcap'] = $rating[$name]['mcap'];  
                }

                if($rating[$name]['mdef'] >= $max['mdef']){
                    $max['mdef'] = $rating[$name]['mdef'];  
                }
            }
        }
        foreach($rating as $name => $val){
            if($max['mdmg'] != 0){
                $new['mdmg'] = $val['mdmg']*100/$max['mdmg'];
            }

            if($max['mspo'] != 0){
                $new['mspo'] = $val['mspo']*100/$max['mspo'];
            }

            if($max['mcap'] != 0){
                $new['mcap'] = $val['mcap']*100/$max['mcap'];
            }

            if($max['mdef'] != 0){
                $new['mdef'] = $val['mdef']*100/$max['mdef'];
            }
            $total[$name] =  round(($new['mcap']/5  +  $new['mdef']/5  +  $new['mspo']/5 + $new['mdmg']*0.40),1);
        }
        arsort($rat['mdmg']);
        arsort($rat['mspo']);
        arsort($rat['mcap']);
        arsort($rat['mdef']);
        $ratt = $rat;
        $rat['mdmg'] = array_slice($rat['mdmg'],0,5);
        $rat['mspo'] = array_slice($rat['mspo'],0,5);
        $rat['mcap'] = array_slice($rat['mcap'],0,5);
        $rat['mdef'] = array_slice($rat['mdef'],0,5);

        arsort($total);
        $news['total'] = array_slice($total,0,10);
        $news['rat'] = &$rat;
        $news['rat_all'] = &$ratt;
        $news['max'] = &$max;
        return $news;
    }
    
    function sorting_stat($array,$overall,$perform)
    {
        //print_r($array);
        foreach($array as $name => $stat){
            foreach($overall as $vl){
                $new[$vl][$name] = $stat['overall'][$vl];
                $new['total'][$vl] += $stat['overall'][$vl];
            }
            foreach($perform as $vl){
                $new[$vl][$name] = $stat['perform'][$vl];
                $new['total'][$vl] += $stat['perform'][$vl];                   
            }
        }
        $news['total'] = &$new['total'];
        foreach(array_merge($overall,$perform) as $val){
            arsort($new[$val]);
            $news['single'][$val] = array_slice($new[$val],0,10);    
        }

        return $news;
    }  

?>
