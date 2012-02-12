Текущая версия 1.2.6

Данный програмный продукт Clan Stat распространяеться по лицензии Creative Common Licence: Attribution-Noncommercial-Share Alike 3.0
Вы вправе:

    копировать произведение
    распространять его
    изменять или преобразовывать програмный код но с сохранением копирайтов и лицензии 
    показывать или исполнять его публично
    делать цифровые публичные представления его (например, вебкастинг)
    переводить произведение в другой формат как точную копию
    
Вы обязаны:

    получать разрешение автора на любое из вещей, которые автор решит ограничить — например, использование в коммерческих целях, создание производного произведения
    сохранять любое уведомление об авторских правах нетронутым на всех копиях произведения
    ставить ссылку на лицензию с копий произведения
    не изменять условия лицензии
    не использовать технологию, чтобы ограничить законные использования произведения другими получателями лицензии
    Вы должны указывать авторство работы в порядке, установленном автором или лицензиаром (но не так, что бы это воспринималось, что они поддерживают вас или ваше использование данного произведения).

Запрщено:

    использовать данный продукт в комерческих целях
    убирать ссылки на "Wot-news.com" а так же комерческую рекламу
    
Эта лицензия:

    действует по всему миру
    длится в течение срока авторских прав на произведение
    является неотзывной

Полный текс лицензии вы можете найти в файле - CC-by-nc-sa

Описание:



Необходимо что бы были установлены следующие компоненты:

php-curl
php-pdo
php-pdo_mysql

Обновление с 1.х.х до 1.2.0

1. Скопируйте файлы к себе на сервер с заменой.
2. Не забудьте отредактировать config.php и mysql.php
3. Если вы используете MySQL запустите файл update.php и нажмите кнопку Start 1.х.х to 1.2.0 для обновления базы.
4. Удалите файлы install.php, update.php и clan.sql.

Обновление с 1.2.0 до 1.2.6

1. Скопируйте файлы к себе на сервер с заменой.
2. Не забудьте отредактировать config.php и mysql.php
3. Если вы используете MySQL запустите файл update.php и нажмите кнопку Start 1.2.0 to 1.2.1 для обновления базы.
4. Удалите файлы install.php, update.php и clan.sql.

Утсановка:

1a. Если вы собираетесь использовать базу данных, то вам необходимо создать(вы можете использовать уже существующую, гдавное, что бы в ней неболы таких таблици - lang, lang2, players, server, tanks и таблицы формата tank_нация) ее в формате utf8.
1b. Открыть файл function/mysql.php и внести изменения в настройках, изменить имя, пароль и название базы.
1c  Запустите install.php и ипортируйте базу нажав - Start Import
1d  Если база импортирована удачно вы увидите - Congratulations: End of file reached, assuming OK
1e  Обязательно удалите файлы clan.sql и install.php
1f. У пользователя базы обязательно должны быть права на создание новых таблиц!!!

2. В независимости от того, собираетесь вы использовать базу SQL, вам необходимо открыть function/config.php и внести там необходимые изменения вот в эти 4 параметра - 

    define("SERVER",'ru');  // Server, can be ru, eu, us(Сервер может быть ru, eu, us)
    define("CLAN",'7188'); //Clan ID(ID Клана) 7188
    define("MYSQL",'on'); //MYSQL can be on or off(Включить MySQL - on, не включать - off)
    define("CACHE",'24'); //Players cache time for MySQL in hours(Время на которое кешируються данные в MySQL-е в часах)
    define("ALIGN",'ver'); //Vertical(ver) or Horizontal(hor) align of tabs(Вертикальное или Горизонтальное расположение закладок, возможные значения - hor и ver)
    define("PARS",'curl'); //Parsing method, can be curl or alternative mcurl(Библиотека парсинга, может быть curl или mcurl)
    define("VEH",'normal'); //Base mod is normal, but if u have problems with vehicle parsing, pls turn on alternative method - alter (Обычный - normal, если есть проблемы с парсингом техники, переключить в - alter)
    
Дополнительно:
    
В переменной $tank_name храняться имена танков клана по уровням.    
Пример формата массива данных по игрокам, храниться в переменной $res

