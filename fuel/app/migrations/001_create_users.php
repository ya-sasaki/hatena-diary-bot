<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'screen_name' => array('constraint' => 20, 'type' => 'varchar'),
			'token' => array('constraint' => 100, 'type' => 'varchar'),
			'token_secret' => array('constraint' => 100, 'type' => 'varchar'),
			'include_keyword' => array('type' => 'text', 'null' => true),
			'exclude_keywords' => array('type' => 'text', 'null' => true),
			'enable' => array('type' => 'boolean', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

        ), array('id'));

        \DBUtil::create_index('users', 'screen_name', 'idx_screen_name');
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}
