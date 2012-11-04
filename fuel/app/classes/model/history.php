<?php

class Model_History extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'screen_name',
        'diary_id',
        'created_at',
        'updated_at'
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

    static function find_tweet($screen_name) {
        $to_time = time();
        $from_time = $to_time - 60*60*24*31;
        $tweeted_list = Model_History::find()->
            where('screen_name', $screen_name)->
            where('created_at', 'between', array($from_time, $to_time))->get();
        return $tweeted_list; 
    }
}
