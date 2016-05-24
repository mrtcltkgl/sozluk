<?php

use yii\db\Migration;

/**
 * Handles the creation for table `baslik`.
 */
class m160521_184135_create_baslik extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
$this->createTable('titles', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(),
            'user_id' => $this->integer(),
            'name' => $this->text(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-tag_id',
            'titles',
            'tag_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-tag_id',
            'titles',
            'tag_id',
            'tags',
            'id',
            'CASCADE',
			'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-user_id-title',
            'titles',
            'user_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-user_id',
            'titles',
            'user_id',
            'user',
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
        $this->dropTable('titles');
    }
}
