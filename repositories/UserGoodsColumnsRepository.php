<?php


namespace app\repositories;


use app\models\UserGoodsColumns;

class UserGoodsColumnsRepository
{
    private $columns = [
        'id' => true,
        'image' => true,
        'sku' => true,
        'name' => true,
        'count' => true,
        'type' => true
    ];

    public function getColumnsByUserId($id){
        $userColumns = UserGoodsColumns::find()->where(['user_id' => $id])->all();
        foreach ($userColumns as $userColumn){
            if ($userColumn->visible == false){
                $this->columns[$userColumn->column] = false;
            }
        }

        return $this->columns;
    }

    public function saveColumnsByUserId($id, $columns){
        foreach ($this->columns as $column => $value){
            if (isset($columns[$column])){
                $this->setVisibleValueForUser($id, $column, true);
            }else{
                $this->setVisibleValueForUser($id, $column, false);
            }
        }
    }

    private function setVisibleValueForUser($user_id, $column, $value){
        $userColumn = UserGoodsColumns::find()
            ->where(['user_id' => $user_id, 'column' => $column])
            ->one();

        if (!$userColumn){
            $userColumn = new UserGoodsColumns([
                'column' => $column,
                'user_id' => $user_id
            ]);
        }

        $userColumn->visible = $value;
        $userColumn->save();
    }
}