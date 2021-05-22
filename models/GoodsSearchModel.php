<?php


namespace app\models;


use yii\base\Model;

class GoodsSearchModel extends Model
{
    public $field;

    public function rules(){
        return [
            ['field', 'string']
        ];
    }

    public function search(){
        if ($this->validate()){
            $query = Goods::find()
                ->filterWhere(['like', 'sku', $this->field])
                ->orFilterWhere(['like', 'name', $this->field]);

            return $query;
        }

        return false;
    }
}