<?php

class m170907_154848_add_block_sections  extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("apartments","squareLive","DECIMAL(10,2)");
        $this->addColumn("apartments","squareKitchen","DECIMAL(10,2)");
    }

	public function safeDown()
	{

	}
}