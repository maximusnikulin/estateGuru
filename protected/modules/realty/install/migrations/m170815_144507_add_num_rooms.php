<?php

class m170815_144507_add_num_rooms extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("apartments","isStudio","TINYINT");
	}

	public function safeDown()
	{

	}
}