<?php

class m170907_154843_add_is_promo extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn("buildings","isPromo","TINYINT");
	}

	public function safeDown()
	{

	}
}