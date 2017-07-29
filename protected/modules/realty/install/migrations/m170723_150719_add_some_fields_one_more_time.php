<?php

class m170723_150719_add_some_fields_one_more_time extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("buildings","square","INT");
        $this->addColumn("buildings","city","VARCHAR(100)");
        $this->addColumn("buildings","water","VARCHAR(100)");
        $this->addColumn("buildings","basement","VARCHAR(100)");
        $this->addColumn("buildings","whereObject","VARCHAR(100)");
        $this->addColumn("apartments","number","VARCHAR(100)");
	}

	public function safeDown()
	{

	}
}