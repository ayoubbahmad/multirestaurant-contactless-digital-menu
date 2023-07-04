<?php

namespace App;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class StoreCategories extends Model
{
    protected $guarded = [];

    public function stores_categories(){
        return $this->hasMany(StoreCategoriesStore::class,'store_category_id','id')
            ->select('store_category_id', 'store_id','id');
    }
}