Array
(
    [playerNAME] => Array
        (
            [date] => Array
                (
                    [reg] => Дата регистрации: 10.12.2010
                    [local] => Данные по состоянию на 07.11.2011, 07:11
                    [reg_num] => 1291932000
                    [local_num] => 1320642660
                )

            [overall] => Array
                (
                    [Проведено боёв] => 652
                    [Побед] => 365
                    [Проигрышей] => 271
                    [Выжил в битвах] => 297
                )

            [perform] => Array
                (
                    [Уничтожено] => 1051
                    [Обнаружено] => 204
                    [Процент попадания] => 46%
                    [Нанесенные повреждения] => 559510
                    [Очки захвата базы] => 195
                    [Очки защиты базы] => 697
                )

            [exp] => Array
                (
                    [Суммарный опыт] => 327884
                    [Средний опыт за бой] => 503
                    [Максимальный опыт за бой] => 1524
                )

            [rating] => Array
                (
                    [Общий рейтинг] => Array
                        (
                            [type] => GR
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/gr.png
                            [name] => Общий рейтинг
                            [value] => 12
                            [place] => 235679
                        )

                    [Процент побед] => Array
                        (
                            [type] => W/B
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/wb.png
                            [name] => Процент побед
                            [value] => 56%
                            [place] => 19748
                        )

                    [Средний опыт] => Array
                        (
                            [type] => E/B
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/eb.png
                            [name] => Средний опыт
                            [value] => 503
                            [place] => 89840
                        )

                    [Победы] => Array
                        (
                            [type] => WIN
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/win.png
                            [name] => Победы
                            [value] => 365
                            [place] => 979539
                        )

                    [Проведено боёв] => Array
                        (
                            [type] => GPL
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/gpl.png
                            [name] => Проведено боёв
                            [value] => 652
                            [place] => 1034120
                        )

                    [Захват базы] => Array
                        (
                            [type] => CPT
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/cpt.png
                            [name] => Захват базы
                            [value] => 195
                            [place] => 1399794
                        )

                    [Нанесенные повреждения] => Array
                        (
                            [type] => DMG
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/dmg.png
                            [name] => Нанесенные повреждения
                            [value] => 559510
                            [place] => 628343
                        )

                    [Защита базы] => Array
                        (
                            [type] => DPT
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/dpt.png
                            [name] => Защита базы
                            [value] => 697
                            [place] => 773322
                        )

                    [Уничтожено врагов] => Array
                        (
                            [type] => FRG
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/frg.png
                            [name] => Уничтожено врагов
                            [value] => 1051
                            [place] => 630992
                        )

                    [Обнаружено врагов] => Array
                        (
                            [type] => SPT
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/spt.png
                            [name] => Обнаружено врагов
                            [value] => 204
                            [place] => 1280558
                        )

                    [Общий опыт] => Array
                        (
                            [type] => EXP
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/common/img/ratings/small/exp.png
                            [name] => Общий опыт
                            [value] => 327884
                            [place] => 742338
                        )

                )

 [tank] => Array
        (
            [6] => Array
                (
                    [Т-34-85] => Array
                        (
                            [type] => Т-34-85
                            [total] => 273
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T-34-85.png
                            [win] => 137
                            [nation] => ussr
                            [lvl] => VI 
                        )

                )

            [5] => Array
                (
                    [T-34] => Array
                        (
                            [type] => T-34
                            [total] => 222
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T-34.png
                            [win] => 93
                            [nation] => ussr
                            [lvl] => V 
                        )
                    [M41] => Array
                        (
                            [type] => M41
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/M41.png
                            [win] => 0
                            [nation] => usa
                            [lvl] => V 
                        )

                )

            [7] => Array
                (
                    [Т-43] => Array
                        (
                            [type] => Т-43
                            [total] => 203
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T-43.png
                            [win] => 98
                            [nation] => ussr
                            [lvl] => VII 
                        )
                )

            [8] => Array
                (
                    [Löwe] => Array
                        (
                            [type] => Löwe
                            [total] => 183
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/Lowe.png
                            [win] => 83
                            [nation] => germany
                            [lvl] => VIII
                        )

                    [Т-44] => Array
                        (
                            [type] => Т-44
                            [total] => 178
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T-44.png
                            [win] => 102
                            [nation] => ussr
                            [lvl] => VIII
                        )

            [4] => Array
                (
                    [А-20] => Array
                        (
                            [type] => А-20
                            [total] => 87
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/A-20.png
                            [win] => 33
                            [nation] => ussr
                            [lvl] => IV 
                        )
                )

            [3] => Array
                (
                    [БТ-7] => Array
                        (
                            [type] => БТ-7
                            [total] => 64
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/BT-7.png
                            [win] => 30
                            [nation] => ussr
                            [lvl] => III 
                        )

                    [M3 Stuart] => Array
                        (
                            [type] => M3 Stuart
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/M3_Stuart.png
                            [win] => 0
                            [nation] => usa
                            [lvl] => III 
                        )
                )

            [2] => Array
                (
                    [PzKpfw 38H735 (f)] => Array
                        (
                            [type] => PzKpfw 38H735 (f)
                            [total] => 59
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/H39_captured.png
                            [win] => 23
                            [nation] => germany
                            [lvl] => II 
                        )

                    [БТ-2] => Array
                        (
                            [type] => БТ-2
                            [total] => 47
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/BT-2.png
                            [win] => 18
                            [nation] => ussr
                            [lvl] => II 
                        )

                )

            [1] => Array
                (
                    [МС-1] => Array
                        (
                            [type] => МС-1
                            [total] => 30
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/MS-1.png
                            [win] => 18
                            [nation] => ussr
                            [lvl] => I 
                        )

                    [T1 Cunningham] => Array
                        (
                            [type] => T1 Cunningham
                            [total] => 5
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T1_Cunningham.png
                            [win] => 2
                            [nation] => usa
                            [lvl] => I 
                        )

                    [Leichttraktor] => Array
                        (
                            [type] => Leichttraktor
                            [total] => 5
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/Ltraktor.png
                            [win] => 1
                            [nation] => germany
                            [lvl] => I 
                        )

                )

            [9] => Array
                (
                    [Т-54] => Array
                        (
                            [type] => Т-54
                            [total] => 4
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T-54.png
                            [win] => 2
                            [nation] => ussr
                            [lvl] => IX 
                        )

                    [Объект 704] => Array
                        (
                            [type] => Объект 704
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/Object_704.png
                            [win] => 0
                            [nation] => ussr
                            [lvl] => IX 
                        )

                )

            [10] => Array
                (
                    [ИС-7] => Array
                        (
                            [type] => ИС-7
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/IS-7.png
                            [win] => 0
                            [nation] => ussr
                            [lvl] => X 
                        )

                    [Maus] => Array
                        (
                            [type] => Maus
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/Maus.png
                            [win] => 0
                            [nation] => germany
                            [lvl] => X 
                        )

                    [E-100] => Array
                        (
                            [type] => E-100
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/E-100.png
                            [win] => 0
                            [nation] => germany
                            [lvl] => X 
                        )

                    [T30] => Array
                        (
                            [type] => T30
                            [total] => 0
                            [link] => http://challenge.worldoftanks.ru/media/2.2.0.7/armory/small/T30.png
                            [win] => 0
                            [nation] => usa
                            [lvl] => X 
                        )

                )

        )

)

        )