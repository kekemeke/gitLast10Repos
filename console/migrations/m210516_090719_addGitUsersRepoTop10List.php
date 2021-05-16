<?php

use yii\db\Migration;

/**
 * Class m210516_090719_addGitUsersRepoTop10List
 */
class m210516_090719_addGitUsersRepoTop10List extends Migration
{
    private $table = 'gitUsersRepo';

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
            'username' => $this->string()->notNull(),
            'link' => $this->string()->notNull(),
            'updated_at' => $this->string()->notNull(),
            'updated_by_cron' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()'))
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable($this->table);
    }
}
