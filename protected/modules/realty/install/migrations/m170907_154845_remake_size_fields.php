<?php

class m170907_154845_remake_size_fields extends yupe\components\DbMigration
{
	public function safeUp()
	{
	    $sql = "ALTER TABLE `buildings` CHANGE `square` `square` DECIMAL(11, 3) NULL DEFAULT NULL;";
        $command = $this->dbConnection->createCommand($sql);
        $command->execute();

        $sql = "ALTER TABLE `buildings` CHANGE `usefulSquare` `usefulSquare` DECIMAL(11, 3) NULL DEFAULT NULL;";
        $command = $this->dbConnection->createCommand($sql);
        $command->execute();

        $sql = "ALTER TABLE `apartments` CHANGE `size` `size` DECIMAL(11, 3) NULL DEFAULT NULL;";
        $command = $this->dbConnection->createCommand($sql);
        $command->execute();
	}

	public function safeDown()
	{

	}
}