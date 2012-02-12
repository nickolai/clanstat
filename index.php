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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
        <script type="text/javascript">    
            var url = './main.php'; //the details page you want to display... 
        </script>
        <script language="JavaScript" type="text/javascript">
            function reFresh() {
                location.reload(true)
            }
            window.setInterval("reFresh()",90000);
        </script>
        <style>    
            .loading-indicator {    
                font-size:8pt;    
                background-repeat: no-repeat;      
                background-position:top left;    
                padding-left:20px;    
                height:18px;    
                text-align:left;    
            }    
            #loading{    
                position:absolute;         
                background:white;    
                padding:10px;    
                font:bold 14px verdana,tahoma,helvetica;    
                color:#003366;    
                width:100%;
                height: 100%;    
                text-align:center;    
            } 

            .main {
                left: 0px;
                margin: 0 auto;
                position: relative;
                width: 700px;
                padding-top: 300px;
            }
        </style>   
    </head> 
    <body onload="location.href = url;" style="overflow:hidden;overflow-y:hidden">
        <div id="loading">    
            <div class="main">
                Подождите пожалуйста, идет загрузка данных, это может занять некоторое время...<img src="./images/ajax-loader.gif">
            </div>     
        </div>    
    </body>    
    <script>    
        if(document.layers) {    
            document.write('<Layer src="' + url + '" visibility="hide"></Layer>');    
        }    
        else if(document.all || document.getElementById) {    
            document.write('<iframe src="' + url + '" style="visibility:hidden;"></iframe>');    
        }    
        else {    
            location.href = url;    
        }    
    </script>    
</html>
