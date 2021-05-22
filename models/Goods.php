<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Goods".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $sku
 * @property string|null $name
 * @property int|null $count
 * @property string|null $type
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @var $file UploadedFile
     */
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'name', 'count', 'type'], 'required'],
            [['count'], 'integer'],
            [['image', 'sku', 'name', 'type'], 'string', 'max' => 255],
            ['file', 'file', 'extensions' => 'jpg, jpeg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'sku' => 'Sku',
            'name' => 'Name',
            'count' => 'Count',
            'type' => 'Type',
            'file' => 'Image'
        ];
    }
}
