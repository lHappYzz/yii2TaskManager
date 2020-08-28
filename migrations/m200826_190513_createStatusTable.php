<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m200826_190513_createStatusTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(191),
        ]);
        $this->insert('status', ['title' => 'New']); // record must be at idx 1

        $this->insert('status', ['title' => 'In progress']);
        $this->insert('status', ['title' => 'Completed']);
        $this->insert('status', ['title' => 'Failed']);

        $this->addForeignKey('FK_task_status', 'task', 'status_id', 'status', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_task_status', 'task');
        $this->dropTable('{{%status}}');
    }
}
