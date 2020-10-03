<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m201001_154523_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'cid' => $this->string(255)->notNull(),
            'campaign_id' => $this->integer()->notNull(),
            'event_time' => $this->timestamp()->notNull(),
            'sub1' => $this->string(255)->notNull()
        ]);

        $this->createIndex('idx-event-type_id', 'event', 'type_id');

        $this->addForeignKey(
            'fk-event_type-id',
            'event',
            'type_id',
            'event_type',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
