<?php

class m170722_153403_add_svg_points_to_apartments extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("apartments","svgPoints","VARCHAR(300)");
	}

	public function safeDown()
	{

	}
}