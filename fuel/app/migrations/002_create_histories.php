<?php

namespace Fuel\Migrations;

class Create_histories
{
	public function up()
	{
		\DBUtil::create_table('histories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'screen_name' => array('constraint' => 20, 'type' => 'varchar'),
			'diary_id' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
        \DBUtil::create_index('histories', 'screen_name', 'idx_screen_name');
	}

	public function down()
	{
		\DBUtil::drop_table('histories');
	}
}
