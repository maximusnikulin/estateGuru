<?php

class m170907_154844_add_is_promo_to_apartments extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn("apartments","isPromo","TINYINT");
	}

	public function safeDown()
	{

	}
}