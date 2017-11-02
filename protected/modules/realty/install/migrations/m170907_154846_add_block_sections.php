<?php

class m170907_154846_add_block_sections  extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->createTable("block_sections", [
            'id' => 'pk',
            'name' => 'string',
            'idBuilding' => 'int',
        ]);

        $this->createTable("floors", [
            'id' => 'pk',
            'name' => 'string',
            'minFloor' => 'int',
            'maxFloor' => 'int',
            'idBlockSection' => 'int',
            'image' => 'string',
       ]);

        $this->addColumn("apartments","idBlockSection","int");
        $this->addColumn("apartments","idFloor","int");
   }

	public function safeDown()
	{

	}
}