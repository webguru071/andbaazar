<?php

namespace App\Http\Traits;

trait apiTrait {

    public function jsonResponse($data,$msg="Success",$error = false){
        return response()->json([
            'data'  => $data,
            'msg'   => $msg,
            'error' => $error
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