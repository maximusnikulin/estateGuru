<?php

class m170907_154847_add_block_sections  extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("images","isMain","int");
    }

	public function safeDown()
	{

	}
}