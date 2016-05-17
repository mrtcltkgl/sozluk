<?php

namespace mrtcltkgl\sozluk\models;

use Yii;

/**
 * This is the model class for table "titles".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $user_id
 * @property string $name
 *
 * @property Messages[] $messages
 * @property Tags $tag
 * @property User $user
 */
class Titles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'user_id', 'name'], 'required'],
            [['tag_id', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Başlık Numarası',
            'tag_id' => 'Başlık ile İlişkili Etiket',
            'user_id' => 'Başlığı Oluşturan Kullanıcı',
            'name' => 'Başlık Adı',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['title_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
