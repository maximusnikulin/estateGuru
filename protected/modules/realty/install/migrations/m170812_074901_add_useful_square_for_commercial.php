<?php

class m170812_074901_add_useful_square_for_commercial extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("buildings","usefulSquare","INT");
	}

	public function safeDown()
	{

	}
}