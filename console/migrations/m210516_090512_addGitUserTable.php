<?php

use yii\db\Migration;

/**
 * Class m210516_090512_addGitUserTable
 */
class m210516_090512_addGitUserTable extends Migration
{
    private $table = 'gitUser';
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert($this->table, ['username'], [
            ['aRTy42'],
            ['qarmin'],
            ['PySimpleGUI'],
            ['apparentlymart'],
            ['geerlingguy'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable($this->table);
    }
}
