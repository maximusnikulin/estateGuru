<?php

class m170722_133216_change_houses_for_estate extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn("buildings","rayon","VARCHAR(100)");
        $this->addColumn("buildings","floor","INT");
        $this->addColumn("buildings","priceForMeter","VARCHAR(100)");
        $this->addColumn("buildings","walls","VARCHAR(100)");
        $this->addColumn("buildings","type","VARCHAR(100)");
        $this->addColumn("buildings","svgBackground","VARCHAR(200)");
	}

	public function safeDown()
	{

	}
}