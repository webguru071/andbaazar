<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\KrishiProduct;

class KrishiCategory extends Model
{
    use SoftDeletes;
    protected $table ='krishi_product_categories';
    protected $fillable = ['name','slug','description','parent_slug','parent_id','user_id'];


    public function products(){
        return $this->hasMany(KrishiProduct::class,'category_id');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function getParentsAttribute(){
        $parents = collect([]);
        $parent = $this->parent;
        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
        return $parents;
    }

    public function childrenProducts(){
        return $this->hasManyThrough(KrishiProduct::class, KrishiCategory::class, 'parent_id','category_id');
    }

    public function getProductqtyAttribute(){
        return $this->products()->count() + $this->childrenProducts()->count(); 
    }

    public function childs() {
        return $this->hasMany(self::class, 'parent_id','id');//->with('childs');
    }

}
