<?php

use yii\db\Migration;

/**
 * Handles the creation for table `etiket`.
 */
class m160521_184005_create_etiket extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
			'name'=>$this->string(50),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tags');
    }
}
