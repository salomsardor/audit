<?php

namespace app\models\data;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $name
 *
 * @property Mistakes[] $mistakes
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Mistakes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMistakes()
    {
        return $this->hasMany(Mistakes::class, ['status' => 'id']);
    }
}
