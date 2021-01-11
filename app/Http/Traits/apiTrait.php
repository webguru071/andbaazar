<?php

namespace App\Http\Traits;

trait apiTrait {

    public function jsonResponse($data=[],$msg="success",$status = true){
        return response()->json([
            'msg'   => $msg,
            'error' => $status,
            'data'  => $data,
        ]);
    }

    public function generateCategories($categories,$arr = []){
        foreach ($categories as $category) {
            if (count($category->childs) > 0) {
                $arr = $this->generateCategories($category->childs,$arr);
            }
            $arr[] = $category->id;
        }
        return $arr;
    }
}
