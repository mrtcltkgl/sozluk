<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mesaj`.
 */
class m160521_185355_create_mesaj extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
$this->createTable('messages', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'title_id' => $this->integer(),
            'message' => $this->text(),
        ]);



        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_id-message',
            'messages',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_id-message',
            'messages',
            'user_id',
            'user',
            'id',
            'CASCADE',
			'CASCADE'
        );
		
        // creates index for column `title_id`
        $this->createIndex(
            'idx-title_id',
            'messages',
            'title_id'
        );

        // add foreign key for table `titles`
        $this->addForeignKey(
            'fk-title_id',
            'messages',
            'title_id',
            'titles',
            'id',
            'CASCADE',
			'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mesaj');
    }
}
