<?php

namespace app\repositories;


use app\models\Goods;
use yii\web\Request;
use yii\web\UploadedFile;

class GoodsRepository
{
    public function saveByRequest(Goods $good, Request $request){
        if ($good->load($request->post())){
            $good->file = UploadedFile::getInstance($good, "file");
            if ($good->validate()){
                $this->saveFile($good);
                $good->save();
            }
        }

        return  $good;
    }

    private function saveFile(Goods $goods){
        if ($goods->file) {
            $file = 'uploads/' . $goods->file->baseName . "." . $goods->file->extension;
            $goods->file->saveAs($file);

            $this->deleteFile($goods);

            $goods->image = "/".$file;
            $goods->file = null;
        }
    }

    private function deleteFile(Goods $goods){
        if ($goods->image){
            unlink(ltrim($goods->image, '/'));
        }
    }

    public function delete(Goods $goods){
        $this->deleteFile($goods);
        $goods->delete();
    }
}