<?php

class Model_User extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'screen_name',
        'token',
        'token_secret',
        'include_keyword',
        'exclude_keywords',
        'enable',
        'created_at',
        'updated_at',
        'post_at'
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => false,
        ),
    );
}
