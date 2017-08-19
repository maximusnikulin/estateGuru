<?php
/**
 * Subscribe install migration
 * Класс миграций для модуля Subscribe:
 *
 * @category YupeMigration
 * @package  yupe.modules.subscribe.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000000_subscribe_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{subscribe}}',
            [
                'id' => 'pk',
                'email' => 'string',
                'dateAdd' => 'datetime',
            ],
            $this->getOptions()
        );

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{subscribe}}');
    }
}
