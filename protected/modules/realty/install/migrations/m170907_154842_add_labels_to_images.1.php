<?php

class m170907_154842_add_labels_to_images extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("images","label","TEXT");
	}

	public function safeDown()
	{

	}
}