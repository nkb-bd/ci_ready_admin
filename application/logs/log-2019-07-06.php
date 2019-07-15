<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-07-06 07:46:24 --> Severity: Notice --> Undefined property: stdClass::$site_title F:\xampp\htdocs\ci_project\ci_ready_admin\assets\themes\public\template.php 49
ERROR - 2019-07-06 09:30:20 --> Severity: Warning --> include_once(assets/themes/public/footer.php): failed to open stream: No such file or directory F:\xampp\htdocs\ci_project\ci_ready_admin\assets\themes\public\template.php 3
ERROR - 2019-07-06 09:30:20 --> Severity: Warning --> include_once(): Failed opening 'assets/themes/public/footer.php' for inclusion (include_path='F:\xampp\php\PEAR') F:\xampp\htdocs\ci_project\ci_ready_admin\assets\themes\public\template.php 3
ERROR - 2019-07-06 09:30:20 --> Severity: Warning --> include_once(assets/themes/public/footer.php): failed to open stream: No such file or directory F:\xampp\htdocs\ci_project\ci_ready_admin\assets\themes\public\template.php 3
ERROR - 2019-07-06 09:30:20 --> Severity: Warning --> include_once(): Failed opening 'assets/themes/public/footer.php' for inclusion (include_path='F:\xampp\php\PEAR') F:\xampp\htdocs\ci_project\ci_ready_admin\assets\themes\public\template.php 3
ERROR - 2019-07-06 10:05:25 --> Could not find the language line "users input username"
ERROR - 2019-07-06 20:37:03 --> Severity: Notice --> Undefined index: is_admin F:\xampp\htdocs\ci_project\ci_ready_admin\application\models\Users_model.php 142
ERROR - 2019-07-06 20:37:03 --> Query error: Column 'is_admin' cannot be null - Invalid query: 
                INSERT INTO users (
                    username,
                    password,
                    salt,
                    first_name,
                    last_name,
                    email,
                    language,
                    is_admin,
                    status,
                    deleted,
                    created,
                    updated
                ) VALUES (
                    'wuqej',
                    '4ace725d1cc4ac772484eec5f465a4e45bc2a21b121cf0b9918280ad1abceb8d73d01687f7b433fed97b445a67628b99887b1ab84909256f7f3f139383e2182c',
                    'd04ccf43eef30e1977df7206e35ff9ba4de61622c1f90cb0a9ac962a3e4863493205e8d446380939d7a970d486736d676f5e665279078af6b30d2d045e698052',
                    'Quincy',
                    'Bruce',
                    'visehi@mailinator.net',
                    'english',
                    NULL,
                    '0',
                    '0',
                    '2019-07-06 20:37:03',
                    '2019-07-06 20:37:03'
                )
            
ERROR - 2019-07-06 21:34:46 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ';' F:\xampp\htdocs\ci_project\ci_ready_admin\application\helpers\core_helper.php 151
