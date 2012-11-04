<?php
/**
 * The production database settings.
 */
return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => "mysql:host=".$_SERVER['MYSQL_DB_HOST'].";dbname=".$_SERVER['MYSQL_DB_NAME'],
            'username'   => $_SERVER['MYSQL_USERNAME'],
            'password'   => $_SERVER['MYSQL_PASSWORD'],
        ),
    ),
);
