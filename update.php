<?php
    header("Content-type: text/html; charset=utf-8");
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    define('ROOT_DIR', dirname(__FILE__));
    include_once(ROOT_DIR.'/function/config.php');
    if($language == 'ru'){
        echo 'Обновление Базы<br>';
    }elseif($language == 'ru'){
        echo 'Update database<br>';
    }
    if(MYSQL == 'on' && MYSQL_ERROR != 'on' && isset($_POST['update'])){
        if($_POST['update'] == 'Start 1.x.x to 1.2.0'){
            echo $_POST['update'].'<br>';
            include_once(ROOT_DIR.'/function/mysql.php');
            $db->prepare("ALTER TABLE `players` ADD `account_id` INT( 12 ) NOT NULL AFTER id;")->execute();
            $db->prepare("ALTER TABLE `players` ADD `member_since` VARCHAR( 11 ) NOT NULL AFTER local;")->execute();
            $db->prepare("ALTER TABLE `players` ADD `role` VARCHAR( 50 ) NOT NULL AFTER name;")->execute();
            $db->prepare("ALTER TABLE `lang2` ADD `error_2` TEXT NOT NULL AFTER error_1;")->execute();
            $db->prepare("ALTER TABLE `lang2` ADD `error_3` TEXT NOT NULL AFTER error_2;")->execute();
            $insert_2 = "error_2 = 'Нет связи с сервером', error_3 = 'Таблица MySQL пуста'";
            $insert_3 = "error_2 = 'Connection Timed Out', error_3 = 'No entries in MySQL'";
            $db->prepare("UPDATE lang2 SET ".$insert_2." WHERE language = 'ru';")->execute();
            $db->prepare("UPDATE lang2 SET ".$insert_3." WHERE language = 'en';")->execute();
            if($language == 'ru'){
                echo 'База данных обновлена, не забудьте удалить файл update.php';
            }elseif($language == 'ru'){
                echo 'The database is updated, do not forget to delete the file update.php';
            }
        }
        if($_POST['update'] == 'Start 1.2.0 to 1.2.1'){
            echo $_POST['update'].'<br>';
            include_once(ROOT_DIR.'/function/mysql.php');
            $insert_1 = "base = 'http://worldoftanks.ru/uc/accounts/named/', clan_img = 'http://worldoftanks.ru/dcont/clans/emblems/', rating_link = 'http://worldoftanks.ru/static/3.0.3/common/img/ratings/small/', gm_url = 'worldoftanks.ru', td = 'http://worldoftanks.ru'";
            $db->prepare("UPDATE server SET ".$insert_1." WHERE server = 'ru';")->execute();
            $db->prepare("ALTER TABLE `server` ADD `base_direct` VARCHAR( 75 ) NOT NULL AFTER base;")->execute();
            $db->prepare("UPDATE server SET base_direct = 'http://worldoftanks.ru/community/accounts/' WHERE server = 'ru';")->execute();
            $db->prepare("UPDATE server SET base_direct = 'http://worldoftanks.com/community/accounts/' WHERE server = 'us';")->execute();
            $db->prepare("UPDATE server SET base_direct = 'http://uc.worldoftanks.eu/uc/accounts/' WHERE server = 'eu';")->execute();
            if($language == 'ru'){
                echo 'База данных обновлена, не забудьте удалить файл update.php';
            }elseif($language == 'ru'){
                echo 'The database is updated, do not forget to delete the file update.php';
            }
        }
    }
?>
<br><br>
<form action="update.php" method="post">
    <input type="submit" value="Start 1.x.x to 1.2.0" name="update">
</form>
<form action="update.php" method="post">
    <input type="submit" value="Start 1.2.0 to 1.2.1" name="update">
</form>