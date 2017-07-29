<?php

class m170729_065623_add_price_and_show_on_index extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("buildings","price","INT");
        $this->addColumn("buildings","showOnIndex","TINYINT");

	}

	public function safeDown()
	{

	}
}