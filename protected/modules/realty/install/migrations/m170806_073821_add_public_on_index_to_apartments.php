<?php

class m170806_073821_add_public_on_index_to_apartments extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("apartments","showOnIndex","TINYINT");
	}

	public function safeDown()
	{

	}
}