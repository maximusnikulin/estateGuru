<?php

class m170813_104745_add_dictionaries extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $sql = "
INSERT INTO `yupe_dictionary_dictionary_group` (`id`, `code`, `name`, `description`, `create_time`, `update_time`, `create_user_id`, `update_user_id`) VALUES
(2, 'walls', 'Виды стен', '', '2017-08-12 13:29:28', '2017-08-12 13:29:28', 1, 1),
(3, 'districts', 'Районы', '', '2017-08-13 07:44:02', '2017-08-13 07:44:02', 1, 1),
(4, 'buildingTypes', 'Типы строений', '', '2017-08-13 09:14:08', '2017-08-13 09:14:08', 1, 1);

INSERT INTO `yupe_dictionary_dictionary_data` (`id`, `group_id`, `code`, `name`, `value`, `description`, `create_time`, `update_time`, `create_user_id`, `update_user_id`, `status`) VALUES
(1, 2, 'beto', 'Бетонные', 'Бетонные', '', '2017-08-12 13:31:58', '2017-08-12 13:31:58', 1, 1, 1),
(2, 2, 'kirp', 'Кирпичные', 'Кирпичные', '', '2017-08-12 13:32:09', '2017-08-12 13:32:09', 1, 1, 1),
(3, 3, 'industr', 'Индустриальный', 'Индустриальный', '', '2017-08-13 07:46:33', '2017-08-13 07:46:33', 1, 1, 1),
(4, 3, 'leni', 'Ленинский', 'Ленинский', '', '2017-08-13 07:46:52', '2017-08-13 07:46:52', 1, 1, 1),
(5, 4, 'monol', 'Монолитное', 'Монолитное', '', '2017-08-13 09:14:59', '2017-08-13 09:14:59', 1, 1, 1);
        ";
        $command = $this->dbConnection->createCommand($sql);
        $command->execute();
    }

	public function safeDown()
	{

	}
}