<?php

class m170729_071612_add_floorPosition extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("buildings","floorPos","INT");
	}

	public function safeDown()
	{

	}
}