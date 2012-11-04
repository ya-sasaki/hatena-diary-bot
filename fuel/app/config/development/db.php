<?php
/**
 * The development database settings.
 */

return array(
    'default' => array(
        'connection'  => array(
            'type'       => 'pdo',
            'dsn'        => 'mysql:host=localhost;dbname=hatena-bot-db',
            'username'   => 'root',
            'password'   => '',
            'persistent' => false,
            'compress'   => false,
        ),
    ),
);
