<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UserGoodsColumns".
 *
 * @property int $id
 * @property string|null $column
 * @property int|null $visible
 * @property int|null $user_id
 */
class UserGoodsColumns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'UserGoodsColumns';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['column'], 'string', 'max' => 255],
            ['visible', 'boolean']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'column' => 'Column',
            'visible' => 'Visible',
            'user_id' => 'User ID',
        ];
    }
}
