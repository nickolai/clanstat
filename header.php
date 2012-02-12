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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Список клана</title>

    <link rel="stylesheet" href="./css/jq.css" type="text/css" media="print, projection, screen" /> 
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="print, projection, screen" />
    <link rel="stylesheet" href="./css/jquery-ui.css" type="text/css" media="print, projection, screen" /> 
    <?php if(ALIGN == 'ver'){ ?>
        <link rel="stylesheet" href="./css/ver.css" type="text/css" media="print, projection, screen" />
    <?php }else{ ?>
        <style>
            table.wid {
                width: 75%;
            }  
        </style>
    <?php } ?>
           
    <style>
        .num {
            font-size: 17px;
            font-weight: bold;
        }                    
    </style>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/jquery-ui.js"></script>
    <script type="text/javascript" src="./js/jquery-ui-ru.js"></script> 
    <script type="text/javascript" src="./js/jquery.tablesorter.js"></script> 
    <script type="text/javascript" src="./js/jquery.metadata.js"></script>
    <script type="text/javascript" id="js">     

        $(document).ready(function() 
        { 
            $("#stat1").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
            $("#stat2").tablesorter({sortList:[[0,0]], widgets: ['zebra']}); 
            $("#stat3").tablesorter({sortList:[[0,0]], widgets: ['zebra']}); 
            $("#stat4").tablesorter({sortList:[[0,0]], widgets: ['zebra']}); 
            $("#stat5").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
            $("#stat6").tablesorter({sortList:[[0,0]], widgets: ['zebra']}); 
        } 
        );  
    </script>  
    <script>
        $(function() {
            $( "#tabs" ).tabs({
                ajaxOptions: {
                    error: function( xhr, status, index, anchor ) {
                        $( anchor.hash ).html(
                        "<?php echo $lang['error_1'];?>");
                    }
                }
            });
        });
    </script>
    </head>